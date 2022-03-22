<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

// 68 3:26
class SearchController extends Controller
{
    public function show(Request $request){
        $query = $request->input('query');
        //dd($query);
        $products = Product::where('name','like',"%$query%")->paginate(5);

        /* ojo tenemos 2 situaciones q pueden ocurrir cuando se teclea un string en campo search de
                welcome.blade 1 es q el string en el campo nos muestre mas de un producto en variable
                $products y 2 q el string sea el nombre completo de un producto x lo q la variable 
                $products solo contendra solo un elemento para saber cual de las 2 situaciones 
                tenemos usamos sig if, en caso de q sea situacion 2 pasamos directamente a mostrar
                el producto y ya no entramos a pag donde se muestra listado de productos.  
        */
        if($products->count() == 1){
            $id = $products->first()->id;
            return redirect("products/$id");// igual a '/products'.$id
        }

        return view('search.show')->with(compact('products','query'));
    }

    // 69 14:52
    // este metodo es usado x el plugin de js typeahead() definido al final de pagina welcome.blade
    public function data(){
        // se usa metodo pluck()  x q solo nos interesa un campo
        $products = Product::pluck('name');
        return $products;

    }


}
