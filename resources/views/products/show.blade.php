@extends('layouts.app')

<!-- 52 6:30 -->

@section('title','App Shop | Dashboard')
@section('body-class', 'profile-page')

@section('content')

<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
        <div class="profile-content">
            <div class="container">

                <div class="row"><!-- row del producto -->
                    <div class="profile">

                        <div class="avatar"><!-- imagen del producto -->
                            {{-- OJO aqui la clase img-circle se aplica a imagenes cuadradas para q al generar una imagen 
                                circulo sea circulo perfecto de lo contrario se deforman y en caso de tener una imagen 
                                rectangular y se quiere obtener una imagen circulo se le debe aplicar codigo css 
                                ver video 53 1:59 de udemy, para evitar el problema se debe recomendar al administrador
                                subir solo imagenes cuadras y en caso de q no lo sean debemos recortarlas cuadradas. --}}
                            <img src="{{ $product->featured_image_url }}" alt="Circle Image" class="img-circle img-responsive img-raised">
                        </div>

                        <div class="name"><!-- nombre y categoria del producto -->
                            <h3 class="title">{{ $product->name }}</h3>
                            <h6>{{ $product->category->name }}</h6>
                        </div>

                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification') }}
                            </div>
                        @endif

                    </div>
                </div><!-- end row del producto -->

                <div class="description text-center">
                    <p>{{ $product->long_description }}</p>
                </div>

                <!-- 53 2:36 boton para q el cliente pueda anadir el producto al carrito de compras 
                                esto abre la ventana modal q su codigo esta al final de este archivo. -->
                <div class="text-center">
                    <button class="btn btn-primary btn-round" data-toggle="modal" data-target="#modalAddToCart">
                        <i class="material-icons">add</i>
                        Anadir al carrito de compras
                    </button>
                </div>


                <div class="row">
                    <div class="col-md-6 col-md-offset-3">

                        <div class="profile-tabs">
                            
                            <div class="nav-align-center">

                                <div class="tab-content gallery">
                                    <div class="tab-pane active" id="studio">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @foreach($imagesLeft as $image)
                                                    <img src="{{ $image->url }}" class="img-rounded" />
                                                @endforeach
                                            </div>
                                            <div class="col-md-6">
                                                @foreach($imagesRight as $image)
                                                    <img src="{{ $image->url }}" class="img-rounded" />
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end gallery -->

                            </div><!-- end nav -->

                        </div><!-- End Profile Tabs -->
                        
                    </div><!-- end offset -->

                </div><!-- end row -->

            </div><!-- end container -->
        </div><!-- end profile-->
</div>

                <!-- 53 4:34 ventana modal para q se pueda seleccionar cuantos productos se quieren comprar -->
                <div class="modal fade" id="modalAddToCart" tabindex="-1" role="dialog" 
                        aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <!-- boton q muestra una x para cerrar la ventana modal -->
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;                                    
                                </button>
                                <h4 class="modal-title" id="myModalLabel">
                                    Seleccionar la cantidad que desea agregar
                                </h4>
                            </div>

                            <form method="post" action="{{ url('/cart') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                <div class="modal-body">
                                    <!-- input para poder incrementar el numero de productos q se quieren comprar -->
                                    <input type="number" name="quantity" value="1" class="form-control">
                                </div>
    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default btn-simple" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-info btn-simple">Anadir al carrito</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

@include('includes.footer')
@endsection
