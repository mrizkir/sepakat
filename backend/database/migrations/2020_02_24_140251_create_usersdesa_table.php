<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersdesaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersdesa', function (Blueprint $table) {
            $table->increments('id');            
            $table->uuid('user_id');                                              
            $table->string('kecamatan_id',7);            
            $table->string('nama_kecamatan',50);
            $table->string('desa_id',10);            
            $table->string('nama_desa',50);
            $table->boolean('locked')->default(0); 
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('kecamatan_id');  
            $table->index('desa_id');  

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
        Schema::dropIfExists('usersdesa');
    }
}