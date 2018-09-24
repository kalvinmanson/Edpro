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
    @include('partials.header')
    <main>
      <div class="container">
        @include('flash::message')
      </div>
      @yield('content')
    </main>
    <footer class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
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
