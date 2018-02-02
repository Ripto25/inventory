<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['kode_barang', 'nama_barang', 'stok_awal', 'stok_akhir','kategori_id', 'satuan_id'];

    public function satuan(){
    	return $this->belongsTo('App\Satuan');
    }

    public function kategori(){
    	return $this->belongsTo('App\Kategori');
    }

     

     public function bmasuk()
    {
        return $this->hasMany('App\Bmasuk');
    }

    public function bkeluar()
    {
        return $this->hasMany('App\Bkeluar');
    }

    public function retur()
    {
        return $this->hasMany('App\Retur');
    }

   
}
