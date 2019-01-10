@extends('layouts.app')

@section('title', 'Ediciones El Profesional')
@section('description', 'La mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.')
@section('canonical', route('store'))

@section('header')
  <div class="barBg p-4">
    <h3>Catálogo 2018</h3>
    <h2>Ediciones el Profesional</h2>
  </div>
@endsection

@section('content')
<div class="container py-3">
  <div class="bg-white">
    <div class="row">
      <div class="col-md-8 col-lg-9">
        <div class="row py-3">
          @foreach($books as $book)
          <div class="col-sm-6 col-md-4">
            @include('partials.store.book')
          </div>
          @endforeach
        </div>
        @if($books->count() == 0)
          <div class="text-center 404">
            <img src="/img/404.png" class="img-fluid">
            <h2>Nos perdimos</h2>
            <h3>No encontramos libros por tu criterio de búsqueda</h3>
          </div>
        @endif
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
