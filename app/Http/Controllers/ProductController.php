<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

// 50 7:24
// observemos q existe otro ../Http/Controllers/Admin/ProductController pero 
// este esta protegido x Auth es decir solo para usuarios autenticados y como 
// el acceso al carrito  de compras debe ser libre. Se crea este controlador
// ../Http/Controlers/ProductController
// para todos los metodos del carrito de compras.
class ProductController extends Controller{
    public function show($id){
        $product = Product::find($id);

        // obteniendo las imagenes del producto
        $images = $product->images;

        // creando 2 grupos de Imagenes
        $imagesLeft = collect();
        $imagesRight = collect();

        foreach($images as $key => $image){
            if($key%2==0)
                $imagesLeft->push($image);
            else
                $imagesRight->push($image);
        }


    return view('products.show')->with(compact('product','imagesLeft','imagesRight'));
    }
}
