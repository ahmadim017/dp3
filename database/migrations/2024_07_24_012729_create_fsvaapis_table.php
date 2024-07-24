<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFsvaapisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fsvaapis', function (Blueprint $table) {
            $table->id();
            $table->string('kelurahan');
            $table->integer('tahun');
            $table->integer('indexprioritas');
            $table->float('penyediaanpangan');
            $table->float('kesejahteraanrendah');
            $table->float('aksespenghubung');
            $table->float('aksesairbersih');
            $table->float('jmltenagakesehatan');
            $table->float('luaslahanpertanian');
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
        Schema::dropIfExists('fsvaapis');
    }
}
