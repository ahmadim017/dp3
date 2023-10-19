<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenispsatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenispsats', function (Blueprint $table) {
            $table->id();
            $table->string('jenispsat');
            $table->string('namamdagang')->nullable();
            $table->string('namamerek')->nullable();
            $table->string('noperizinan')->nullable();
            $table->string('kewenangan')->nullable();
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('jenispsats');
    }
}
