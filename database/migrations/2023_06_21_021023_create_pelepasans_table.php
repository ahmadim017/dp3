<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelepasansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelepasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cadanganpangan')->references('id')->on('cadanganpangan')->cascadeOnDelete();
            $table->bigInteger('id_usulan')->nullable();
            $table->integer('id_komoditas');
            $table->string('jumlah');
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
        Schema::dropIfExists('pelepasans');
    }
}
