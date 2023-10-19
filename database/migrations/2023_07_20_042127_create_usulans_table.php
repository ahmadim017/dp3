<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cadanganpangan')->nullable();
            $table->bigInteger('nik');
            $table->string('nama');
            $table->date('tgllahir');
            $table->enum('jeniskelamin',['laki-laki','Perempuan']);
            $table->longText('alamat');
            $table->string('kelurahan');
            $table->integer('id_kecamatan')->nullable();
            $table->string('file')->nullable();
            $table->longText('keterangan')->nullable();
            $table->integer('created_by');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usulans');
    }
}
