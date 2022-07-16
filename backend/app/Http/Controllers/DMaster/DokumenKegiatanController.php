<?php

namespace App\Http\Controllers\DMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DMaster\DokumenKegiatanModel;

use Ramsey\Uuid\Uuid;

class DokumenKegiatanController extends Controller {  
  /**
   * daftar status mahasiswa
   */
  public function index(Request $request)
  {
    $dokumen_kegiatan=DokumenKegiatanModel::select(\DB::raw('
      dokumen_kegiatan.dokumen_id,
      dokumen_kegiatan.nama_dokumen,
      dokumen_kegiatan.id_jenis_kegiatan,
      dokumen_kegiatan.status,
      jenis_kegiatan.nama_jenis,
      dokumen_kegiatan.created_at,
      dokumen_kegiatan.updated_at      
    '))
    ->join('jenis_kegiatan', 'jenis_kegiatan.id_jenis', 'dokumen_kegiatan.id_jenis_kegiatan')
    ->orderBy('id_jenis_kegiatan','ASC')
    ->get();

    return Response()->json([
      'status'=>1,
      'pid'=>'fetchdata',  
      'dokumen_kegiatan'=>$dokumen_kegiatan,                                                                                                                                   
      'message'=>'Fetch data dokumen kegiatan berhasil.'
    ], 200);     
  }  
  public function store(Request $request)
	{
		$this->hasAnyPermission('DMASTER-DOKUMEN-KEGIATAN_STORE');

		$this->validate($request, [			
			'nama_dokumen'=>'required',				
			'id_jenis_kegiatan'=>'required',			
		]);				

		$nama_dokumen = strtoupper($request->input('nama_dokumen'));	
		$jenis_kegiatan = $request->input('id_jenis_kegiatan');	
		
		foreach ($jenis_kegiatan as $id_jenis_kegiatan)
		{
			DokumenKegiatanModel::create([
				'dokumen_id'=>Uuid::uuid4()->toString(),
				'nama_dokumen'=>$nama_dokumen,                			
				'id_jenis_kegiatan'=>$id_jenis_kegiatan,
				'status'=>1,
			]);
		}

		return Response()->json([
			'status'=>1,
			'pid'=>'store',
			'jenis_kegiatan'=>$jenis_kegiatan,
			'message'=>"Data dokumen $nama_dokumen kegiatan baru berhasil disimpan."
		], 200);
	}
  /**
	 * Menghapus kegiatan
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request,$id)
	{
		$this->hasAnyPermission('DMASTER-DOKUMEN-KEGIATAN_DESTROY');

		$dokumen = DokumenKegiatanModel::find($id); 

		if (is_null($dokumen))
		{
			return Response()->json([
        'status'=>1,
        'pid'=>'destroy',
        'message'=>["Dokumen kegiatan dengan ID ($id) gagal dihapus"]
      ],422);
		}
		else
		{
			$nama_dokumen=$dokumen->nama_dokumen;			

			\App\Models\System\ActivityLog::log($request,[
        'object' => $dokumen,
        'object_id' => $dokumen->dokumen_id,
        'user_id' => $this->getUserid(),
        'message' => 'Menghapus Dokumen Kegiatan ('.$nama_dokumen.') berhasil'
      ]);

			$dokumen->delete();
			
			return Response()->json([
        'status'=>1,
        'pid'=>'destroy',
        'message'=>"Menghapus Dokumen Kegiatan ($dokumen) berhasil dihapus"
      ], 200);
		}

	}
}