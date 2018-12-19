@extends('layouts.app')

@section('title', 'Ediciones El Profesional')
@section('description', 'La mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.')

@section('header')
  <a href="/blog/los-gatos-en-la-clinica-diaria-ix" title="Los Gatos en la Clínica Diaria IX">
    <img src="/img/banners/banner-los-gatos-ix.jpg" class="w-100" alt="Los Gatos en la Clínica Diaria IX">
  </a>
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
              <a href="{{ route('post', $post->slug) }}">
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
