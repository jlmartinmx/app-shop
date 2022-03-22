<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

// 67 0:0
class CategoryController extends Controller
{
    
    public function show(Category $category){
        // aqui se require el metodo paginate() x q en pag show usa el metodo links().
        $products = $category->products()->paginate(10);
        
        return view('categories.show')->with(compact('category','products'));
    }
}
