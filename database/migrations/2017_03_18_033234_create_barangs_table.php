<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->char('kode_barang',15)->unique();
            $table->string('nama_barang')->unique();
            $table->integer('stok_awal')->nullable();
             $table->integer('stok_akhir')->nullable();
              // $table->integer('total_stok')->nullable();
              
            $table->integer('satuan_id')->unsigned();
            $table->integer('kategori_id')->unsigned();
            $table->timestamps();

            $table->foreign('satuan_id')->references('id')->on('satuans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('barangs');
    }
}
