<?php

namespace App\Http\Controllers\DMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DMaster\JenisKegiatanModel;

class JenisKegiatanController extends Controller {  
  /**
   * daftar status mahasiswa
   */
  public function index(Request $request)
  {
    $jenis_kegiatan=JenisKegiatanModel::orderBy('id_jenis','ASC')
      ->get();

    return Response()->json([
      'status'=>1,
      'pid'=>'fetchdata',  
      'jenis_kegiatan'=>$jenis_kegiatan,                                                                                                                                   
      'message'=>'Fetch data jenis kegiatan berhasil.'
    ], 200);     
  }  
}