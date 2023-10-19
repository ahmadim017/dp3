<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadanganpanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadanganpangan', function (Blueprint $table) {
            $table->id();
            $table->float('stockawal')->nullable();
            $table->float('pengadaan')->nullable();
            $table->float('penyaluran')->nullable();
            $table->float('stockakhir')->nullable();
            $table->integer('id_bulan');
            $table->integer('tahun');
            $table->string('nokontrak')->nullable();
            $table->date('tglkontrak')->nullable();
            $table->string('filekontrak')->nullable();
            $table->string('tittle')->nullable();
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
        Schema::dropIfExists('cadanganpangan');
    }
}
