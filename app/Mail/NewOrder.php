<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\user;
use App\cart;

// 70 15:20
class NewOrder extends Mailable{
    use Queueable, SerializesModels;

    // declarando propiedades(atributos) para esta clase
    public $user;
    public $cart;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,Cart $cart){
        //inicializando propiedades de clase desde este constructor.
        $this->user = $user;
        $this->cart = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        // OJO notese q las propiedades de clase no son necesarias pasarlas en el return para
        // q puedan ser usadas en las vistas.
        // Para ponerle un titulo al email q se envia con esta orden de compra a todos los 
        // administradores se usa metodo subject().
        return $this->view('emails.new-order')->subject('Un cliente ha realizado un nuevo pedido');
    }
}
