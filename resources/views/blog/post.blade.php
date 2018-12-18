@extends('layouts.app')

@section('title', $post->name)
@section('description', $post->description)

@section('header')
  <div class="barBg p-4">
    <h3>Noticias y Novedades</h3>
    <h1>{{ $post->name }}</h1>
  </div>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-lg-9">
      <div class="card mb-3">
        <img class="card-img-top" src="{{ $post->picture ? $post->picture : '/img/clips/news.jpg' }}" alt="{{ $post->name }}">
        <div class="card-body">
          <a href="{{ route('post', $post->slug) }}">
            <h5 class="card-title m-0">{{ $post->name }}</h5>
          </a>
          <p class="card-text p-0 m-0"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
          <p class="card-text">{{ $post->description }}</p>
          <hr>
          {!! $post->content !!}
        </div>
      </div>
    </div>
    <div class="col-md-4 col-lg-3">
    </div>
  </div>
</div>
@endsection
