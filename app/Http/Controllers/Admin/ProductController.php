<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

// 31 0:0
class ProductController extends Controller
{
    public function index(){
        // $products = Product::all();
        $products = Product::paginate(10);
        // dd($products);
        return view('admin.products.index')->with(compact('products')); // listado
    }

    public function create(){
        //return "entramos a crear producto";
        $categories = Category::orderBy('name')->get();

        return view('admin.products.create')->with(compact('categories')); // formulario de registro
    }

    public function store(Request $request){  
        // 38 0:0
        // validacion de datos enviados x el formulario
        $messages = [
            'name.required'         => 'Es necesario ingresar un nombre para el producto.',
            'name.min'              => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required'  => 'La descripcion corta es un campo obligatorio.',
            'description.max'       => 'La description corta solo admite hasta 200 caracteres.',
            'price.required'        => 'Es obligatorio definir un precio para el producto.',
            'price.numeric'         => 'Ingrese un precio valido.',
            'price.min'             => 'No se admiten valores negativos.'
        ];

        $rules = [
            'name'          => 'required|min:3',
            'description'   => 'required|max:200',
            'price'         => 'required|numeric|min:0'

        ];
        $this->validate($request,$rules,$messages);

        
        // 34 0:0    
        //dd($request->all());
        $product = new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
        $product->save(); // insert

        // OJO el default de un redirect es method=get x eso se va ProductController@index
        return redirect('/admin/products');
    }// end store()

    // 35 0:0
    public function edit($id){
        //return "entramos a formulario de edicion con id= $id";

        $product = Product::find($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit')->with(compact('product','categories')); // formulario de edicion
    }

    // 35 10:40
    public function update(Request $request,$id){    
        //dd($request->all());

        // 38 16:20
        // validacion de datos enviados x el formulario
        $messages = [
            'name.required'         => 'Es necesario ingresar un nombre para el producto.',
            'name.min'              => 'El nombre del producto debe tener al menos 3 caracteres.',
            'description.required'  => 'La descripcion corta es un campo obligatorio.',
            'description.max'       => 'La description corta solo admite hasta 200 caracteres.',
            'price.required'        => 'Es obligatorio definir un precio para el producto.',
            'price.numeric'         => 'Ingrese un precio valido.',
            'price.min'             => 'No se admiten valores negativos.'
        ];

        $rules = [
            'name'          => 'required|min:3',
            'description'   => 'required|max:200',
            'price'         => 'required|numeric|min:0'

        ];
        $this->validate($request,$rules,$messages);

        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->category_id = $request->category_id;
        $product->save(); // update

        return redirect('/admin/products');
    }// end update()

    // 36 0:0
    public function destroy($id){    
        $product = Product::find($id);
        $product->delete();
    
        return back();// retorno a pagina anterior
    }
}
