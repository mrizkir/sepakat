<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\DMaster\JenisKegiatanModel;
use App\Models\Konsultasi\KonsultasiKegiatanModel;
use App\Models\User;

class DashboardController extends Controller 
{  
	public function index (Request $request)
	{
		
		$subquery = \DB::table('kegiatan')
						->select(\DB::raw('id_jenis_kegiatan,COUNT(kegiatan_id) AS jumlah'))
						->groupBy('id_jenis_kegiatan');

		if ($this->hasRole('paralegal'))
		{
			$jenis_kegiatan=JenisKegiatanModel::select(\DB::raw('
													jenis_kegiatan.id_jenis,
													jenis_kegiatan.nama_jenis,                                                
													COALESCE(jumlah,0) AS jumlah'
												))
												->leftJoinSub($subquery,'kegiatan',function($join){
													$join->on('kegiatan.id_jenis_kegiatan','=','jenis_kegiatan.id_jenis');
												})
												->where('kegiatan.user_id', $this->getUserid())
												->orderBy('id_jenis','ASC')
												->get();
		}
		else
		{
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
		}

		$jumlah_paralegal = User::where('default_role','paralegal')                                                
									->count();     
		
		$jumlah_paralegal_laporan = KonsultasiKegiatanModel::distinct('user_id')
															->count('user_id');     
															
		$jumlah_obh = User::where('default_role','obh')                        
						->count();     

		$jumlah_kades = User::where('default_role','kades')                        
						->count();     

		return Response()->json([
			'status'=>1,
			'pid'=>'fetchdata',
			'jenis_kegiatan'=>$jenis_kegiatan,
			'jumlah_paralegal'=>$jumlah_paralegal,
			'jumlah_paralegal_laporan'=>$jumlah_paralegal_laporan,
			'jumlah_obh'=>$jumlah_obh,
			'jumlah_kades'=>$jumlah_kades,
			'message'=>'Fetch data dashboard berhasil.'
		], 200)->setEncodingOptions(JSON_NUMERIC_CHECK);
	}
}