<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\TextController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//. Route::get('/', function () {
//.    return view('welcome');
//. });
Route::get('/','TestController@welcome');

Auth::routes();

// r u t a s  q  n o  r e q u i e r e n   d e  a u t e n t i c a c i o n 
Route::get('/search','SearchController@show');
// esta ruta se usa para configurar el motor de busqueda en el plugin typeahead q se
// usa campo search en pag welcome.blade y lo q hace metodo data es devolver un arreglo
// con los nombres de los productos.
Route::get('/products/json','SearchController@data');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}','ProductController@show');
// ojo hay dos CategoryController pero uno esta dentro de admin para el administrador
Route::get('/categories/{category}','CategoryController@show');


// r u t a s   c a r r i t o   d e   c o m p r a s(no requieren autenticacion)
Route::post('/cart','CartDetailController@store');// se usa en formulario de show.blade
Route::delete('/cart','CartDetailController@destroy');
Route::post('/order','CartController@update');


// r u t a s   p a r a   a d m i n i s t r a d o r e s
// aqui admin es un alias de AdminMiddleware
// 41 0:0
Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function(){

    // r u t a s  d e  p r o d u c t o s
    Route::get('/products','ProductController@index'); // listado
    Route::get('/products/create','ProductController@create'); // formulario para crear
    Route::post('/products','ProductController@store'); // crear nuevo registro
    Route::get('/products/{id}/edit','ProductController@edit'); // formulario edicion
    Route::post('/products/{id}/edit','ProductController@update'); // actualizar registro
    Route::delete('/products/{id}','ProductController@destroy');

    // listado de imagenes asociadas a un producto y con el listado se muestra un 
    // formulario para poder subir mas imagenes del producto.
    Route::get('/products/{id}/images','ImageController@index'); 
    Route::post('/products/{id}/images','ImageController@store');
    Route::delete('/products/{id}/images','ImageController@destroy');
    Route::get('/products/{id}/images/select/{image}','ImageController@select');// para destacar una imagen
    
    // r u t a s  d e  c a t e g o r i a s
    Route::get('/categories','CategoryController@index'); // listado
    Route::get('/categories/create','CategoryController@create'); // formulario para crear
    Route::post('/categories','CategoryController@store'); // crear nuevo registro
    //.Route::get('/categories/{id}/edit','CategoryController@edit'); // formulario edicion
    Route::get('/categories/{category}/edit','CategoryController@edit'); // formulario edicion
    //.Route::post('/categories/{id}/edit','CategoryController@update'); // actualizar registro
    Route::post('/categories/{category}/edit','CategoryController@update'); // actualizar registro
    Route::delete('/categories/{category}','CategoryController@destroy');
});



