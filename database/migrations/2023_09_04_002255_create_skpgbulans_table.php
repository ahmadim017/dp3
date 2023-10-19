<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkpgbulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpgbulans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_bulan');
            $table->integer('tahun');
            $table->string('fileik')->nullable();
            $table->string('fileia')->nullable();
            $table->string('fileip')->nullable();
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
        Schema::dropIfExists('skpgbulans');
    }
}
