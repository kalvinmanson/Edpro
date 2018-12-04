<div class="slideProducts">
  <div class="container">
    <div class="row">
    @foreach(App\Book::where('stock', '>', 0)->limit(4)->get() as $book)
      <div class="col-md-3">
        @include('partials.store.book')
      </div>
    @endforeach
    </div>
  </div>
</div>
