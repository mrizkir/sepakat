<?php

namespace App\Models\DMaster;

use Illuminate\Database\Eloquent\Model;

class DokumenKegiatanModel extends Model {    
     /**
     * nama tabel model ini.
     *
     * @var string
     */
    protected $table = 'dokumen_kegiatan';
    /**
     * primary key tabel ini.
     *
     * @var string
     */
    protected $primaryKey = 'dokumen_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [        
        'dokumen_id',                
        'id_jenis_kegiatan',      
        'nama_dokumen',      
        'status',              
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