@extends('layouts.app')

@section('title','Listado de productos')
@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">    
</div>

<div class="main main-raised">
    <div class="container">
        
        <div class="section text-center">
            <h2 class="title">Listado de productos</h2>

            <div class="team">
                <div class="row">
                    <div class="row">xxx</div>
                    <a href="{{ url('/admin/products/create') }}" class="btn btn-primary btn-round text-right">Nuevo producto</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="col-md-2 text-center">Nombre</th>
                                <th class="col-md-5 text-center">Descripcion</th>
                                <th class="text-center">Categoria</th>
                                <th class="text-right">Precio</th>
                                <th class="text-right">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>                            
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center">{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->category_name }}</td>
                                    <td class="text-right">$ {{ $product->price }}</td>

                                    
                                    <td class="td-actions text-right">
                                        
                                        <form method="post" action="{{ url('/admin/products/'.$product->id) }}">
                                            {{ csrf_field() }}
                                            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"></input> --}}
                                            {{ method_field('DELETE') }}
                                            {{-- <input type="hidden" name="_method" value="DELETE"></input> --}}
                                            
                                            <!-- 3 botones(i,edit,delete) de columna opciones -->
                                            <a href="{{ url('/products'.'/'.$product->id) }}" rel="tooltip" title="Ver producto" 
                                            class="btn btn-info btn-simple btn-xs" target="_blank">
                                            <i class="fa fa-info"></i>
                                            </a>
                                        
                                            <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" 
                                                rel="tooltip" title="Editar producto" 
                                                class="btn btn-success btn-simple btn-xs">
                                                <i class="fa fa-edit"></i>
                                            </a>                      
                                            
                                            <a href="{{ url('/admin/products/'.$product->id.'/images') }}" rel="tooltip" title="Imagenes del producto" 
                                            class="btn btn-warning btn-simple btn-xs">
                                            <i class="fa fa-image"></i>
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

                    {{ $products->links() }}

                </div><!-- end row -->
            </div><!-- end team -->

        </div><!-- end section -->

    </div><!-- end container -->

</div>

@include('includes.footer')
@endsection