<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
   public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
}
