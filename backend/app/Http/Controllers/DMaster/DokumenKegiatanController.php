<?php

namespace App\Http\Controllers\DMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DMaster\DokumenKegiatanModel;

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
}