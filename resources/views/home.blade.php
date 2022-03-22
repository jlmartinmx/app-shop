@extends('layouts.app')

@section('title','App Shop | Dashboard')
@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title  text-center">Dashboard</h2>

            <!-- 58 0:0 -->
            @if (session('notification'))
                <div class="alert alert-success">

                    {{ session('notification') }}
                    
                </div>
            @endif

            <!-- nav-pills 42 0:0 -->
            <ul class="nav nav-pills nav-pills-primary" role="tablist">
                <li class="active">
                    <a href="#dashboard" role="tab" data-toggle="tab">
                        <i class="material-icons">dashboard</i>
                        Carrito de compras
                    </a>
                </li>
                <li>
                    <a href="#schedule" role="tab" data-toggle="tab">
                        <i class="material-icons">schedule</i>
                        Schedule
                    </a>
                </li>
                <li>
                    <a href="#tasks" role="tab" data-toggle="tab">
                        <i class="material-icons">list</i>
                        Pedidos realizados
                    </a>
                </li>
            </ul><!-- end nav-pills -->

            <!-- 56 3:14 -->
            <hr>
            <p>Tu carrito de compras presenta {{ auth()->user()->cart->details->count() }} productos.</p>

            <!-- 55 4:12 -->
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- seccion donde se despliegan los productos del carrito de compras activo del usuario autenticado -->
                    <!-- aqui auth()->user()->cart nos retorna el carrito activo del cliente para luego usar 
                            la relacion cart->details definida en modelo Cart y al final esto nos retorna
                            los detalles del carrito activo del cliente conectado -->
                    @foreach(auth()->user()->cart->details as $detail)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $detail->product->featured_image_url }}" height="50">
                            </td>

                            <td>
                                <!-- este link se repite abajo en columna de opciones.
                                    aqui vemos q el detalle del carrito de compras solo contiene precios y como debemos
                                    colocar el nombre del producto y un link q lleve a la descripcion del producto usamos
                                    la relacion entre modelos CartDetail y Product  detail->product definido en modelo
                                    CartDetail. -->
                                <a href="{{ url('/products'.'/'.$detail->product->id) }}" target="_blank">
                                    {{ $detail->product->name }}
                                </a>
                            </td>

                            <td>$ {{ $detail->product->price }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>$ {{ $detail->quantity * $detail->product->price }}</td>

                            <!-- columna de opciones "ver producto", "eliminar" -->
                            <td class="td-actions">
                                <form method="post" action="{{ url('/cart') }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <input type="hidden" name="cart_detail_id" value="{{ $detail->id }}">

                                    <a href="{{ url('/products'.'/'.$detail->product->id) }}" target="_blank" 
                                        rel="tooltip" title="Ver producto" class="btn btn-info btn-simple btn-xs">
                                        <i class="fa fa-info"></i>                                        
                                    </a>

                                    <button type="submit" rel="tooltip" title="Eliminar" 
                                            class="btn btn-danger btn-simple btn-xs">
                                        <i class="fa fa-times"></i>

                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p><strong>Importe a pagar:</strong>{{ auth()->user()->cart->total }}</p>

            <div class="text-center">
                <form method="post" action="{{ url('/order') }}">
                    {{ csrf_field() }}
                
                    <button class="btn btn-primary btn-round">
                        <i class="material-icons">done</i> Realizar pedido                    
                    </button>
                </form>

            </div>

        </div><!-- end section -->

    </div><!-- end container -->

</div><!-- end main -->

@include('includes.footer')
@endsection
