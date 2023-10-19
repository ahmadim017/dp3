<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePphkonsumsitahunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pphkonsumsitahuns', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('ake');
	        $table->integer('akp')->nullable();
            $table->string('filepph')->nullable();
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
        Schema::dropIfExists('pphkonsumsitahuns');
    }
}
