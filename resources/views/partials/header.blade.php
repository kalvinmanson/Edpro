<header class="bg-white animated fadeInDown">
  <div class="miniTop">
    <div class="container">
      <ul>
        <li><a href="#">Sobre nosotros</a></li>
        <li><a href="#">Contacto</a></li>
        <li><a href="#">Ayuda</a></li>
        <li><a href="#">Español</a></li>
        <li><a href="/cart">Cart</a></li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <a href="{{ route('home') }}" title="Ediciones El Profesional LTDA.">
          <img src="/img/logo-ediciones-el-profesional.png" class="img-fluid py-2" alt="Ediciones El Profesional LTDA.">
        </a>
      </div>
      <div class="col-md-10">
        <div class="topCart">
          <cart session="{{ Session::getId() }}"></cart>
          <div class="loginBox p-3 text-right float-right">
          @guest
            <a href="{{ route('login') }}">Iniciar sesión</a> <br>
            <a href="{{ route('register') }}">¿Eres nuevo? Registrate</a>
          @else
            {{ Auth::user()->name }} <br>
            <a href="#">Mi cuenta</a> |
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir <i class="fas fa-power-off"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          @endguest
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-md navbar-light">
      <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto navbar-justify">
              <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">Noticias y Novedades</a></li>
              <li class="nav-item"><a class="nav-link" href="{{ route('store') }}">Catálogo</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Eventos</a></li>
              <li class="nav-item"><a class="nav-link" href="#">Promociones</a></li>
            </ul>
            <form action="{{ route('search') }}" method="GET" class="form-inline my-2 my-lg-0">
              <input class="form-control" name="q" type="search" placeholder="{{ Request::get('q') ? Request::get('q') : 'Equinos...' }}" aria-label="Buscar">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
          </div>
      </div>
  </nav>
</header>
