<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// 25 0:0
class ProductImage extends Model
{
    // relacion entre ProductImage y product
    // $productImage->product
    public function product(){
        return $this->belongsTo(Product::class);
    }

    // definiendo un accesor q se usa en ../views/admin/products/image/index.blade
    public function getUrlAttribute(){
        // si el nombre empieza con http
        if(substr($this->image,0,4) === "http"){
            return $this->image;
        }

        // esta ruta tiene como referencia la carpeta public 
        return '/storage/images/products/' . $this->image;
    }


}   
