@extends('layouts.app')

@section('title', $book->name)
@section('description', $book->description)
@section('canonical', route('book', $book->slug))
@section('ogtype', 'books.book')
@section('ogimage', url('/').$book->picture)
@section('isbn', url('/').$book->isbn)

@section('header')
  <div class="barBg p-4" style="background-image: url(/t.php?src={{ $book->picture or '/img/no-cover.jpg' }}&w=300&h=400)">
    <h4>
      Libro:
    </h4>
    <h2>{{ $book->name }}</h2>
    <p class="text-secondary"><i class="fas fa-users"></i>
    @foreach($book->authors as $author)
      {{ $author->name }},
    @endforeach
    <br><i class="fas fa-tags"></i>
    @foreach($book->topics as $topic)
      {{ $topic->name }},
    @endforeach
    </p>
  </div>
@endsection

@section('content')
<div class="container book py-3">
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <div class="col-md-5">
          <a href="{{ $book->picture or '/img/no-cover.jpg' }}" data-fancybox="gallery">
            <img src="{{ $book->picture or '/img/no-cover.jpg' }}" class="w-100">
          </a>
        </div>
        <div class="col-md-7">
          <h1>{{ $book->name }}</h1>
          <div class="row">
            <div class="col-6">
              @if($book->stock > 0)
                <a href="{{ route('cartAdd', $book->id) }}" class="btn btn-success btn-lg"><i class="fas fa-cart-plus"></i> Agregar al carro</a>
              @else
                <div class="alert alert-warning" role="alert">
                  Este libro se encuentra agotado.
                </div>
              @endif
            </div>
            <div class="col-6">
              <div class="price py-1 px-2">
                <s>$ {{ $book->old_price > 0 ? number_format($book->old_price) : '' }}</s>
                <span>$ {{ number_format($book->price) }}</span>
              </div>
            </div>
          </div>
          <p class="text-secondary">
            ISBN: {{ $book->isbn }}<br>
            Idioma: {{ $book->lang }}<br>
            Páginas: {{ $book->pages }}<br>
            Año: {{ $book->year }}<br>
            Formato: {{ $book->format }} ({{ $book->size_w.'x'.$book->size_h.'x'.$book->size_d }}cm) <br>
            Formato: {{ $book->tags }}
          </p>
          <p>{{ $book->description }}</p>
          <p>Temas:
            @foreach($book->topics as $topic)
              <a href="{{ route('storeTopic', ['topic' => $topic->slug])}}" title="Libros de {{ $topic->name }}">{{ $topic->name }}</a>,
            @endforeach
        </div>
      </div>

      {{-- Tabs --}}
      <ul class="nav nav-tabs mt-3" id="BookTabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="true">
            Comentarios
            <small class="bdge badge-secondary rounded p-1">{{ $book->comments->where('active', true)->count() }}</small>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="false">Detalles</a>
        </li>
      </ul>
      <div class="tab-content py-3" id="BookTabsContent">
        <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
          @include('partials.store.commentForm')
          @foreach($book->comments->where('active', true) as $comment)
          <div class="card">
            <div class="card-body">
              <small class="text-secondary float-right">{{ $comment->created_at->diffForHumans() }}</small>
              <h5>{{ $comment->user->name }}</h5>
              <p class="text-secondary">{{ $comment->content }}</p>
            </div>
          </div>
          @endforeach
        </div>
        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
          <h4>Detalles del libro</h4>
          {!! $book->content or '<p>No hay información.</p>' !!}
          <h4>Tabla de contenidos</h4>
          {!! $book->content_table or '<p>No hay información.</p>' !!}
        </div>
      </div>
      {{-- End Tabs --}}
    </div>
    <div class="col-md-4">
      <a class="float-right" href="{{ route('publisher', $book->publisher->slug) }}" title="Editorial: {{ $book->publisher->name }}">
        <img src="{{ $book->publisher->picture }}" width="80">
      </a>
      <h5>Editorial: {{ $book->publisher->name }}</h5>
      <p class="text-secondary">
        <small>{{ $book->publisher->description }}</small>
        <a href="{{ route('publisher', $book->publisher->slug) }}" title="Editorial: {{ $book->publisher->name }}" class="btn btn-sm btn-primary">
          Libros de {{ $book->publisher->name }}
        </a>
      </p>
      <hr>
      <h5>Autor(es):</h5>
        @foreach($book->authors as $author)
          <p>
            <strong>{{ $author->name }}</strong>,<br>
            <small>{{ str_limit($author->description, 100, '...') }}</small>
            <a href="{{ route('author', $author->slug) }}" title="Autor: {{ $author->name }}" class="btn btn-sm btn-primary">
              Ver libros de {{ $author->name }}
            </a>
          </p>

        @endforeach
    </div>
  </div>


</div>
@endsection
