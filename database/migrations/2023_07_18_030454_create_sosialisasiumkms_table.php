<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSosialisasiumkmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sosialisasiumkms', function (Blueprint $table) {
            $table->id();
            $table->string('namausaha');
            $table->string('namapelakuusaha');
            $table->string('nohp');
            $table->string('image')->nullable();
	        $table->string('location')->nullable();
            $table->longText('alamat');
            $table->integer('id_kecamatan');
            $table->string('kelurahan')->nullable();
            $table->string('nib')->nullable();
            $table->string('pirt')->nullable();
            $table->string('halal')->nullable();
            $table->string('higenis')->nullable();
            $table->string('npwp')->nullable();
            $table->string('komoditas')->nullable();
            $table->string('produkolahan')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('sosialisasiumkms');
    }
}
