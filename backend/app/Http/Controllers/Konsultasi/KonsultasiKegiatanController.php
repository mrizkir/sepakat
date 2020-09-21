<?php

namespace App\Http\Controllers\Konsultasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Konsultasi\KonsultasiKegiatanModel;

use Ramsey\Uuid\Uuid;

class KonsultasikegiatanController extends Controller
{
    public function index ()
    {
        $daftar_kegiatan=KonsultasikegiatanModel::select(\DB::raw('
                                                        kegiatan_id,
                                                        nama_kegiatan,
                                                        pemohon,                                                                                                                
                                                        nama_jenis,
                                                        created_at,
                                                        updated_at                                                        
                                                    '))                                                                                                        
                                                    ->get();
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',
                                    'daftar_kegiatan'=>$daftar_kegiatan,
                                    'message'=>'Fetch data daftar kegiatan berhasil diperoleh.'
                                ],200);
    }
}