<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Konsultasi\KonsultasiKegiatanModel;

use Ramsey\Uuid\Uuid;

use mpdf;

class ReportKegiatanController extends Controller
{
    public function index ()
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

        $kegiatan=KonsultasiKegiatanModel::select(\DB::raw('
                                                kegiatan.*,
                                                users.name,
                                                \'\' AS waktu,
                                                \'\' AS tanggal_ubah
                                            '))
                                            ->join('users','users.id','kegiatan.user_id')
                                            ->find($kegiatan_id);

        $kegiatan->waktu=\App\Helpers\Helper::tanggal('H:m', $kegiatan->tanggal);
        $kegiatan->tanggal=\App\Helpers\Helper::tanggal('d F Y', $kegiatan->tanggal);
        $kegiatan->tanggal_ubah=\App\Helpers\Helper::tanggal('d F Y', $kegiatan->updated_at);
        

        $pdf = \Meneses\LaravelMpdf\Facades\LaravelMpdf::loadView('pdf.document', [
                                                                                    'kegiatan'=>$kegiatan
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