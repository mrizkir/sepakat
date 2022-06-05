<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanPenyuluhanHukumTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('penyuluhan_hukum', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->uuid('user_id');
      $table->string('nama_kegiatan');
      $table->datetime('tanggal_pelaksanaan');			
			$table->string('tempat_pelaksanaan');			
			$table->string('narasumber');			
      $table->string('peserta');
      $table->integer('jumlah_peserta');						
			$table->text('uraian_kegiatan');			
			$table->text('rekomendasi_kegiatan');
			$table->string('file_daftar_hadir')->nullable();
			$table->string('file_surat_permohonan')->nullable();			
			$table->string('file_dokumentasi_kegiatan')->nullable();
			$table->tinyInteger('id_status');
			$table->timestamps();

			$table->index('user_id');

			$table->foreign('user_id')
					->references('id')
					->on('users')
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
		Schema::dropIfExists('penyuluhan_hukum');
	}
}