<?php

namespace App\Models\Kegiatan;

use Illuminate\Database\Eloquent\Model;

class KegiatanNegoisasiModel extends Model {    
   /**
   * nama tabel model ini.
   *
   * @var string
   */
  protected $table = 'negoisasi';
  /**
   * primary key tabel ini.
   *
   * @var string
   */
  protected $primaryKey = 'id';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'user_id',
    'nama_pemohon',  
    'tempat_lahir',  
    'tanggal_lahir',  
    'pendidikan',  
    'pekerjaan',  
    'alamat',  
    'tanggal_pelaksanaan',
    'tempat_pelaksanaan',                
    'nama_kegiatan',        
    'uraian_kegiatan',
    'nama_saksi',
    'rekomendasi_kegiatan',
    'file_fotocopy_ktp',
    'file_sktm',            
    'file_dokumentasi_kegiatan',
    'id_status',       
  ];
  /**
   * enable auto_increment.
   *
   * @var string
   */
  public $incrementing = false;
  /**
   * activated timestamps.
   *
   * @var string
   */
  public $timestamps = true;

  public function komentar()
  {
    return $this->hasMany ('App\Models\Kegiatan\KomentarKegiatanModel','kegiatan_id','kegiatan_id')
        ->join('users','komentar.user_id','users.id')
        ->select(\DB::raw('komentar.id,komentar.kegiatan_id,komentar.user_id,users.name,isi_komentar,users.default_role,komentar.created_at,komentar.updated_at'))
        ->orderBy('komentar.created_at','asc');
  }
}