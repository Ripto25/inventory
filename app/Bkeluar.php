<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bkeluar extends Model
{
    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
