<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
     protected $fillable = ['stok_awal', 'stok_akhir', 'total_stok','barang_id','bmasuk_id','bkeluar_id', 'brusak_id','retur_id'];

     public function barang()
    {
        return $this->belongsTo('App\Barang');
    }

    public function bmasuk()
    {
        return $this->belongsTo('App\Bmasuk');
    }

    public function bkeluar()
    {
        return $this->belongsTo('App\Bkeluar');
    }

    public function brusak()
    {
        return $this->belongsTo('App\Brusak');
    }

    public function retur()
    {
        return $this->belongsTo('App\Retur');
    }
}
