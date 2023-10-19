<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePphketersediaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pphketersediaan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_bahanpangan');
            $table->float('energi')->nullable();
            $table->float('ake')->nullable();
            $table->float('skorriil')->nullable();
            $table->float('skorpph')->nullable();
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
        Schema::dropIfExists('pphktersediaan');
    }
}
