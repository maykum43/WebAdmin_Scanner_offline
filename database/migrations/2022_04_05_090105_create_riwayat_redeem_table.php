<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatRedeemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_redeem', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->integer('jml_poin')->default(0);
            $table->string('nama_hadiah');
            $table->string('status')->nullable()->default('Diproses');
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
        Schema::dropIfExists('riwayat_redeem');
    }
}
