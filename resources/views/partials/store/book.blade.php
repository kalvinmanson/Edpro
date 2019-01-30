<div class="bookList mb-3 p-2 bg-white">
  <a href="{{ route('book', $book->slug) }}" title="Libro: {{ $book->name }}" class="cover">
    <div class="price py-1 px-2">
      {!! $book->old_price > 0 ? '<s>$ '.number_format($book->old_price).'</s>' : '' !!}
      <span>$ {{ number_format($book->price) }}</span>
    </div>
    <img src="/t.php?src={{ $book->picture or '/img/no-cover.jpg' }}&w=300&h=400" class="w-100">
  </a>

  <h5 class="py-2">
    <a href="{{ route('book', $book->slug) }}" title="Libro: {{ $book->name }}">{{ $book->name }}</a>
  </h5>
  <p>
    <small>
      <a href="{{ route('publisher', $book->publisher->slug) }}" title="Editorial: {{ $book->publisher->name }}">
        <i class="far fa-bookmark"></i> {{ $book->publisher->name }}
      </a><br>
      <i class="far fa-user"></i>
      @foreach($book->authors as $author)
        <a href="{{ route('author', $author->slug) }}" title="Autor: {{ $author->name }}">
          {{ $author->name }},
        </a>
      @endforeach
    </small>
  </p>
  <div class="text-center">
    <div class="btn-group" role="group" aria-label="Book actions">
      <a href="{{ route('book', $book->slug) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-plus"></i> Info</a>
      @if($book->stock > 0)
        <a href="{{ route('cartAdd', $book->id) }}" class="btn btn-sm btn-outline-success"><i class="fas fa-cart-plus"></i> Comprar</a>
      @else
        <a href="{{ route('book', $book->slug) }}" class="btn btn-sm btn-outline-secondary">Agotador</a>
      @endif

    </div>
  </div>
</div>
