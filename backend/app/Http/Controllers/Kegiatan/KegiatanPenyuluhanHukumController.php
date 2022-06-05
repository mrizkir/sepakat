<?php

namespace App\Http\Controllers\Kegiatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kegiatan\KegiatanPenyuluhanHukumModel;

use Ramsey\Uuid\Uuid;

class KegiatanPenyuluhanHukumController extends Controller
{
	public function index ()
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_BROWSE');

		if ($this->hasRole('paralegal'))
		{
			$daftar_kegiatan=KegiatanPenyuluhanHukumModel::select(\DB::raw('
				penyuluhan_hukum.id,
				users.name,
				penyuluhan_hukum.nama_kegiatan,
				penyuluhan_hukum.narasumber,
				penyuluhan_hukum.jumlah_peserta,
				penyuluhan_hukum.id_status,
				penyuluhan_hukum.created_at,
				penyuluhan_hukum.updated_at                                                        
			'))    
			->join ('users','users.id','penyuluhan_hukum.user_id')			
			->where('user_id',$this->getUserid())                                                                                                    
			->get();
		}
		else
		{        
			$daftar_kegiatan=KegiatanPenyuluhanHukumModel::select(\DB::raw('
				penyuluhan_hukum.id,
				users.name,
				penyuluhan_hukum.nama_kegiatan,
				penyuluhan_hukum.narasumber,
				penyuluhan_hukum.jumlah_peserta,
				penyuluhan_hukum.id_status,
				penyuluhan_hukum.created_at,
				penyuluhan_hukum.updated_at
			'))    
			->join ('users','users.id','penyuluhan_hukum.user_id')    			                                                                         
			->get();
		}
		return Response()->json([
			'status'=>1,
			'pid'=>'fetchdata',
			'daftar_kegiatan'=>$daftar_kegiatan,
			'message'=>'Fetch data daftar kegiatan penyuluhan hukum berhasil diperoleh.'
		], 200);
	}
	public function show(Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_SHOW');

		if ($this->hasRole('paralegal'))
		{
			$kegiatan = KegiatanPenyuluhanHukumModel::where('user_id', $this->getUserid())			
			->find($id);
		}
		else
		{
			$kegiatan = KegiatanPenyuluhanHukumModel::find($id);
		}
		if (is_null($kegiatan))
		{
			return Response()->json([
				'status'=>1,
				'pid'=>'fetchdata',
				'message'=>["kegiatan penyuluhan hukum dengan ID ($id) gagal diperoleh"]
			],422);
		}
		else
		{            
			return Response()->json([
				'status'=>1,
				'pid'=>'fetchdata',
				'kegiatan'=>$kegiatan,
				'message'=>"kegiatan penyuluhan hukum berhasil diperoleh"
			],200);
		}
	}
	public function store(Request $request)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$this->validate($request, [					
			'user_id'=>'required|exists:users,id',
			'nama_kegiatan'=>'required',			
			'tempat_pelaksanaan'=>'required',         
			'tanggal_pelaksanaan'=>'required|date',            
			'jam_pelaksanaan'=>'required',            
			'narasumber'=>'required',
			'peserta'=>'required',
			'jumlah_peserta'=>'required|numeric',			   
			'uraian_kegiatan'=>'required',            			        
			'rekomendasi_kegiatan'=>'required',            
		]);
		\DB::beginTransaction();
		
		$tanggal_pelaksanaan=$request->input('tanggal_pelaksanaan') . ' '.$request->input('jam_pelaksanaan');
		$uuid = Uuid::uuid4()->toString();
		
		$kegiatan=KegiatanPenyuluhanHukumModel::create([
			'id'=>$uuid,
			'user_id'=>$request->input('user_id'),                
			'nama_kegiatan'=>$request->input('nama_kegiatan'),       
			'tempat_pelaksanaan'=>$request->input('tempat_pelaksanaan'),                			             			
			'tanggal_pelaksanaan'=>$tanggal_pelaksanaan,                
			'narasumber'=>$request->input('narasumber'),                
			'peserta'=>$request->input('peserta'),                
			'jumlah_peserta'=>$request->input('jumlah_peserta'),                
			'uraian_kegiatan'=>$request->input('uraian_kegiatan'),                			
			'rekomendasi_kegiatan'=>$request->input('rekomendasi_kegiatan'),                
			'id_status'=>0,                            
		]);
		
		\DB::table('kegiatan')
		->insert([
			'kegiatan_id'=>$uuid,
			'user_id'=>$request->input('user_id'),                
			'tanggal'=>$tanggal_pelaksanaan,                
			'tempat'=>$request->input('tempat_pelaksanaan'),                
			'id_jenis_kegiatan'=>1,                
			'nama_jenis'=>'Penyuluhan Hukum',                
			'nama_kegiatan'=>$request->input('nama_kegiatan'),                
			'pemohon'=>$request->input('narasumber'),                
			'uraian_kegiatan'=>$request->input('uraian_kegiatan'),                
			'rekomendasi_kegiatan'=>$request->input('rekomendasi_kegiatan'),                
			'id_status'=>0,                            
		]);

		\DB::commit();

		return Response()->json([
			'status'=>1,
			'pid'=>'store',
			'kegiatan'=>$kegiatan,
			'message'=>'Data kegiatan penyuluhan hukum baru berhasil disimpan.'
		],200);
	}
	public function uploadsuratpermohonan (Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$kegiatan = KegiatanPenyuluhanHukumModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
				'status'=>0,
				'pid'=>'store',                
				'message'=>["Data kegiatan penyuluhan hukum tidak ditemukan."]
			],422);         
		}
		else
		{
			$this->validate($request, [                      
				'filesuratpermohonan'=>'required'                        
			]);
			$name=$kegiatan->nama_pemohon;
			$filesuratpermohonan = $request->file('filesuratpermohonan');
			$mime_type=$filesuratpermohonan->getMimeType();
			if ($mime_type=='application/pdf' || $mime_type=='image/png' || $mime_type=='image/jpeg')
			{
				$folder=\App\Helpers\Helper::public_path('pdf/suratpermohonan/');
				$file_name=uniqid('img').".".$filesuratpermohonan->getClientOriginalExtension();
				if (is_file(\App\Helpers\Helper::public_path($kegiatan->file_surat_permohonan)))                
				{
					unlink(\App\Helpers\Helper::public_path($kegiatan->file_surat_permohonan));
				}                
				$kegiatan->file_surat_permohonan="storage/pdf/suratpermohonan/$file_name";
				$kegiatan->save();

				\DB::table('kegiatan')
				->where('kegiatan_id', $kegiatan->id)
				->update([
					'file_fotocopy_ktp' => $kegiatan->file_surat_permohonan,
				]);


				$filesuratpermohonan->move($folder,$file_name);
				return Response()->json([
					'status'=>0,
					'pid'=>'store',
					'kegiatan'=>$kegiatan,                
					'message'=>"KTP Pemohon/Peserta ($name) berhasil diupload"
				],200);    
			}
			else
			{
				return Response()->json([
					'status'=>1,
					'pid'=>'store',
					'message'=>["Extensi file yang diupload bukan jpg atau png."]
				],422); 
				

			}
		}
	}
	public function uploaddaftarhadir (Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$kegiatan = KegiatanPenyuluhanHukumModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
				'status'=>0,
				'pid'=>'store',                
				'message'=>["Data kegiatan penyuluhan hukum tidak ditemukan."]
			],422);         
		}
		else
		{
			$this->validate($request, [                      
				'filedaftarhadir'=>'required'                        
			]);
			$name=$kegiatan->nama_pemohon;
			$filedaftarhadir = $request->file('filedaftarhadir');
			$mime_type=$filedaftarhadir->getMimeType();
			if ($mime_type=='application/pdf' || $mime_type=='image/png' || $mime_type=='image/jpeg')
			{
				$folder=\App\Helpers\Helper::public_path('pdf/daftarhadir/');
				$file_name=uniqid('pdfdh').".".$filedaftarhadir->getClientOriginalExtension();
				if (is_file(\App\Helpers\Helper::public_path($kegiatan->file_daftar_hadir)))                
				{
					unlink(\App\Helpers\Helper::public_path($kegiatan->file_daftar_hadir));
				}                
				$kegiatan->file_daftar_hadir="storage/pdf/daftarhadir/$file_name";
				$kegiatan->save();
				
				\DB::table('kegiatan')
				->where('kegiatan_id', $kegiatan->id)
				->update([
					'file_daftar_hadir' => $kegiatan->file_daftar_hadir,
				]);

				$filedaftarhadir->move($folder,$file_name);
				return Response()->json([
					'status'=>0,
					'pid'=>'store',
					'kegiatan'=>$kegiatan,                
					'message'=>"File daftar hadir kegiatan penyuluhan hukum ini berhasil diupload"
				], 200);    
			}
			else
			{
				return Response()->json([
					'status'=>1,
					'pid'=>'store',
					'message'=>["Extensi file yang diupload bukan pdf."]
				],422); 
			}
		}
	}
	public function uploaddokumentasikegiatan (Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$kegiatan = KegiatanPenyuluhanHukumModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
									'status'=>0,
									'pid'=>'store',                
									'message'=>["Data kegiatan penyuluhan hukum tidak ditemukan."]
								],422);         
		}
		else
		{
			$this->validate($request, [                      
				'filedokumentasikegiatan'=>'required'                        
			]);
			$name=$kegiatan->nama_pemohon;
			$filedokumentasikegiatan = $request->file('filedokumentasikegiatan');
			$mime_type=$filedokumentasikegiatan->getMimeType();
			if ($mime_type=='application/pdf' || $mime_type=='image/png' || $mime_type=='image/jpeg')
			{
				$folder=\App\Helpers\Helper::public_path('pdf/dokumentasikegiatan/');
				$file_name=uniqid('pdfdh').".".$filedokumentasikegiatan->getClientOriginalExtension();
				if (is_file(\App\Helpers\Helper::public_path($kegiatan->file_dokumentasi_kegiatan)))                
				{
					unlink(\App\Helpers\Helper::public_path($kegiatan->file_dokumentasi_kegiatan));
				}                
				$kegiatan->file_dokumentasi_kegiatan="storage/pdf/dokumentasikegiatan/$file_name";
				$kegiatan->save();

				\DB::table('kegiatan')
				->where('kegiatan_id', $kegiatan->id)
				->update([
					'file_dokumentasi_kegiatan' => $kegiatan->file_dokumentasi_kegiatan,
				]);

				$filedokumentasikegiatan->move($folder,$file_name);
				return Response()->json([
					'status'=>0,
					'pid'=>'store',
					'kegiatan'=>$kegiatan,                
					'message'=>"File dokumentasi kegiatan penyuluhan hukum ini berhasil diupload"
				],200);    
			}
			else
			{
				return Response()->json([
										'status'=>1,
										'pid'=>'store',
										'message'=>["Extensi file yang diupload bukan pdf."]
									],422); 
				

			}
		}
	}
	public function update(Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_UPDATE');

		if ($this->hasRole('paralegal'))
		{
			$kegiatan = KegiatanPenyuluhanHukumModel::where('user_id',$this->getUserid())			
			->find($id);
		}
		else
		{
			$kegiatan = KegiatanPenyuluhanHukumModel::find($id); 
		}		

		if (is_null($kegiatan))
		{
			return Response()->json([
				'status'=>1,
				'pid'=>'fetchdata',
				'message'=>["kegiatan penyuluhan hukum dengan ID ($id) gagal diperoleh"]
			],422);
		}
		else
		{            
			$this->validate($request, [					
				'user_id'=>'required|exists:users,id',
				'nama_kegiatan'=>'required',			
				'tempat_pelaksanaan'=>'required',         
				'tanggal_pelaksanaan'=>'required|date',            
				'jam_pelaksanaan'=>'required',            
				'narasumber'=>'required',
				'peserta'=>'required',
				'jumlah_peserta'=>'required|numeric',			   
				'uraian_kegiatan'=>'required',            			        
				'rekomendasi_kegiatan'=>'required',            
			]);

			$tanggal_pelaksanaan=$request->input('tanggal_pelaksanaan') . ' '.$request->input('jam_pelaksanaan');

			$kegiatan->user_id=$request->input('user_id');             
			$kegiatan->nama_kegiatan=$request->input('nama_kegiatan');             
			$kegiatan->tanggal_pelaksanaan=$tanggal_pelaksanaan;               
			$kegiatan->tempat_pelaksanaan=$request->input('tempat_pelaksanaan');                						
			$kegiatan->narasumber=$request->input('narasumber');             
			$kegiatan->peserta=$request->input('peserta');             
			$kegiatan->jumlah_peserta=$request->input('jumlah_peserta');             
			$kegiatan->uraian_kegiatan=$request->input('uraian_kegiatan');             
			$kegiatan->rekomendasi_kegiatan=$request->input('rekomendasi_kegiatan');                
			
			$kegiatan->save();
			
			\DB::table('kegiatan')
			->where('kegiatan_id', $kegiatan->id)
			->update([				
				'user_id'=>$request->input('user_id'),                
				'tanggal'=>$tanggal_pelaksanaan,                
				'tempat'=>$request->input('tempat_pelaksanaan'),                				             
				'nama_kegiatan'=>$request->input('nama_kegiatan'),                
				'pemohon'=>$request->input('narasumber'),                
				'uraian_kegiatan'=>$request->input('uraian_kegiatan'),                
				'rekomendasi_kegiatan'=>$request->input('rekomendasi_kegiatan'),                				                          
			]);

			return Response()->json([
				'status'=>1,
				'pid'=>'update',
				'kegiatan'=>$kegiatan,
				'message'=>"Update kegiatan penyuluhan hukum berhasil diperoleh"
			],200);
		}
	}
	public function verifikasi(Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_UPDATE');

		if ($this->hasRole(['pmb','superadmin','obh','kumham']))
		{
			$kegiatan = KegiatanPenyuluhanHukumModel::find($id); 

			if (is_null($kegiatan))
			{
				return Response()->json([
									'status'=>0,
									'pid'=>'store',                
									'message'=>["Data kegiatan penyuluhan hukum tidak ditemukan."]
								],422);     

			}
			else
			{
				$kegiatan->id_status=1;
				$kegiatan->save();

				\DB::table('kegiatan')
				->where('kegiatan_id', $kegiatan->id)
				->update([
					'id_status' => 1,
				]);
				
				return Response()->json([
										'status'=>1,
										'pid'=>'update',
										'kegiatan'=>$kegiatan,
										'message'=>"Verifikasi kegiatan penyuluhan hukum berhasil dilakukan"
									],200);
			}
		}
		else
		{
			return Response()->json([
										'status'=>1,
										'pid'=>'update',                                        
										'message'=>"Verifkasi Kegiatan Gagal dilakukan karena tidak memiliki permission"
									],422);
		}

	}
	/**
	 * Menghapus kegiatan
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_DESTROY');

		if ($this->hasRole('paralegal'))
		{
			$kegiatan = KegiatanPenyuluhanHukumModel::where('user_id',$this->getUserid())			
			->find($id);
		}
		else
		{
			$kegiatan = KegiatanPenyuluhanHukumModel::find($id); 
		}		

		if (is_null($kegiatan))
		{
			return Response()->json([
									'status'=>1,
									'pid'=>'destroy',
									'message'=>["kegiatan penyuluhan hukum dengan ID ($id) gagal dihapus"]
								],422);
		}
		else
		{
			$nama_kegiatan=$kegiatan->nama_kegiatan;
			

			\App\Models\System\ActivityLog::log($request,[
																'object' => $kegiatan,
																'object_id' => $kegiatan->id,
																'user_id' => $this->getUserid(),
																'message' => 'Menghapus kegiatan penyuluhan hukum ('.$nama_kegiatan.') berhasil'
															]);
			$kegiatan->delete();
			
			return Response()->json([
										'status'=>1,
										'pid'=>'destroy',
										'message'=>"kegiatan penyuluhan hukum ($nama_kegiatan) berhasil dihapus"
									],200);
		}

	}

	
}