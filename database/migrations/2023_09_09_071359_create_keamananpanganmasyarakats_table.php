<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeamananpanganmasyarakatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keamananpanganmasyarakats', function (Blueprint $table) {
            $table->id();
	        $table->string('name');
            $table->string('slug');
            $table->date('tglpelaksanaan')->nullable();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->longText('content')->nullable();
            $table->string('file')->nullable();
            $table->longText('alamat')->nullable();
            $table->integer('jumlah')->nullable();
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
        Schema::dropIfExists('keamananpanganmasyarakats');
    }
}
