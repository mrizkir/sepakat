<?php

namespace App\Http\Controllers\Kegiatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kegiatan\KegiatanModel;
use App\Models\Kegiatan\KomentarKegiatanModel;

use Ramsey\Uuid\Uuid;

class KomentarKegiatanController extends Controller
{
  public function index (Request $request, $id)
  {
    $this->hasAnyPermission('KONSULTASI-KOMENTAR-KEGIATAN_BROWSE');
    
    if ($this->hasRole('paralegal'))
    {
      $kegiatan = KegiatanModel::where('user_id',$this->getUserid())
                      ->find($id);
    }
    else
    {        
      $kegiatan = KegiatanModel::find($id);
    }
    
    if (is_null($kegiatan))
    {
      return Response()->json([
                  'status'=>1,
                  'pid'=>'fetchdata',
                  'message'=>["kegiatan dengan ID ($id) gagal diperoleh"]
                ],422);
    }
    else
    {
      $daftar_komentar=$kegiatan->komentar;
      return Response()->json([
                    'status'=>1,
                    'pid'=>'fetchdata',
                    'daftar_komentar'=>$daftar_komentar,
                    'message'=>'Fetch data daftar komentar berhasil diperoleh.'
                  ],200);
    }
  }    
  public function store(Request $request)
  {
    $this->hasAnyPermission('KONSULTASI-KOMENTAR-KEGIATAN_STORE');

    $this->validate($request, [
      'kegiatan_id'=>'required|exists:kegiatan,kegiatan_id',                        
      'isi_komentar'=>'required',            
    ]);
    $kegiatan_id=$request->input('kegiatan_id');
    $komentar=KomentarKegiatanModel::create([
      'id'=>Uuid::uuid4()->toString(),
      'kegiatan_id'=>$kegiatan_id,                
      'user_id'=>$this->getUserid(),                            
      'isi_komentar'=>$request->input('isi_komentar'),                
    ]);        
    return Response()->json([
                'status'=>1,
                'pid'=>'store',                                
                'message'=>'Data komentar baru berhasil disimpan.'
              ],200);
  }    
  public function update(Request $request,$id)
  {
    $this->hasAnyPermission('KONSULTASI-KOMENTAR-KEGIATAN_UPDATE');
    
  }
  /**
   * Menghapus komentar
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request,$id)
  {
    $this->hasAnyPermission('KONSULTASI-KOMENTAR-KEGIATAN_DESTROY');

    if ($this->hasRole('superadmin'))
    {
      $komentar = KomentarKegiatanModel::find($id);            
    }
    else
    {
      $komentar = KomentarKegiatanModel::where('user_id',$this->getUserid())
                      ->find($id);
    }
    

    if (is_null($komentar))
    {
      return Response()->json([
                  'status'=>1,
                  'pid'=>'destroy',
                  'message'=>["Komentar kegiatan dengan ID ($id) gagal dihapus"]
                ],422);
    }
    else
    {
      
      \App\Models\System\ActivityLog::log($request,[
                                'object' => $komentar,
                                'object_id' => $komentar->kegiatan_id,
                                'user_id' => $this->getUserid(),
                                'message' => 'Menghapus komentar Kegiatan Konsultasi berhasil'
                              ]);
      $komentar->delete();
      
      return Response()->json([
                    'status'=>1,
                    'pid'=>'destroy',
                    'message' => 'Menghapus komentar Kegiatan Konsultasi berhasil'
                  ],200);
    }

  }

  
}