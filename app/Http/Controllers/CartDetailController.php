<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

// 54 0:0
class CartDetailController extends Controller{
    public function __construct(){
        // 75 1:38
        // de esta forma aplicamos mediante auth la autenticacion a todas las rutas donde
        // intervenga este controlador.
        $this->middleware('auth');
    }

    public function store(Request $request){
        $cartDetail = new CartDetail();
        
        // ojo se definio el accesor user()->cart x q no solo se requiere el cart
        // activo del usuario sino q en caso de no tener el usuario un carrito activo 
        // se le crea uno y se retorna su obj de cart activo en sig instruccion del
        // cual se extrae su id.
        $cartDetail->cart_id = auth()->user()->cart->id;
        $cartDetail->product_id = $request->product_id;
        $cartDetail->quantity = $request->quantity;
        $cartDetail->save();

        // 58 6:23
        $notification = 'El producto se ha cargado al carrito de compras exitosamente.';
        return back()->with(compact('notification')); // regresamos el usuario a la pagina en q se encontraba.
    }

    public function destroy(Request $request){
        /* aqui existe una vulnerabilidad x q desde el formulario en home.blade se puede eliminar un detalle del
            carrito de compras q no pertenece al cliente conectado para evitar esto antes de eliminar el detalle
            se debe validar q el detalle q se quiere eliminar pertenece al carrito activo del usuario */
        $cartDetail = CartDetail::find($request->cart_detail_id);
        
        // 57 0:0
        if($cartDetail->cart_id == auth()->user()->cart->id)
            $cartDetail->delete();

        // 58 0:0    
        $notification = 'El producto se ha eliminado del carrito de compras correctamente.';
        return back()->with(compact('notification')); // regresamos el usuario a la pagina en q se encontraba.
    }
}
