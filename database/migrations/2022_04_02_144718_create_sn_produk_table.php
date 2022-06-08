<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSnProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sn_produk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sn')->unique();
            $table->string('model');
            $table->decimal('harga', 9, 2);
            $table->integer('discount')->default(0);
            $table->integer('poin')->default(0);
            $table->string('status')->default('aktif');
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
        Schema::dropIfExists('sn_produk');
    }
}
