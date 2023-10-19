<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeamananpanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keamananpangan', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->longText('alamat')->nullable();
            $table->string('lokasisampel');
            $table->date('tglpengambilan');
            $table->string('file')->nullable();
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
        Schema::dropIfExists('keamananpangan');
    }
}
