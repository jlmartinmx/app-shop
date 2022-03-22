<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title',config('app.name'))</title>

    <meta content='width=device-width. initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link  href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link  href="{{ asset('css/material-kit.css') }}" rel="stylesheet" />
    @yield('styles')

  </head>

  <body class="@yield('body-class')"><!-- nav  class="navbar navbar-default navbar-static-top" -->
    <nav class="navbar navbar-transparent navbar-absolute">
      <div class="container">
        <div class="navbar-header">

          <!-- Collapsed Hamburger -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target="#app-navbar-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          
          <!-- Branding Image -->
          <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>

        </div><!-- END navbar-header -->

        <div class="collapse navbar-collapse" id="navigation-example"><!-- div menu -->
          
          <ul class="nav navbar-nav navbar-right">
            @guest
                <li><a href="{{ route('login') }}">Ingresar</a></li>
                <li><a href="{{ route('register') }}">Registro</a></li>
            @else
                <!-- bloque para usuarios logeados -->
                <li class="dropdown"><!-- menu -->
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                      aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <ul class="dropdown-menu" role="menu"><!-- submenu -->
                    <li>
                        <a href="{{ url('/home') }}">Dashboard</a>
                    </li>

                    @if(auth()->user()->admin)
                      <li>                      
                          <a href="{{ url('/admin/categories') }}">Gestionar categorias</a>
                      </li>                    

                      <li>
                          <a href="{{ url('/admin/products') }}">Gestionar productos</a>
                      </li>
                    @endif

                    <li>
                      <a href="{{ route('logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                        Cerrar sesion
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}"
                          method="POST" style="display: none;">
                        {{ csrf_field() }}
                      </form>

                    </li>
                  </ul><!-- end submenu -->

                </li><!-- end menu -->
            @endguest
            <li></li>
            <li></li>
          </ul>

        </div><!-- end div menu -->

      </div>
    </nav>
  
    <div class="wrapper">
      @yield('content')
    </div>
  
  </body>


  <!-- S  C  R  I  P  T  S -->
  <!-- script src="{ asset('js/app.js') }}"></script -->


  <!-- Core JS Files -->
  <script src="{{ asset('js/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{ asset('js/material.min.js')}}"></script>

  <!-- Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('js/nouislider.min.js')}}" type="text/javascript"></script>
  
  <!-- Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/
    bootstrap-datepicker/ -->
  <script src="{{ asset('js/bootstrap-datepicker.js')}}" type="text/javascript"></script>

  <!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the 
    example pages etc -->
    <script src="{{ asset('js/material-kit.js')}}" type="text/javascript"></script>

  @yield('scripts')

</html>