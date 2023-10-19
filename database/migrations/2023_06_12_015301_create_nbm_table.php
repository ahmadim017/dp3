<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNbmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nbm', function (Blueprint $table) {
            $table->id();
            $table->integer('id_bahanpangan');
            $table->float('kalori');
            $table->float('protein');
            $table->float('lemak');
            $table->integer('id_kategori');
            $table->integer('id_tahun');
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
        Schema::dropIfExists('nbm');
    }
}
