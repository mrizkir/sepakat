<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokumenKegiatanTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('dokumen_kegiatan', function (Blueprint $table) {
      $table->uuid('dokumen_id')->primary();
      $table->tinyInteger('id_jenis_kegiatan');      
      $table->string('nama_dokumen');
      $table->tinyInteger('status'); //1 wajib 2 tidak wajib
      $table->timestamps();

      $table->index('id_jenis_kegiatan');      
      
      $table->foreign('id_jenis_kegiatan')
          ->references('id_jenis')
          ->on('jenis_kegiatan')
          ->onDelete('cascade')
          ->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('dokumen_kegiatan');
  }
}