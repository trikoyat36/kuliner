<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    public function pesanan_detail()

    {
        return $this ->hasMany('App\PesananDetail','makanan_id','id');
    }
}
