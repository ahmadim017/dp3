<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSosialisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sosialisasis', function (Blueprint $table) {
            $table->id();
            $table->string('namausaha');
            $table->string('nib');
            $table->longText('alamat');
            $table->bigInteger('nohp');
            $table->string('namapelakuusaha');
            $table->string('sertifikat')->nullable();
            $table->string('file')->nullable();
            $table->integer('id_kecamatan');
            $table->string('kelurahan')->nullable();
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
        Schema::dropIfExists('sosialisasis');
    }
}
