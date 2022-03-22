<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    // 55 3:11
    // relacion CartDetail <-> product
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
