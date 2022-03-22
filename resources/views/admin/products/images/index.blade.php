@extends('layouts.app')

@section('title','Imagenes de productos')
@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">    
</div>

<div class="main main-raised">
    <div class="container">
        
        <div class="section text-center">
            <h2 class="title">Imagenes del producto "{{ $product->name }}"</h2>
            
            <div class="panel panel-default">
                <div class="panel-body">

                    <!-- bloque para subir una imagen -->
                    <!-- OJO como el action esta vacio el form toma el url q esta en
                            ese momento en el campo url del navegador. 44 15:07 -->
                    <form method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="photo" required>
        
                        <button type="submit" class="btn btn-primary btn-round">
                            Subir nueva imagen
                        </button>
        
                        <a href="{{ url('/admin/products') }}" class="btn btn-default btn-round">
                            Volver al listado de productos
                        </a>    
                    </form>

                </div>
            </div>

            <!-- lista las imagenes asociadas al producto seleccionado -->
            <div class="row">
                @foreach($images as $image)
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <!-- en esta linea image->url es un accesor definido en modelo ProductImage -->
                                <img src="{{ $image->url }}" width="250">
                                
                                <!-- OJO como el action esta vacio el form toma el url q esta en
                                        ese momento en el campo url del navegador. 46 7:40 -->                                
                                <form method="post" action="">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <!-- este input oculto es para enviar en formulario el id de la imagen q se usara
                                            en metodo ImageController@destroy para eliminar la imagen -->
                                    <input type="hidden" name="image_id" value="{{ $image->id }}">
                                    
                                    <button type="submit" class="btn btn-danger btn-round">
                                        Eliminar imagen
                                    </button>

                                    <!-- 48 0:0 este if es para ponerle un boton con color azul a la imagen q esta marcada como destacada -->
                                    @if($image->featured)
                                        <!-- boton para indicar q la imagen es la marcada como destacada, es importante
                                            notar q es un boton type=botton para q no envie informacion del form x q
                                            esta funcion solo le corresponde al boton de arriba "Eliminar imagen" -->
                                        <button  type="button" class="btn btn-info btn-fab btn-fab-mini btn-round"
                                                rel="tooltip" title="Imagen destacada de este producto">
                                            <i class="material-icons">favorite</i>
                                        </button>
                                    @else
                                        <!-- boton para marcar imagen como destacada -->
                                        <a href="{{ url('/admin/products/'. $product->id.'/images/select/'.$image->id) }}"
                                                class="btn btn-primary btn-fab btn-fab-mini btn-round"
                                                rel="tooltip" title="Destaque esta imagen">
                                            <i class="material-icons">favorite</i>
                                        </a>
                                    @endif
                                    
                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div><!-- end section -->

    </div><!-- end container -->

</div>

@include('includes.footer')
@endsection