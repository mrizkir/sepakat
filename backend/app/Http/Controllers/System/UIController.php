<?php

namespace App\Http\Controllers\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\System\ConfigurationModel;
use App\Models\DMaster\TAModel;


class UIController extends Controller {    
    /**
     * digunakan untuk mendapatkan Identitas Perguruan Tinggi
     */
    public function frontend ()
    {
        $config = ConfigurationModel::getCache();        
        $tahun_data = $config['DEFAULT_TA'];        
        $identitas['nama_app']=$config['NAMA_APP'];
        $identitas['nama_app_alias']=$config['NAMA_APP_ALIAS'];        
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',                                    
                                    'tahun_data'=>$tahun_data,                                    
                                    'identitas'=>$identitas,
                                    'message'=>'Fetch data ui untuk front berhasil diperoleh'
                                ],200);  
    }
    /**
     * digunakan untuk mendapatkan Identitas Perguruan Tinggi
     */
    public function admin ()
    {
        $config = ConfigurationModel::getCache();        
        $daftar_ta=TAModel::all();        
        $tahun_data = $config['DEFAULT_TA'];        
        return Response()->json([
                                    'status'=>1,
                                    'pid'=>'fetchdata',  
                                    'daftar_ta'=>$daftar_ta,    
                                    'tahun_data'=>$tahun_data,                                    
                                    'message'=>'Fetch data ui untuk admin berhasil diperoleh'
                                ],200);  
    }
}               