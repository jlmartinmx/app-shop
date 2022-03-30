<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
//use League\Flysystem\File; se sustituyo x Storage.
use Illuminate\Support\Facades\Storage;

// 44 4:30
class ImageController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        //dd($product);

        //$images = $product->images;
        // esto es solo para q cuando se muestren las imagenes asociadas al producto siempre
        // se coloque primero la imagen marcada como destacada.
        $images = $product->images()->orderBy('featured','desc')->get();
        //dd($images);
        return view('admin.products/images/index')->with(compact('product','images'));
    }


    // 45 2:26
    // NOTA: se tuvo problemas para usar paquete "File::" x lo q se uso paquete "Storage::" x eso se veran 
    //      algunas lineas comentadas con punto abajo.
    public function store(Request $request,$id){
        // aqui $id es el id del producto al q se le sube la nueva imagen.

        // NOTA: el asignar una nueva imagen a un producto se realiza en 2 partes
        //       q se describen abajo en los 2 bloques.

        //dd('entre a store');
        // bloque para guardar la img en nuestro proyecto
        // 1.- obtenemos el elemento tipo file q se envia en formulario en campo photo
        $file = $request->file('photo');
        // 2.- creamos el path donde se almacenaran nuestras imagenes de productos.
        //.$path = public_path() . '/images/products';
        // con esta ruta el metodo abajo move almacenara la imagen en ../public/storage/images/products 
        $path = 'storage/images/products';
        // 3.- se crea un nombre q se asignara a la imagen q se quiere subir
        $fileName = uniqid() . $file->getClientOriginalName();
        // 4,- accion donde se mueve el archivo q se envio x el formulario a la ruta path
        //      y la variable moved recibe true/false dependiente si la operacion fue exitosa.
        $moved = $file->move($path,$fileName);
        //$file->
        // despues de haber subido la imagen a nuestra aplicacion lo q resta es 
        // registrar en la tabla product_images la nueva imagen asociada al producto
        // seleccionado.
        if($moved){
            $productImage = new ProductImage();
            $productImage->image = $fileName;
            //$productImage->featured = false;
            $productImage->product_id = $id;
            // salvamos el nuevo registro
            $productImage->save();
        }

        // regresamos al usuario donde se encontraba antes
        return back();
    }

    // 46 2:48
    public function destroy(Request $request,$id){
        // para eliminar una imagen asociada a un producto se hace en 2 bloques
        // 1.- se elimina archivo de ../images/products
        // 2.- se elimina registro de esta imagen en la tabla product_images 

        $productImage = ProductImage::find($request->input('image_id'));// tambien valido $request->image_id
        // aqui recordemos q el campo image lo usamos a 2 propositos, 1 guardar el path
        // completo q incluye el nombre de la imagen cuando se toma desde internet y 2 
        // guardar solo el nombre de la imagen x q sabemos q esta guardada dentro del proyecto
        // en la ruta ../public/images/products x tanto con sig linea tenemos q saber de q caso se trata.
        //dd( substr($productImage->image,0,4) );
        if(substr($productImage->image,0,4) == "http" ){
            $deleted = true;
        }else{
            // si entramos aqui significa q el campo image en tabla product_images contiene solo
            // un nombre de imagen lo q significa q se debe eliminar el archivo de ../products/image   
            // para posteriormente pasar a eliminar el registro de la base.
            // 46 4:08, 
            //.$fullPath = public_path() . '/images/products/' . $productImage->image;
            // con metodo Storage::delete busca para eliminar el archivo desde /storage/app y considerando
            // q existe un link de ../public/storage entonces la ruta para eliminar archivos sera public/images/products/nom_file            
            $fullPath = 'public/images/products/' . $productImage->image; 

            // 46 10:20
            //.$deleted = File::delete($fullPath);// deleted almacena true/false dependiendo de resultado.
            $deleted = Storage::delete([$fullPath]);                        
            
            // debug if(Storage::exists('public/images/products/hola.txt')){
            // debug     dd('si existe');
            // debug }else{
            // debug dd('NO existe');
            // debug }
        }

        // si se elimino exitosamente la imagen del proyecto se pasa a eliminar de la base.
        if($deleted){
            $productImage->delete();
        }
        
        return back(); // retornamos al usuario a la pagina anterior.
    }// end destroy()

    // 48 3:44
    // para marcar una imagen como destacada
    public function select($id,$image){
        // antes de destacar a la nueva imagen se debe desmarcar a las que existen 
        // destacadas(featured=true) con sig instruccion donde se obtienen todas las imagenes 
        // asociadas a un producto y con un foreach implicito desmarcamos las imagenes.
        ProductImage::where('product_id',$id)->update(['featured' => false]);

        // ya desmarcadas las imagenes se procede a marcar la nueva imagen.
        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();

        return back();
    }
}
