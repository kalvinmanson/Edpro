@extends('layouts.app')

@section('title', 'Autor '.$author->name)
@section('description', $author->description)
@section('canonical', route('author', $author->slug))
@section('ogtype', 'books.author')
@section('ogimage', url('/'.$author->picture))

@section('header')
  <div class="barBg p-4">
    <img src="{{ $author->picture }}" class="float-right shadow" width="100">
    <h3>Autor</h3>
    <h2>{{ $author->name }}</h2>
    @if($author->description)
      <p class="p-3 bg-white">{{ $author->description }}</p>
    @endif
  </div>
@endsection

@section('content')
<div class="container py-3">
  <div class="bg-white">
    <div class="row">
      @foreach($author->books as $book)
      <div class="col-sm-6 col-md-4 col-lg-3">
        @include('partials.store.book')
      </div>
      @endforeach
    </div>
    @if($author->books->count() == 0)
      <div class="text-center 404">
        <img src="/img/404.png" class="img-fluid">
        <h2>Nos perdimos</h2>
        <h3>No encontramos libros por tu criterio de búsqueda</h3>
      </div>
    @endif
  </div>
</div>

@endsection
