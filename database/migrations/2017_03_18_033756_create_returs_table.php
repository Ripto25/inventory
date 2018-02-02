<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returs', function (Blueprint $table) {
            $table->increments('id');
          $table->string('kode_r')->unique();
            $table->integer('barang_id')->unsigned();
            $table->string('keterangan')->nullable();
            $table->integer('jumlah');
            $table->string('user');
            $table->string('peminta');
            $table->string('divisi');
            
            $table->timestamps();
              $table->foreign('barang_id')->references('id')->on('barangs')->onDelete('cascade')->onUpdate('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('returs');
    }
}
