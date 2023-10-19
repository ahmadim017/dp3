<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrognosaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prognosa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_komoditas');
	        $table->integer('id_bulan');
            $table->integer('tahun');
            $table->float('stockawal')->nullable();
            $table->float('produksi')->nullable();
            $table->float('barangmasuk')->nullable();
            $table->float('totalketersediaan');
            $table->float('kebutuhantahunan');
            $table->float('kebutuhanbulanan');
            $table->float('neraca');
            $table->float('rencanaimpor');
            $table->float('stockakhir');
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
        Schema::dropIfExists('prognosa');
    }
}
