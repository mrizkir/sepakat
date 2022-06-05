<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kegiatan\KegiatanModel;

use Ramsey\Uuid\Uuid;

use mpdf;

use App\Models\UserDesa;

class ReportKegiatanController extends Controller
{
	public function index ()
	{
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
														->where('kegiatan.user_id', $this->getUserid())
														->get();
		}
		elseif ($this->hasRole('kades'))
		{
			$daftar_desa = UserDesa::where('user_id', $this->getUserid())
			->get()
			->pluck('desa_id')
			->toArray();

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
														->join ('usersdesa','usersdesa.user_id','kegiatan.user_id') 
														->whereIn('usersdesa.desa_id', $daftar_desa)                                                                                                
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
								],200);
	}
	public function printpdf (Request $request)
	{
		$this->validate($request, [
			'kegiatan_id'=>'required|exists:kegiatan,kegiatan_id',                                    
		]);
		$kegiatan_id=$request->input('kegiatan_id');

		$kegiatan=KegiatanModel::select(\DB::raw('
												kegiatan.*,
												users.name,
												\'\' AS waktu,
												\'\' AS tanggal_ubah
											'))
											->join('users','users.id','kegiatan.user_id')
											->join('usersdesa','kegiatan.user_id','usersdesa.user_id')
											->find($kegiatan_id);

		$kegiatan->waktu=\App\Helpers\Helper::tanggal('H:m', $kegiatan->tanggal);
		$kegiatan->tanggal=\App\Helpers\Helper::tanggal('d F Y', $kegiatan->tanggal);
		$kegiatan->tanggal_ubah=\App\Helpers\Helper::tanggal('d F Y', $kegiatan->updated_at);
		
		// $kades = User::where('default_role','kades')
		//                 ->where('id',$kegiatan->)

		//                 ->orderBy('username','ASC')
		//                 ->get();           

		$pdf = \Meneses\LaravelMpdf\Facades\LaravelMpdf::loadView('pdf.document', [
																					'kegiatan'=>$kegiatan,
																					'kegiatan_id'=>$kegiatan_id,
																				]);
		$file_pdf=\App\Helpers\Helper::public_path('exported/pdf/')."/$kegiatan_id.pdf";        
		$pdf->save($file_pdf);
		
		$pdf_file="storage/exported/pdf/$kegiatan_id.pdf";

		return Response()->json([
									'status'=>1,
									'pid'=>'fetchdata',
									'kegiatan'=>$kegiatan,                                    
									'pdf_file'=>$pdf_file                                    
								],200);
	}
}