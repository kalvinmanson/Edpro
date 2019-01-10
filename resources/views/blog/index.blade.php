@extends('layouts.app')

@section('title', 'Actualidad Ediciones el Profesional')
@section('description', 'Blog de actualidad en noticias y eventos para veterinarios y zootecnistas.')
@section('canonical', route('blog'))

@section('header')
  <div class="barBg p-4">
    <h3>Noticias y Novedades</h3>
    <h2>Blog de actualidad.</h2>
  </div>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-lg-9">
      @foreach($posts as $post)
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
      @endforeach
    </div>
    <div class="col-md-4 col-lg-3">
    </div>
  </div>
</div>


@endsection
