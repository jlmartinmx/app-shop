<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // relacion entre product y category
    // $product->category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // relacion entre product y ProductImage
    // $product->images
    public function images(){
        return $this->hasMany(ProductImage::class);

    } 

    // 47 0:0
    // definiendo un accesor para usarlo en welcome.blade.php para q nos retorne
    // la imagen del producto q tenga su campo featured=true y
    // en caso de q el producto no tenga imagenes retorne una imagen default.
    public function getFeaturedImageUrlAttribute(){
        $featuredImage = $this->images()->where('featured',true)->first();

        if(!$featuredImage)
            $featuredImage = $this->images()->first();
        
        if($featuredImage){
            // aqui hacemos uso del accesor definido en modelo de ProductImage
            return $featuredImage->url;
        }

        // en caso de q el producto no tenga ninguna imagen retornamos la img default.
        return '/storage/images/products/default.jpg';
    }

    // accesor para cuando se solicita la categoria de un producto y en caso
    // de no existir la categoria se retorne "General".
    public function getCategoryNameAttribute(){
        if($this->category)
            return $this->category->name;
            
        return "General";
    }

}
