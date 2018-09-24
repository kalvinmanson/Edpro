@extends('layouts.app')

@section('title', 'Ediciones El Profesional')
@section('description', 'La mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.')

@section('content')
  <div id="carroHome" class="carroHome carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php $bannersi = -1; ?>
      @foreach($banners as $banner)
      <li data-target="#carroHome" data-slide-to="{{ $bannersi++ }}" class="{{ $bannersi == 0 ? 'active' : '' }}"></li>
      @endforeach
    </ol>
    <div class="carousel-inner">
      @foreach($banners as $banner)
      <div class="carousel-item <?php if(!isset($bannersitem)) { echo 'active'; $bannersitem = 1; } ?>">
        <a href="{{ $banner->link }}">
          <img class="d-block w-100 animated fadeIn" src="{{ $banner->picture }}" alt="{{ $banner->name }}">
        </a>
        @if($banner->description)
        <div class="carousel-caption d-none d-md-block text-left animated fadeInDown">
          <h5>{{ $banner->name }}</h5>
          <p>{{ $banner->description }}</p>
          <a href="#" class="btn btn-outline-success">Ver más...</a>
        </div>
        @endif
      </div>
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#carroHome" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carroHome" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<div class="container">
  {{-- Last Books --}}
  <div class="bg-white">
    <div class="lineTitle">
      <a href="{{ route('store') }}" class="btn btn-sm btn-outline-success float-right">Ver todos</a>
      <h2>
        <small>Descubre lo libros</small>
        Más vendidos.
      </h2>
    </div>
    <div class="row py-3">
      @foreach($topBooks as $book)
      <div class="col-sm-6 col-md-3">
        <div class="bookList">
          <a href="{{ route('book', $book->slug) }}" class="cover">
            <div class="price py-1 px-2">
              <s>$ {{ $book->old_price > 0 ? number_format($book->old_price) : '' }}</s>
              <span>$ {{ number_format($book->price) }}</span>
            </div>
            <img src="{{ $book->picture or '/img/no-cover.jpg' }}" class="img-fluid">
          </a>
          <h5>
            {{ $book->name }}
            <small>
              {{ $book->publisher->name }}
              @foreach($book->authors as $author)
                {{ $author->name }}
              @endforeach
            </small>
          </h5>
          <div class="text-center">
            <div class="btn-group" role="group" aria-label="Book actions">
              <a href="{{ route('book', $book->slug) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-plus"></i> Info</a>
              <a href="{{ route('cartAdd', $book->id) }}" class="btn btn-sm btn-outline-success"><i class="fas fa-cart-plus"></i> Comprar</a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="lineTitle">
      <h2>
      <h2>
        <small>Actualidad</small>
        Noticias y eventos
      </h2>
    </div>
    <div class="row">
      <div class="col-md-7">
        @foreach($lastPost as $post)
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
      <div class="col-md-5">

      </div>
    </div>
  </div>
</div>

@endsection
