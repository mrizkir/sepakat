<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanMediasiTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mediasi', function (Blueprint $table) {
			$table->uuid('id')->primary();
			$table->uuid('user_id');
			$table->string('nama_pemohon');
			$table->string('tempat_lahir');
			$table->date('tanggal_lahir');
			$table->string('pendidikan');
			$table->string('pekerjaan');
			$table->string('alamat');			
			$table->datetime('tanggal_pelaksanaan');			
			$table->string('tempat_pelaksanaan');			
			$table->string('nama_kegiatan');
			$table->text('uraian_kegiatan');
			$table->string('nama_saksi');
			$table->text('rekomendasi_kegiatan');

			$table->string('file_daftar_hadir')->nullable();
			$table->string('file_fotocopy_ktp')->nullable();
			
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
		Schema::dropIfExists('mediasi');
	}
}