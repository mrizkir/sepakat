<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\DMaster\JenisKegiatanModel;

class DashboardController extends Controller 
{  
    public function index (Request $request)
    {
        
        $subquery = \DB::table('kegiatan')
                        ->select(\DB::raw('id_jenis_kegiatan,COUNT(kegiatan_id) AS jumlah'))
                        ->groupBy('id_jenis_kegiatan');


        $jenis_kegiatan=JenisKegiatanModel::select(\DB::raw('
                                                jenis_kegiatan.id_jenis,
                                                jenis_kegiatan.nama_jenis,                                                
                                                COALESCE(jumlah,0) AS jumlah'
                                            ))
                                            ->leftJoinSub($subquery,'kegiatan',function($join){
                                                $join->on('kegiatan.id_jenis_kegiatan','=','jenis_kegiatan.id_jenis');
                                            })
                                            ->orderBy('id_jenis','ASC')
                                            ->get();

        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',  
                                    'jenis_kegiatan'=>$jenis_kegiatan,                                                                                                                                   
                                    'message'=>'Fetch data dashboard berhasil.'
                                ],200);
    }
}