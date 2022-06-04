<?php

namespace App\Http\Controllers\Konsultasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Konsultasi\KonsultasiKegiatanModel;

use Ramsey\Uuid\Uuid;

class KonsultasiKegiatanController extends Controller
{
	public function index ()
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_BROWSE');

		if ($this->hasRole('paralegal'))
		{
			$daftar_kegiatan=KonsultasikegiatanModel::select(\DB::raw('
				kegiatan.kegiatan_id,
				users.name,
				kegiatan.nama_kegiatan,
				kegiatan.pemohon,                                                                                                                
				kegiatan.nama_jenis,
				kegiatan.id_status,
				kegiatan.created_at,
				kegiatan.updated_at                                                        
			'))    
			->join ('users','users.id','kegiatan.user_id')
			->where('user_id',$this->getUserid())                                                                                                    
			->get();
		}
		else
		{        
			$daftar_kegiatan=KonsultasikegiatanModel::select(\DB::raw('
				kegiatan.kegiatan_id,
				users.name,
				kegiatan.nama_kegiatan,
				kegiatan.pemohon,                                                                                                                
				kegiatan.nama_jenis,
				kegiatan.id_status,
				kegiatan.created_at,
				kegiatan.updated_at                                                        
			'))    
			->join ('users','users.id','kegiatan.user_id')                                                                                                    
			->get();
		}
		return Response()->json([
									'status'=>1,
									'pid'=>'fetchdata',
									'daftar_kegiatan'=>$daftar_kegiatan,
									'message'=>'Fetch data daftar kegiatan berhasil diperoleh.'
								], 200);
	}
	public function show(Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_SHOW');

		if ($this->hasRole('paralegal'))
		{
			$kegiatan = KonsultasiKegiatanModel::where('user_id',$this->getUserid())
											->find($id);
		}
		else
		{
			$kegiatan = KonsultasiKegiatanModel::find($id);
		}
		

		if (is_null($kegiatan))
		{
			return Response()->json([
									'status'=>1,
									'pid'=>'fetchdata',
									'message'=>["kegiatan konsultasi dengan ID ($id) gagal diperoleh"]
								],422);
		}
		else
		{            
			return Response()->json([
										'status'=>1,
										'pid'=>'fetchdata',
										'kegiatan'=>$kegiatan,
										'message'=>"Kegiatan Konsultasi berhasil diperoleh"
									],200);
		}
	}
	public function store(Request $request)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$this->validate($request, [
			'id_jenis'=>'required|exists:jenis_kegiatan,id_jenis',
			'nama_jenis'=>'required',
			'user_id'=>'required|exists:users,id',
			'nama_kegiatan'=>'required',
			'uraian_kegiatan'=>'required',
			'tanggal_konsultasi'=>'required',
			'jam_konsultasi'=>'required',
			'tempat'=>'required',
			'pemohon'=>'required',
			'rekomendasi_kegiatan'=>'required',            
		]);

		$tanggal_konsultasi=$request->input('tanggal_konsultasi') . ' '.$request->input('jam_konsultasi');
		$kegiatan=KonsultasiKegiatanModel::create([
			'kegiatan_id'=>Uuid::uuid4()->toString(),
			'user_id'=>$request->input('user_id'),                
			'tanggal'=>$tanggal_konsultasi,                
			'tempat'=>$request->input('tempat'),                
			'id_jenis_kegiatan'=>$request->input('id_jenis'),                
			'nama_jenis'=>$request->input('nama_jenis'),                
			'nama_kegiatan'=>$request->input('nama_kegiatan'),                
			'pemohon'=>$request->input('pemohon'),                
			'uraian_kegiatan'=>$request->input('uraian_kegiatan'),                
			'rekomendasi_kegiatan'=>$request->input('rekomendasi_kegiatan'),                
			'id_status'=>0,                            
		]);

		return Response()->json([
									'status'=>1,
									'pid'=>'store',
									'kegiatan'=>$kegiatan,
									'message'=>'Data kegiatan baru berhasil disimpan.'
								],200);
	}
	public function uploadktppemohon (Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$kegiatan = KonsultasiKegiatanModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
									'status'=>0,
									'pid'=>'store',                
									'message'=>["Data Konsultasi Kegiatan tidak ditemukan."]
								],422);         
		}
		else
		{
			$this->validate($request, [                      
				'filektppemohon'=>'required'                        
			]);
			$name=$kegiatan->pemohon;
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

		$kegiatan = KonsultasiKegiatanModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
				'status'=>0,
				'pid'=>'store',                
				'message'=>["Data Konsultasi Kegiatan tidak ditemukan."]
			],422);         
		}
		else
		{
			$this->validate($request, [                      
				'filedaftarhadir'=>'required'                        
			]);
			$name=$kegiatan->pemohon;
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
											'message'=>"File daftar hadir kegiatan ini berhasil diupload"
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
	public function uploaddokumentasikegiatan (Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_STORE');

		$kegiatan = KonsultasiKegiatanModel::find($id); 
		
		if ($kegiatan == null)
		{
			return Response()->json([
									'status'=>0,
									'pid'=>'store',                
									'message'=>["Data Konsultasi Kegiatan tidak ditemukan."]
								],422);         
		}
		else
		{
			$this->validate($request, [                      
				'filedokumentasikegiatan'=>'required'                        
			]);
			$name=$kegiatan->pemohon;
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
											'message'=>"File dokumentasi kegiatan ini berhasil diupload"
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
			$kegiatan = KonsultasiKegiatanModel::where('user_id',$this->getUserid())
											->find($id);
		}
		else
		{
			$kegiatan = KonsultasiKegiatanModel::find($id);
		}
		

		if (is_null($kegiatan))
		{
			return Response()->json([
									'status'=>1,
									'pid'=>'fetchdata',
									'message'=>["kegiatan konsultasi dengan ID ($id) gagal diperoleh"]
								],422);
		}
		else
		{            
			$this->validate($request, [
				'id_jenis'=>'required|exists:jenis_kegiatan,id_jenis',
				'nama_jenis'=>'required',
				'user_id'=>'required|exists:users,id',
				'nama_kegiatan'=>'required',
				'uraian_kegiatan'=>'required',
				'tanggal_konsultasi'=>'required',
				'jam_konsultasi'=>'required',
				'tempat'=>'required',
				'pemohon'=>'required',
				'rekomendasi_kegiatan'=>'required',            
			]);

			$tanggal_konsultasi=$request->input('tanggal_konsultasi') . ' '.$request->input('jam_konsultasi');
			$kegiatan->user_id=$request->input('user_id');             
			$kegiatan->tanggal=$tanggal_konsultasi;               
			$kegiatan->tempat=$request->input('tempat');                
			$kegiatan->id_jenis_kegiatan=$request->input('id_jenis');                
			$kegiatan->nama_jenis=$request->input('nama_jenis');                
			$kegiatan->nama_kegiatan=$request->input('nama_kegiatan');                
			$kegiatan->pemohon=$request->input('pemohon');                
			$kegiatan->uraian_kegiatan=$request->input('uraian_kegiatan');                
			$kegiatan->rekomendasi_kegiatan=$request->input('rekomendasi_kegiatan');
			
			$kegiatan->save();
			

			return Response()->json([
										'status'=>1,
										'pid'=>'update',
										'kegiatan'=>$kegiatan,
										'message'=>"Update Kegiatan Konsultasi berhasil diperoleh"
									],200);
		}
	}
	public function verifikasi(Request $request,$id)
	{
		$this->hasAnyPermission('KONSULTASI-KEGIATAN_UPDATE');

		if ($this->hasRole(['pmb','superadmin','obh','kumham']))
		{
			$kegiatan = KonsultasiKegiatanModel::find($id);

			if (is_null($kegiatan))
			{
				return Response()->json([
									'status'=>0,
									'pid'=>'store',                
									'message'=>["Data Konsultasi Kegiatan tidak ditemukan."]
								],422);     

			}
			else
			{
				$kegiatan->id_status=1;
				$kegiatan->save();

				return Response()->json([
										'status'=>1,
										'pid'=>'update',
										'kegiatan'=>$kegiatan,
										'message'=>"Verifikasi Kegiatan Konsultasi berhasil dilakukan"
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
			$kegiatan = KonsultasiKegiatanModel::where('user_id',$this->getUserid())
											->find($id);
		}
		else
		{
			$kegiatan = KonsultasiKegiatanModel::find($id);
		}
		

		if (is_null($kegiatan))
		{
			return Response()->json([
									'status'=>1,
									'pid'=>'destroy',
									'message'=>["kegiatan konsultasi dengan ID ($id) gagal dihapus"]
								],422);
		}
		else
		{
			$nama_kegiatan=$kegiatan->nama_kegiatan;
			

			\App\Models\System\ActivityLog::log($request,[
																'object' => $kegiatan,
																'object_id' => $kegiatan->kegiatan_id,
																'user_id' => $this->getUserid(),
																'message' => 'Menghapus Kegiatan Konsultasi ('.$nama_kegiatan.') berhasil'
															]);
			$kegiatan->delete();
			
			return Response()->json([
										'status'=>1,
										'pid'=>'destroy',
										'message'=>"Kegiatan Konsultasi ($nama_kegiatan) berhasil dihapus"
									],200);
		}

	}

	
}