@extends('layouts.app')

@section('title','Bienvenido a App Shop')
@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title  text-center">Editar categoria seleccionada</h2>

            <!-- seccion de errores en formulario -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- 65 14:44 --}}
            <form method="post" action="{{ url('/admin/categories/'.$category->id.'/edit') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre de la categoria</label>
                            <input type="text" class="form-control" name="name"
                                    value="{{ old('name',$category->name) }}">
                        </div>
                    </div>
                </div><!-- end row -->
                
                {{--    
                <textarea class="form-control" placeholder="Descripcion extensa del producto" rows="5"
                        name="long_description"></textarea>
                --}}

                <div class="form-group label-floating">
                    <label class="control-label">Descripcion de la categoria</label>
                    <textarea class="form-control" rows="5" name="description"> 
                        {{ old('description',$category->description) }}
                    </textarea>
                </div>

                <button class="btn btn-primary">Guardar cambios</button>
                <a href="{{ url('/admin/categories/') }}" class="btn btn-default" >Cancelar</a>

            </form>


        </div><!-- end section -->

    </div>

</div>

@include('includes.footer')
@endsection