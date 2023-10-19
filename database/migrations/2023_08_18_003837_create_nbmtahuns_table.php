<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbmtahunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nbmtahuns', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('kalori');
            $table->integer('protein');
            $table->integer('lemak');
            $table->string('filenbm')->nullable();
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
        Schema::dropIfExists('nbmtahuns');
    }
}
