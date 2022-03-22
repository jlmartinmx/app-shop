<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // 49 0:0
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->date('order_date')->nullable(); /* fecha en la q el cliente desea recibir su orden??? */
            $table->date('arrived_date')->nullable(); /* fecha en la q la orden es atendida x el vendedor */
            $table->string('status'); // posibles valores(Active,Pending,Approved,Cancelled,Finished)
                                      // Active: el carrito tiene productos pero el cliente aun no compra.
                                      // Pending: el cliente ya compro pero aun no se aprueba x el vendedor. 
                                      // Approved: aprovada x el vendedor.                                                                             
                                      // Cancelled: cancelada x el vendedor. 
                                      // Finished: productos x enviar al cliente.
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
