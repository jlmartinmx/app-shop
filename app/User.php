<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\Cart; no es necesario x q los modelos User y Cart estan en el mismo namespace. 

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // 54 6:0
    // definiendo la relacion entre User y Cart
    public function carts(){
        return $this->hasMany(Cart::class);
    }

    // definiendo el accesor cart_id para usarlo en CartDetailController
    public function getCartAttribute(){
        // obteniendo el carrito activo asociado al usuario autenticado
        $cart = $this->carts()->where('status','Active')->first(); // 6:33

        // validamos si el usuario tiene un carrito activo con sig inf
        if($cart)
            return $cart;

        // si el usuario no tiene un carrito activo se crea uno
        $cart = new Cart();
        $cart->status = 'Active';
        $cart->user_id = $this->id;
        $cart->save();
        return $cart;

    }


}
