<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\User;
use App\Mail\NewOrder;

// 59 0:0
class CartController extends Controller
{
    // este metodo debe convertir el carrito de compras activo en un pedido pendiente
    // para q el administrador decida aprovarlo o cancelarlo y para q el admin se 
    // entere q llego una orden(con status=Pending) de cliente se debe enviar un
    // un correo al admin.
    // este metodo se llama cuando el cliente presiona boton de compra en lista de
    // productos seleccionados en el carrito de compras.
    public function update(){
        $client = auth()->user();// cliente conectado.
        $cart = $client->cart; // carrito activo del cliente conectado
        $cart->status = 'Pending';
        $cart->order_date = Carbon::now();// indica q el cliente hizo la compra
        $cart->save();

        // en bloque anterior ya almacenamos en base una orden "Pending"
        // lo q resta es enviar correo a todos los administradores q hay una orden "pending".
        $admins = User::where('admin',true)->get();
        // 70 21:07
        // para crear una instancia de la nueva orden se requiere el cliente q esta en
        // sesion y su carrito activo de compras asociado.
        Mail::to($admins)->send(new NewOrder($client,$cart));

        $notification = 'Tu pedido se ha registrado correctamente. Te contactaremos pronto via mail';
        return back()->with(compact('notification'));
    }
    // 22:42


}
