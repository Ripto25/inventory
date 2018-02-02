<?php

use Illuminate\Database\Seeder;
use App\Kategori;
use App\Satuan;
use App\Barang;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Kategori = Kategori::create(['kode_kategori'=>'K001', 'nama_kategori' => 'Kertas']);
        $Satuan = Satuan::create(['kode_satuan' => 'S001', 'nama_satuan' => 'PCS']);
       
    }
}
