<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

// 19 0:0
class Category extends Model
{
    // declarando como propiedades de este modelo las variables de messages y rules.
    // q se utilizan para validar el formulario de edicion de categorias.
    public static $messages = [
        'name.required'         => 'Es necesario ingresar un nombre para la categoria.',
        'name.min'              => 'El nombre de la categoria debe tener al menos 3 caracteres.',            
        'description.max'       => 'La description corta solo admite hasta 250 caracteres.',
    ];

    public static $rules = [
        'name'          => 'required|min:3',
        'description'   => 'max:250'
    ];


    // para usar asignacion masiva en CategoryController@store
    protected $fillable = ['name','description'];

    // relacion entre category y product
    // $category->products
    public function products(){
        return $this->hasMany(Product::class);
    }
    
    // 67 3:35
    // creacion de accesor
    public function getFeaturedImageUrlAttribute(){
        // obteniendo todos los productos asociados a la categoria y de ellos seleccionamos uno.
        $featuredProduct = $this->products()->first();

        // retornamos a la categoria la imagen del producto seleccionado en linea anterior.
        return $featuredProduct->featured_image_url;
    }


}
