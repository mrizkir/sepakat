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
        $this->hasAnyPermission('KONSULTASI-KEGIATAN_BROWSE');

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
                                    'message'=>'Data pasien covid19 baru berhasil disimpan.'
                                ],200);
    }
    /**
     * Menghapus calon mahasiwa baru
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