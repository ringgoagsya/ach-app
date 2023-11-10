<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterKamarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kamars', function (Blueprint $table) {
            $table->string('id_kamar')->primary();
            $table->string('lantai_kamar')->default(0);
            $table->string('ruangan_kamar')->default(0);;
            $table->float('panjang_kamar')->default(0);;
            $table->float('lebar_kamar')->default(0);;
            $table->float('tinggi_kamar')->default(0);;
            $table->float('panjang_ventilasi')->default(0);;
            $table->float('lebar_ventilasi')->default(0);;
            $table->string('keterangan')->nullable();
            $table->string('standart')->nullable();
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
        Schema::dropIfExists('master_kamars');
    }
}
