<?php

namespace App\Models\Konsultasi;

use Illuminate\Database\Eloquent\Model;

class KonsultasiKegiatanModel extends Model {    
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'kegiatan';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'kegiatan_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kegiatan_id',
        'user_id',
        'tanggal',
        'tempat',
        'id_jenis_kegiatan',
        'nama_jenis',
        'nama_kegiatan',        
        'pemohon',                    
        'file_daftar_hadir',                    
        'file_fotocopy_ktp',
        'uraian_kegiatan',
        'rekomendasi_kegiatan',
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
        return $this->hasMany ('App\Models\Konsultasi\KomentarKegiatanModel','kegiatan_id','kegiatan_id')
                ->join('users','komentar.user_id','users.id')
                ->select(\DB::raw('komentar.id,komentar.kegiatan_id,komentar.user_id,users.name,isi_komentar,komentar.created_at,komentar.updated_at'))
                ->orderBy('komentar.created_at','asc');
    }
}