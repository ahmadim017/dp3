<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFsvasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fsvas', function (Blueprint $table) {
            $table->id();
            $table->string('kelurahan');
            $table->integer('id_tahun');
            $table->integer('indexprioritas');
            $table->integer('penyediaanpangan');
            $table->integer('kesejahteraanrendah');
            $table->integer('aksespenghubung');
            $table->integer('aksesairbersih');
            $table->integer('jmltenagakesehatan');
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
        Schema::dropIfExists('fsvas');
    }
}
