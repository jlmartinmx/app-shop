@extends('layouts.app')

@section('title','Bienvenido a App Shop')
@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title  text-center">Editar producto seleccionado</h2>

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

            {{-- 34 0:0 --}}
            <form method="post" action="{{ url('/admin/products/'.$product->id.'/edit') }}">
                {{ csrf_field() }}

                <div class="row"><!-- row1 -->
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nombre del producto</label>
                            <input type="text" class="form-control" name="name"
                                    value="{{ old('name',$product->name) }}">
                        </div>
                    </div>
    
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Precio del producto</label>
                            <input type="number" step="0.01" class="form-control" name="price"
                            value="{{ old('price',$product->price) }}">
                        </div>
                    </div>
                </div><!-- end row1 -->
                
                <div class="row"><!-- row2 -->
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Descripcion corta</label>
                            <input type="text" class="form-control" name="description" 
                                    value="{{ old('description',$product->description) }}">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label">Categoria del producto</label>
                            <select class="form-control" name="category_id">
                                <option value="">General</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"  
                                            @if($category->id == old('category_id',$product->category_id)) selected @endif>
                                        {{ $category->name }}                                    
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div><!-- end row2 -->

                <div class="form-group label-floating">
                    <label class="control-label">Descripcion extensa del producto</label>
                    <textarea class="form-control" rows="5" name="long_description"> 
                        {{ old('long_description',$product->long_description) }}
                    </textarea>
                </div>

                <button class="btn btn-primary">Guardar cambios</button>
                <a href="{{ url('/admin/products/') }}" class="btn btn-default" >Cancelar</a>

            </form>


        </div><!-- end section -->

    </div>

</div>

@include('includes.footer')
@endsection