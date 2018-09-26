<header class="animated fadeInDown">
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
          <img src="/img/logo-ediciones-el-profesional-w.png" class="img-fluid py-2" alt="Ediciones El Profesional LTDA.">
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
            <a href="#" class="text-white">Mi cuenta</a> |
            <a href="{{ route('logout') }}" class="text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Salir <i class="fas fa-power-off"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          @endguest
          </div>
        </div>
      </div>
    </div>
  </div>
  <nav class="navbar navbar-expand-md navbar-light p-0">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav mr-auto navbar-justify">
          <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">Actualidad</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="collapse" href="#catalogo">Catálogo</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Eventos</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Promociones</a></li>
        </ul>
        <form action="{{ route('search') }}" method="GET" class="form-inline my-2 my-lg-0">
          <input class="form-control" name="q" type="search" placeholder="{{ Request::get('q') ? Request::get('q') : 'Equinos...' }}" aria-label="Buscar">
          <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </nav>
  <div class="container collapse" id="catalogo">
    <div class="card card-body">
      <div class="row">
        <div class="col-md-8">
          <h4>Temas</h4>
          <ul class="menuColumns">
            @foreach(App\Topic::where('parent_id', 0)->get() as $topic)
              <li>
                <a href="{{ route('storeTopic', ['topic' => $topic->slug])}}" title="Libros de {{ $topic->name }}">{{ $topic->name }}</a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="col-md-4">
          <h4>Recomendado</h4>
          @foreach(App\Book::orderBy('rank', 'desc')->limit(1)->get() as $book)
            <div class="card">
              <div class="card-body">
                <div class="miniBook">
                  <img src="{{ $book->picture or '/img/no-cover.jpg' }}" class="img-fluid">
                  <a href="{{ route('book', $book->slug) }}" title="Libro: {{ $book->name }}">
                    <h5>{{ $book->name }}</h5>
                  </a>
                  <small>
                    {{ $book->publisher->name }}
                    @foreach($book->authors as $author)
                      {{ $author->name }}
                    @endforeach
                  </small>
                  <div class="price py-1 px-2">
                    <s>$ {{ $book->old_price > 0 ? number_format($book->old_price) : '' }}</s>
                    <span>$ {{ number_format($book->price) }}</span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</header>
