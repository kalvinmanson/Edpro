@extends('layouts.app')

@section('title', 'Ediciones El Profesional')
@section('description', 'La mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.')

@section('content')
<div class="container">
  <div class="lineTitle">
    <h2>
      <small>Noticias y Novedades</small>
      Blog de actualidad.
    </h2>
  </div>
  <div class="row">
    <div class="col-md-8 col-lg-9">
      @foreach($posts as $post)
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
      @endforeach
    </div>
    <div class="col-md-4 col-lg-3">

    </div>
  </div>
</div>


@endsection
