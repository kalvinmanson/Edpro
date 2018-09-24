@extends('layouts.app')

@section('title', 'Ediciones El Profesional')
@section('description', 'La mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.')

@section('content')

<div class="container">
  <div class="bg-white">
    <div class="row">
      <div class="col-md-8 col-lg-9">
        <div class="lineTitle">
          <h2>
            <small>Catalogo</small>
            Ediciones el Profesional
          </h2>
        </div>
        <div class="row py-3">
          @foreach($books as $book)
          <div class="col-sm-6 col-md-4">
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
      </div>
      <div class="col-md-4 col-lg-3">
        <h5>Temas</h5>
        <div class="list-group">
          @foreach($topics as $topic)
          <a href="{{ route('storeTopic', ['topic' => $topic->slug])}}" class="list-group-item bg-light">{{ $topic->name }}</a>
            @foreach($topic->topics as $topicChild)
            <a href="{{ route('storeTopic', ['topic' => $topicChild->slug])}}" class="list-group-item py-1">{{ $topicChild->name }}</a>
            @endforeach
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
