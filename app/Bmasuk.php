<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bmasuk extends Model
{

	protected $fillable = ['kode_bm', 'barang_id','jumlah', 'keterangan', 'user', 'peminta', 'divisi'];

    public function stok()
    {
        return $this->hasOne('App\Stok');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }


   // public $timestamps = false;
}
