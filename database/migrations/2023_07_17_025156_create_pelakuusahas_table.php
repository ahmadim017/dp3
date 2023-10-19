<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelakuusahasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelakuusahas', function (Blueprint $table) {
            $table->id();
            $table->string('namausaha');
            $table->string('namapelakuusaha');
            $table->bigInteger('nohp');
            $table->longText('alamat')->nullable();
            $table->string('location')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('nib')->nullable();
            $table->string('pirt')->nullable();
            $table->string('halal')->nullable();
            $table->string('sertifikathigenis')->nullable();
            $table->string('npwp')->nullable();
            $table->string('komoditi')->nullable();
            $table->string('jenisolahan')->nullable();
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
        Schema::dropIfExists('pelakuusahas');
    }
}
