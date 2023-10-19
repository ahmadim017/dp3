<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpg', function (Blueprint $table) {
            $table->id();
	        $table->integer('id_skpgbulan');
            $table->integer('id_bulan');
            $table->integer('id_kecamatan');
            $table->integer('tahun');
            $table->integer('ketersediaan');
            $table->integer('pemanfaatan');
            $table->integer('akses');
            $table->integer('skorkomposit');
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
        Schema::dropIfExists('skpg');
    }
}
