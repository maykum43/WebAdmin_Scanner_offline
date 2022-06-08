<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiwayatSnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_sn', function (Blueprint $table) {
            $table->bigIncrements('id_rwt');
            $table->string('sn'); //mengambil dari tb_sn
            $table->string('model');
            $table->integer('poin')->default(0);
            $table->string('email'); //ini email_user
            $table->string('status')->default('Belum Selesai');
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('riwayat_sn');
    }
}
