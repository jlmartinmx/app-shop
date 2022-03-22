@extends('layouts.app')

<!-- 67 1:49 -->

@section('title','Resultados de busqueda')
@section('body-class',  'profile-page')

<!-- ojo las clases despues del primer .team es para separar
            los productos verticalmente y q siempre se listen 3 productos x fila.  -->
@section('styles')
    <style>
        .team .row .col-md-4{
            margin-bottom: 5em;
        }
        .team .row{
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display:        flex;
            flex-wrap: wrap;
        }
        .team .row > [class*='col-']{
            display: flex;
            flex-direction: column;
        }        
    </style>
@endsection

@section('content')

<div class="header header-filter" style="background-image: url('/img/examples/city.jpg');"></div>

<div class="main main-raised">
        <div class="profile-content">
            <div class="container">

                <div class="row"><!-- row de categoria -->
                    <div class="profile">

                        <div class="avatar"><!-- imagen del producto -->
                            {{-- OJO aqui la clase img-circle se aplica a imagenes cuadradas para q al generar una imagen 
                                circulo sea circulo perfecto de lo contrario se deforman y en caso de tener una imagen 
                                rectangular y se quiere obtener una imagen circulo se le debe aplicar codigo css 
                                ver video 53 1:59 de udemy, para evitar el problema se debe recomendar al administrador
                                subir solo imagenes cuadras y en caso de q no lo sean debemos recortarlas cuadradas. 
                                Aqui para el campo src se usa un accesor definido en la clase Category (67 3:35)
                                y el proposito es obtener una imagen de un producto q pertenece a la categoria.
                            --}}
                            <img src="/img/lupa.jpg" 
                                    alt="Imagen de una lupa que representa la pagina de resultados" 
                                    class="img-circle img-responsive img-raised">
                        </div>

                        <div class="text-center">
                            <h3 class="title">Resultados de busqueda de productos</h3>
                        </div>

                        @if(session('notification'))
                            <div class="alert alert-success">
                                {{ session('notification') }}
                            </div>
                        @endif

                    </div>
                </div><!-- end row de categoria -->

                <div class="description text-center">
                    <p>Se encontraron {{ $products->count() }} resultados para el termino {{ $query }}.</p>
                </div>
                
                
                <div class="team text-center"><!-- team relacion de productos relacionados a esta categoria -->
                    <div class="row">

                        <!-- en este bloque se imprime cada uno de los productos asociados a la categoria
                            en turno y en caso de q el producto tenga mas de una imagen se toma 
                            solo la primera de la lista -->
                        @foreach($products as $product)
                            <div class="col-md-4">
                                <div class="team-player">
                                    <!-- { $product->images()->first(->image } -->
                                    <img src="{{ $product->featured_image_url }}" 
                                            alt="Thumbnail Image" class="img-raised img-circle">

                                    <h4 class="title">
                                        <a href="{{ url('/products'.'/'.$product->id) }}">{{ $product->name }}</a>
                                    </h4>

                                    <p class="description">{{ $product->description }}</p>

                                </div>
                            </div>
                        @endforeach

                    </div><!-- end row -->

                    <div class="text-center">
                        {{ $products->links() }}
                    </div>

                </div><!-- end team relacion de productos relacionados a esta categoria -->

            </div><!-- end container -->
        </div><!-- end profile-->
</div>

@include('includes.footer')
@endsection
