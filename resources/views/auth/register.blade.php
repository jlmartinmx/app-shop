@extends('layouts.app')

@section('body-class','signup-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/city.jpg') }}'); 
            background-size: cover; background-position: top center;">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                
                <div class="card card-signup">

                    <form class="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="header header-primary text-center">
                            <h4>Registro</h4>
                        </div>

                        <p class="text-divider">Completa tus datos</p>
                        
                        <div class="content">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">face</i></span>                                                                    
                                <input id="name" type="text" placeholder="Nombre"  class="form-control" 
                                        name="name" value="{{ old('name') }}" required autofocus />
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">email</i></span>                                                                    
                                <input id="email" type="email" placeholder="Correo electronico"  class="form-control" 
                                        name="email" value="{{ old('email') }}" required />
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">lock_outline</i></span>                                                                    
                                <input id="password" type="password" placeholder="Contraseña"  class="form-control" 
                                        name="password" required />
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="material-icons">lock_outline</i></span>                                                                    
                                <input type="password" placeholder="Confirmar contraseña"  class="form-control" 
                                        name="password_confirmation" required />
                            </div>

                        </div><!-- end content -->

                        <div class="footer text-center">
                            <button type="submit" class="btn btn-simple btn-primary btn-lg">Confirmar Registro</button>
                        </div>
                        <!-- <a class="btn btn-link" href="{ route('password.request') }}">
                            Forgot Your Password?
                        </a> -->
                    </form>

                </div><!-- end card -->
            </div>
        </div><!-- end row -->
    </div><!-- end container -->

    @include('includes.footer')
</div>
@endsection
