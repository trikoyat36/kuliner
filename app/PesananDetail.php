<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
      public function makanan()
     

    {
    return $this->belongsTo('App\Makanan','makanan_id', 'id');
    }

     public function pesanan()
    {
    return $this->belongsTo('App\Pesanan','pesanan_id', 'id');

    
    }
}