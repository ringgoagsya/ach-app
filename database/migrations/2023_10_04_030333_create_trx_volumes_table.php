<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trx_volumes', function (Blueprint $table) {
            $table->id();
            $table->string('id_kamar');
            $table->float('volume_udara');
            $table->timestamps();
            $table->foreign('id_kamar')->references('id_kamar')->on('master_kamars')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trx_volumes');
    }
}
