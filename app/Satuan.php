<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $fillable = ['kode_satuan', 'nama_satuan'];

    public function barang(){
    	return	$this->hasMany('App\Barang');
    }
}
