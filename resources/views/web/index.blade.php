@extends('layouts.app')

@section('title', 'Ediciones El Profesional')
@section('description', 'La mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.')

@section('header')
  <div class="row">
    <div class="col-md-4">
      <img src="/img/clips/expopet.jpg" class="img-fluid">
    </div>
    <div class="col-md-8 py-3">
      <h3>Evento:</h3>
      <h2>Expopet 2018</h2>
      <p>Expopet Colombia, Feria Internacional de Animales de Compañía, es la plataforma comercial en donde la mascota es la gran protagonista, en un ambiente de negocios, actualización, familia, entretenimiento y diversión.</p>
      <a href="#" class="btn btn-outline-primary"><i class="fas fa-angle-right"></i> Leer más...</a>
    </div>
  </div>
@endsection

@section('content')
<div class="searchFull">
  <div class="container">

  </div>
</div>
<div class="container">
  {{-- Last Books --}}
  <div class="bg-white shadow my-4 pt-2">
    <div class="lineTitle">
      <a href="{{ route('store') }}" class="btn btn-sm btn-outline-success float-right">Ver todos</a>
      <h2>
        <small>Descubre los libros</small>
        Más vendidos.
      </h2>
    </div>
    <div class="row p-3">
      @foreach($topBooks as $book)
      <div class="col-sm-6 col-md-3">
        @include('partials.store.book')
      </div>
      @endforeach
    </div>
  </div>
</div>
<div class="my-5 p-3 text-center publisherBrands">
  @foreach($publishers as $publisher)
    <a href="{{ route('publisher', $publisher->slug) }}" class="bg-white py-2 px-4 shadow-sm" title="Editorial: {{ $publisher->name }}">
      <img src="{{ $publisher->picture or '/img/editorial.jpg' }}" class="img-fluid" alt="Editorial: {{ $publisher->name }}">
      <h4>{{ $publisher->name }}</h4>
    </a>
  @endforeach
</div>

<div class="container">
  {{-- Last Books --}}
  <div class="bg-white shadow my-4 pt-2">
    <div class="lineTitle">
      <h2>
      <h2>
        <small>Actualidad</small>
        Noticias y eventos
      </h2>
    </div>
    <div class="row px-2">
        @foreach($lastPost as $post)
        <div class="col-md-6">
          <div class="card mb-3">
            <img class="card-img-top" src="{{ $post->picture ? $post->picture : '/img/clips/news.jpg' }}" alt="{{ $post->name }}">
            <div class="card-body">
              <a href="{{ route('blog', $post->slug) }}">
                <h5 class="card-title m-0">{{ $post->name }}</h5>
              </a>
              <p class="card-text p-0 m-0"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
              <p class="card-text">{{ $post->description }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@include('partials.store.lastProducts')
@endsection
