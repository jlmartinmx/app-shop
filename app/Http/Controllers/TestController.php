<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class TestController extends Controller
{
    public function welcome(){
        /* OJO se encontro un problema con sig linea al obtener las categorias incluyendo aquellas q
                no tiene productos lo q ocasiona un error y para resolverlo se usa metodo has() para q
                el query nos retorne solo las categorias q tienen al menos un producto.    
                $categories = Category::get();
        */
        $categories = Category::has('products')->get();

        return view('welcome')->with(compact('categories'));
    }
}
