@extends('layouts.app')

@section('title', 'Editorial '.$publisher->name)
@section('description', $publisher->description)
@section('canonical', route('publisher', $publisher->slug))

@section('header')
  <div class="barBg p-4">
    <img src="{{ $publisher->picture }}" class="float-right shadow" width="100">
    <h3>Editorial</h3>
    <h2>{{ $publisher->name }}</h2>
    @if($publisher->description)
      <p class="p-3 bg-white">{{ $publisher->description }}</p>
    @endif
  </div>
@endsection

@section('content')
<div class="container py-3">
  <div class="bg-white">
    <div class="row">
      @foreach($publisher->books as $book)
      <div class="col-sm-6 col-md-4 col-lg-3">
        @include('partials.store.book')
      </div>
      @endforeach
    </div>
    @if($publisher->books->count() == 0)
      <div class="text-center 404">
        <img src="/img/404.png" class="img-fluid">
        <h2>Nos perdimos</h2>
        <h3>No encontramos libros por tu criterio de búsqueda</h3>
      </div>
    @endif
  </div>
</div>

@endsection
