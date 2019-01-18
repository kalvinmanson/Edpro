@extends('layouts.app')

@section('title', 'Libros de '.$topic->name)
@section('description', $topic->description)
@section('canonical', route('storeTopic', $topic->slug))
@section('ogtype', 'books.genre')
@section('ogimage', url('/').$topic->picture)

@section('header')
  <div class="barBg p-4">
    <h3>Libros de</h3>
    <h2>{{ $topic->name }}</h2>
  </div>
@endsection

@section('content')
<div class="container py-3">
  <div class="bg-white">
    <div class="row py-3">
      @foreach($books as $book)
      <div class="col-sm-6 col-md-3">
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
</div>

@endsection
