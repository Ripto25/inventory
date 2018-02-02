<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['kode_kategori', 'nama_kategori'];

    public function kategori(){
    	return	$this->hasMany('App\Kategori');
    }
}
