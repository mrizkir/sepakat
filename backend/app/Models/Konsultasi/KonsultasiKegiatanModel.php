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
        'daftar_hadir',                    
        'fotocopy_ktp',
        'uraian_kegiatan',
        'rekomendasi_kegiatan',
        'dokumentasi_kegiatan',
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
}