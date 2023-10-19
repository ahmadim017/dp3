<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeracapanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neracapangan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_komoditas');
            $table->integer('id_satuan')->nullable();
            $table->float('stockminggulalu');
            $table->float('barangmasuk')->nullable();
            $table->float('ketersediaanawal');
            $table->float('ketersediaanakhir');
            $table->integer('harga');
            $table->float('konsumsihari');
            $table->float('konsumsiminggu');
            $table->float('pengadaan')->nullable();
            $table->string('minggu');
            $table->integer('id_bulan');
            $table->integer('tahun');
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
        Schema::dropIfExists('neracapangan');
    }
}
