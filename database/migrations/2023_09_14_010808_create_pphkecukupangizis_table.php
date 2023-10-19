<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePphkecukupangizisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pphkecukupangizis', function (Blueprint $table) {
            $table->id();
            $table->integer('id_bahanpangan');
            $table->float('kkal');
            $table->float('persen')->nullable();
            $table->float('ake')->nullable();
            $table->float('skoraktual')->nullable();
            $table->float('skorake')->nullable();
            $table->float('skorpph')->nullable();
            $table->float('gram')->nullable();
            $table->float('persenprotein')->nullable();
            $table->float('akp')->nullable();
            $table->integer('tahun');
            $table->integer('id_tahun');
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
        Schema::dropIfExists('pphkecukupangizis');
    }
}
