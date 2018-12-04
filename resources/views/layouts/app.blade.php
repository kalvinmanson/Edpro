<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">

</head>
<body>
  <div id="app">
    <header>
      <div class="miniTop">
        <div class="container">
          <ul>
            <li><a href="#">Sobre nosotros</a></li>
            <li><a href="#">Contacto</a></li>
            <li><a href="#">Ayuda</a></li>
            <li><a href="#">Español</a></li>
          </ul>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <a href="{{ route('home') }}" title="Ediciones El Profesional LTDA.">
              <img src="/img/logo-ediciones-el-profesional-w.png" class="img-fluid py-4" alt="Ediciones El Profesional LTDA.">
            </a>
          </div>
          <div class="col-md-10">
            <div class="topCart">
              <cart session="{{ Session::getId() }}"></cart>
              <div class="loginBox p-3 text-right float-right">
              @guest
                <a href="{{ route('login') }}" class="text-white">Iniciar sesión</a> <br>
                <a href="{{ route('register') }}" class="text-white">¿Eres nuevo? Registrate</a>
              @else
                <span class="text-white">{{ Auth::user()->name }}</span> <br>
                <a href="{{ route('orders.index') }}" class="text-white">Mi cuenta</a> |
                <a href="{{ route('logout') }}" class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir <i class="fas fa-power-off"></i></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              @endguest
              </div>
            </div>
          </div>
        </div>
        <div class="mainMenu shadow">
          <nav class="navbar navbar-expand-md navbar-light p-0">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto navbar-justify">
                  <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">Actualidad</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ route('store') }}">Catálogo</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Eventos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Promociones</a></li>
                </ul>
                <form action="{{ route('search') }}" method="GET" class="form-inline my-2 my-lg-0">
                  <input class="form-control bg-transparent border-0" name="q" type="search" placeholder="{{ Request::get('q') ? Request::get('q') : 'Buscar...' }}" aria-label="Buscar">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
              </div>
          </nav>

          <div class="subHeader">
            @yield('header')
          </div>
        </div>
      </div>
    </header>
    <main>
      <div class="container">
        @include('flash::message')
        @include('partials.errors')
      </div>
      @yield('content')
    </main>
    <div class="newsLetter py-5 text-center">
      <h3 class="text-white shadow">No te pierdas nuestas promociones y eventos</h3>
    </div>
    <footer class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <img src="/img/logo-ediciones-el-profesional-w.png" class="img-fluid py-4" alt="Ediciones El Profesional LTDA.">
            <address class="text-white">
              <i class="fa fa-phone"></i> 281 09 31 -  FAX: 243 07 39<br>
              <i class="fa fa-map-marker"></i> AVENIDA JIMENEZ No 12-42 OF. 602,<br>
              Bogotá, Colombia
          </address>
          </div>
        </div>
        <p>
          <small>
            &copy; 2018 Todos los derechos reservados por Ediciones el Profesional LTDA.<br>
            Desarrollado por <a href="//droni.co" title="Desarrollo Inteligente">Droni.co</a>.
          </small>
        </p>
      </div>
    </footer>
  </div>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</body>
</html>
