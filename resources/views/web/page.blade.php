@extends('layouts.app')

@section('title', $page->name)
@section('description', $page->description)
@section('canonical', route('page', $page->slug))

@section('header')
  <div class="barBg p-4">
    <h3>{{ $page->categories()->first() ? $page->categories()->first()->name : 'Ediciones El Profesional' }}</h3>
    <h1>{{ $page->name }}</h1>
  </div>
@endsection
@section('content')
<div class="container">
  <div class="card mb-3">
    <img class="card-img-top" src="{{ $page->picture ? $page->picture : '/img/clips/news.jpg' }}" alt="{{ $page->name }}">
    <div class="card-body">
      {!! $page->content !!}
    </div>
  </div>
</div>
@endsection
