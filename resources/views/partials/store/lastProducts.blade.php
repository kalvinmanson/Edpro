<div class="slideProducts">
  <div class="container">
    <div class="row">
    @foreach(App\Book::where('stock', '>', 0)->limit(4)->get() as $book)
      <div class="col-md-3">
        <div class="card">
          <div class="card-body bg-info">
            {{ $book->name }}
          </div>
        </div>
      </div>
    @endforeach
    </div>
  </div>
</div>
