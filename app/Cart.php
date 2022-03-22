<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    // 54 17:08
    // relacion entre Cart y CartDetail
    public function details(){
        return $this->hasMany(CartDetail::class);
    }

    // falta definir la relacion CartDetail <-> Cart en modelo CartDetail

    // accesor para obtener el total del carrito de compras se usa en new-order.blade
    // y home.blade
    public function getTotalAttribute(){
        $total = 0;

        foreach($this->details as $detail){
            $total += $detail->quantity * $detail->product->price;
        }
        return $total;

    }
}
