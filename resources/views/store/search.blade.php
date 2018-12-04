@extends('layouts.app')

@section('title', 'Ediciones El Profesional')
@section('description', 'La mejor experiencia y poner a tu disposicion el catalogo de mejor calidad de libros especializados, técnicos y científicos disponibles en el país.')

@section('content')

<div class="container">
  <div class="bg-white">
    <div class="lineTitle">
      <h2>
        <small>Catalogo</small>
        Ediciones el Profesional
      </h2>
    </div>
    <div class="row py-3">
      @foreach($books as $book)
      <div class="col-sm-4 col-md-3">
        @include('partials.store.book')
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
