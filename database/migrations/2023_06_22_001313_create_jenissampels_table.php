<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenissampelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenissampels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_keamananpangan')->references('id')->on('keamananpangan')->cascadeOnDelete()->nullable();
            $table->string('jenissampel');
            $table->string('hasiluji');
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('jenissampels');
    }
}
