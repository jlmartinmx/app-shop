<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

// 65 0:0
class CategoryController extends Controller
{ // 
    public function index(){
        // $categories = Product::all();
        //.$categories = Category::orderBy('id')->paginate(10);
        $categories = Category::orderBy('name')->paginate(10);
        // dd($categories);
        return view('admin.categories.index')->with(compact('categories')); // listado
    }

    public function create(){
        //return "entramos a crear producto";
        return view('admin.categories.create'); // formulario de registro
    }

    public function store(Request $request){  
        // 38 0:0
        // validacion de datos enviados x el formulario
        $messages = [
            'name.required'         => 'Es necesario ingresar un nombre para la categoria.',
            'name.min'              => 'El nombre de la categoria debe tener al menos 3 caracteres.',            
            'description.max'       => 'La description corta solo admite hasta 250 caracteres.',
        ];

        $rules = [
            'name'          => 'required|min:3',
            'description'   => 'max:250'
        ];
        $this->validate($request,$rules,$messages);
        
        // 65 11:35    
        /* NOTA: este bloque se sustituye x sig bloque para crear un registro
        $category = new Category;
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->save(); // insert
        */

        // esta linea es gracias a la asignacion masiva en modelo Category
        Category::create( $request->all() );

        // OJO el default de un redirect es method=get x eso se va CategoryController@index
        return redirect('/admin/categories');
    }// end store()

    // 65 13:48
    /* OJO 65 17:32 aqui cuando llamamos a CategoryController@edit desde index.blade enviamos 
            el id de la categoria q deseamos editar aun cuando en ../routes/web especificamos 
            q en la llamada a la ruta se espera el parametro category
            Route::get('/categories/{category}/edit'
            cuando laravel se da cuenta de esto implicitamente con el id q le llega busca la
            categoria asociada al id x q en la llamada al metodo edit() se declara q debe
            recibir un objeto categoria.
    */
    //.public function edit($id){
    //.    $category = Category::find($id);
        public function edit(Category $category){
        return view('admin.categories.edit')->with(compact('category')); // formulario de edicion
    }

    // 65 16:00
    public function update(Request $request,Category $category){    

        /* OJO esta seccion de validacion de los datos del formulario de edicion se movieron 
                al modelo de Category para ser manejados como atributos de la clase.
        
        // validacion de datos enviados x el formulario
        $messages = [
            'name.required'         => 'Es necesario ingresar un nombre para la categoria.',
            'name.min'              => 'El nombre de la categoria debe tener al menos 3 caracteres.',            
            'description.max'       => 'La description corta solo admite hasta 250 caracteres.',
        ];

        $rules = [
            'name'          => 'required|min:3',
            'description'   => 'max:250'
        ];
        $this->validate($request,$rules,$messages);
        */
        // 65 20:57
        // aqui rules y messages no son metodos de Category sino propiedades.
        $this->validate($request,Category::$rules,Category::$messages);

        $category->update($request->all());

        return redirect('/admin/categories');

    }// end update

    // 65 22:10
    public function destroy(Category $category){            
        $category->delete();
    
        return back();// retorno a pagina anterior
    }  

}
