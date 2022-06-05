<?php

namespace App\Http\Controllers\Kegiatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kegiatan\KegiatanMediasiModel;

use Ramsey\Uuid\Uuid;

class KegiatanMediasiController extends Controller
{
	public function index ()
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_BROWSE');

		if ($this->hasRole('paralegal'))
		{
			$daftar_kegiatan=KegiatanMediasiModel::select(\DB::raw('
				mediasi.id,
				users.name,
				mediasi.nama_kegiatan,
				mediasi.nama_pemohon,                                                                                                                				
				mediasi.id_status,
				mediasi.created_at,
				mediasi.updated_at                                                        
			'))    
			->join ('users','users.id','mediasi.user_id')			
			->where('user_id',$this->getUserid())                                                                                                    
			->get();
		}
		else
		{        
			$daftar_kegiatan=KegiatanMediasiModel::select(\DB::raw('
				mediasi.id,
				users.name,
				mediasi.nama_kegiatan,
				mediasi.nama_pemohon,                                                                                                                				
				mediasi.id_status,
				mediasi.created_at,
				mediasi.updated_at                                                        
			'))    
			->join ('users','users.id','mediasi.user_id')    			                                                                         
			->get();
		}
		return Response()->json([
			'status'=>1,
			'pid'=>'fetchdata',
			'daftar_kegiatan'=>$daftar_kegiatan,
			'message'=>'Fetch data daftar kegiatan mediasi berhasil diperoleh.'
		], 200);
	}
	public function show(Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_SHOW');

		if ($this->hasRole('paralegal'))
		{
			$kegiatan = KegiatanMediasiModel::where('user_id', $this->getUserid())			
			->find($id);
		}
		else
		{
			$kegiatan = KegiatanMediasiModel::find($id);
		}
		if (is_null($kegiatan))
		{
			return Response()->json([
				'status'=>1,
				'pid'=>'fetchdata',
				'message'=>["kegiatan mediasi dengan ID ($id) gagal diperoleh"]
			],422);
		}
		else
		{            
			return Response()->json([
				'status'=>1,
				'pid'=>'fetchdata',
				'kegiatan'=>$kegiatan,
				'message'=>"Kegiatan mediasi berhasil diperoleh"
			],200);
		}
	}
	public function store(Request $request)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$this->validate($request, [					
			'user_id'=>'required|exists:users,id',
			'nama_pemohon'=>'required',
			'tempat_lahir'=>'required',
			'tanggal_lahir'=>'required|date',
			'pendidikan'=>'required',
			'pekerjaan'=>'required',
			'alamat'=>'required',
			'nama_kegiatan'=>'required',            
			'tanggal_pelaksanaan'=>'required|date',            
			'nama_kegiatan'=>'required',            
			'tanggal_pelaksanaan'=>'required',            
			'tempat_pelaksanaan'=>'required',            
			'uraian_kegiatan'=>'required',            
			'nama_saksi'=>'required',            
			'rekomendasi_kegiatan'=>'required',            
		]);
		\DB::beginTransaction();
		
		$tanggal_pelaksanaan=$request->input('tanggal_pelaksanaan') . ' '.$request->input('jam_pelaksanaan');
		$uuid = Uuid::uuid4()->toString();
		
		$kegiatan=KegiatanMediasiModel::create([
			'id'=>$uuid,
			'user_id'=>$request->input('user_id'),                
			'nama_pemohon'=>$request->input('nama_pemohon'),                
			'tempat_lahir'=>$request->input('tempat_lahir'),                
			'tanggal_lahir'=>$request->input('tanggal_lahir'),                
			'pendidikan'=>$request->input('pendidikan'),                
			'pekerjaan'=>$request->input('pekerjaan'),                
			'alamat'=>$request->input('alamat'),                
			'nama_kegiatan'=>$request->input('nama_kegiatan'),       
			'tanggal_pelaksanaan'=>$tanggal_pelaksanaan,                
			'tempat_pelaksanaan'=>$request->input('tempat_pelaksanaan'),                			             
			'uraian_kegiatan'=>$request->input('uraian_kegiatan'),                
			'nama_saksi'=>$request->input('nama_saksi'),                
			'rekomendasi_kegiatan'=>$request->input('rekomendasi_kegiatan'),                
			'id_status'=>0,                            
		]);
		
		\DB::table('kegiatan')
		->insert([
			'kegiatan_id'=>$uuid,
			'user_id'=>$request->input('user_id'),                
			'tanggal'=>$tanggal_pelaksanaan,                
			'tempat'=>$request->input('tempat_pelaksanaan'),                
			'id_jenis_kegiatan'=>6,                
			'nama_jenis'=>'Mediasi',                
			'nama_kegiatan'=>$request->input('nama_kegiatan'),                
			'pemohon'=>$request->input('nama_pemohon'),                
			'uraian_kegiatan'=>$request->input('uraian_kegiatan'),                
			'rekomendasi_kegiatan'=>$request->input('rekomendasi_kegiatan'),                
			'id_status'=>0,                            
		]);

		\DB::commit();

		return Response()->json([
			'status'=>1,
			'pid'=>'store',
			'kegiatan'=>$kegiatan,
			'message'=>'Data kegiatan mediasi baru berhasil disimpan.'
		],200);
	}
	public function uploadktppemohon (Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$kegiatan = KegiatanMediasiModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
				'status'=>0,
				'pid'=>'store',                
				'message'=>["Data kegiatan mediasi tidak ditemukan."]
			],422);         
		}
		else
		{
			$this->validate($request, [                      
				'filektppemohon'=>'required'                        
			]);
			$name=$kegiatan->nama_pemohon;
			$filektppemohon = $request->file('filektppemohon');
			$mime_type=$filektppemohon->getMimeType();
			if ($mime_type=='image/png' || $mime_type=='image/jpeg')
			{
				$folder=\App\Helpers\Helper::public_path('images/kegiatan/');
				$file_name=uniqid('img').".".$filektppemohon->getClientOriginalExtension();
				if (is_file(\App\Helpers\Helper::public_path($kegiatan->file_fotocopy_ktp)))                
				{
					unlink(\App\Helpers\Helper::public_path($kegiatan->file_fotocopy_ktp));
				}                
				$kegiatan->file_fotocopy_ktp="storage/images/kegiatan/$file_name";
				$kegiatan->save();
				$filektppemohon->move($folder,$file_name);
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

		$kegiatan = KegiatanMediasiModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
				'status'=>0,
				'pid'=>'store',                
				'message'=>["Data kegiatan mediasi tidak ditemukan."]
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
				$filedaftarhadir->move($folder,$file_name);
				return Response()->json([
					'status'=>0,
					'pid'=>'store',
					'kegiatan'=>$kegiatan,                
					'message'=>"File daftar hadir kegiatan mediasi ini berhasil diupload"
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

		$kegiatan = KegiatanMediasiModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
									'status'=>0,
									'pid'=>'store',                
									'message'=>["Data kegiatan mediasi tidak ditemukan."]
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
				$filedokumentasikegiatan->move($folder,$file_name);
				return Response()->json([
					'status'=>0,
					'pid'=>'store',
					'kegiatan'=>$kegiatan,                
					'message'=>"File dokumentasi kegiatan mediasi ini berhasil diupload"
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
			$kegiatan = KegiatanMediasiModel::where('user_id',$this->getUserid())			
			->find($id);
		}
		else
		{
			$kegiatan = KegiatanMediasiModel::find($id); 
		}		

		if (is_null($kegiatan))
		{
			return Response()->json([
				'status'=>1,
				'pid'=>'fetchdata',
				'message'=>["kegiatan mediasi dengan ID ($id) gagal diperoleh"]
			],422);
		}
		else
		{            
			$this->validate($request, [					
				'user_id'=>'required|exists:users,id',
				'nama_pemohon'=>'required',
				'tempat_lahir'=>'required',
				'tanggal_lahir'=>'required|date',
				'pendidikan'=>'required',
				'pekerjaan'=>'required',
				'alamat'=>'required',
				'nama_kegiatan'=>'required',            
				'tanggal_pelaksanaan'=>'required|date',            
				'nama_kegiatan'=>'required',            
				'tanggal_pelaksanaan'=>'required',            
				'tempat_pelaksanaan'=>'required',            
				'uraian_kegiatan'=>'required',            
				'nama_saksi'=>'required',            
				'rekomendasi_kegiatan'=>'required',            
			]);

			$tanggal_pelaksanaan=$request->input('tanggal_pelaksanaan') . ' '.$request->input('jam_pelaksanaan');

			$kegiatan->user_id=$request->input('user_id');             
			$kegiatan->nama_pemohon=$request->input('nama_pemohon');             
			$kegiatan->tempat_lahir=$request->input('tempat_lahir');             
			$kegiatan->tanggal_lahir=$request->input('tanggal_lahir');             
			$kegiatan->pendidikan=$request->input('pendidikan');             
			$kegiatan->pekerjaan=$request->input('pekerjaan');             
			$kegiatan->alamat=$request->input('alamat');             
			$kegiatan->nama_kegiatan=$request->input('nama_kegiatan');                
			$kegiatan->tanggal_pelaksanaan=$tanggal_pelaksanaan;               
			$kegiatan->tempat_pelaksanaan=$request->input('tempat_pelaksanaan');                			
			$kegiatan->uraian_kegiatan=$request->input('uraian_kegiatan');                
			$kegiatan->nama_saksi=$request->input('nama_saksi');                
			$kegiatan->rekomendasi_kegiatan=$request->input('rekomendasi_kegiatan');
			
			$kegiatan->save();
			
			\DB::table('kegiatan')
			->where('kegiatan_id', $kegiatan->id)
			->update([				
				'user_id'=>$request->input('user_id'),                
				'tanggal'=>$tanggal_pelaksanaan,                
				'tempat'=>$request->input('tempat_pelaksanaan'),                				             
				'nama_kegiatan'=>$request->input('nama_kegiatan'),                
				'pemohon'=>$request->input('nama_pemohon'),                
				'uraian_kegiatan'=>$request->input('uraian_kegiatan'),                
				'rekomendasi_kegiatan'=>$request->input('rekomendasi_kegiatan'),                				                          
			]);

			return Response()->json([
				'status'=>1,
				'pid'=>'update',
				'kegiatan'=>$kegiatan,
				'message'=>"Update Kegiatan mediasi berhasil diperoleh"
			],200);
		}
	}
	public function verifikasi(Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_UPDATE');

		if ($this->hasRole(['pmb','superadmin','obh','kumham']))
		{
			$kegiatan = KegiatanMediasiModel::find($id); 

			if (is_null($kegiatan))
			{
				return Response()->json([
									'status'=>0,
									'pid'=>'store',                
									'message'=>["Data kegiatan mediasi tidak ditemukan."]
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
										'message'=>"Verifikasi Kegiatan mediasi berhasil dilakukan"
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
			$kegiatan = KegiatanMediasiModel::where('user_id',$this->getUserid())			
			->find($id);
		}
		else
		{
			$kegiatan = KegiatanMediasiModel::find($id); 
		}		

		if (is_null($kegiatan))
		{
			return Response()->json([
									'status'=>1,
									'pid'=>'destroy',
									'message'=>["kegiatan mediasi dengan ID ($id) gagal dihapus"]
								],422);
		}
		else
		{
			$nama_kegiatan=$kegiatan->nama_kegiatan;
			

			\App\Models\System\ActivityLog::log($request,[
																'object' => $kegiatan,
																'object_id' => $kegiatan->id,
																'user_id' => $this->getUserid(),
																'message' => 'Menghapus Kegiatan mediasi ('.$nama_kegiatan.') berhasil'
															]);
			$kegiatan->delete();
			
			return Response()->json([
										'status'=>1,
										'pid'=>'destroy',
										'message'=>"Kegiatan mediasi ($nama_kegiatan) berhasil dihapus"
									],200);
		}

	}

	
}