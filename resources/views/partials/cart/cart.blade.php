@foreach($carts as $cart)
  <div class="card">
    <div class="card-body">
      <div class="float-right text-right">
        <form action="{{ route('cartUpdate', $cart->rowId)}}" method="POST">
          @csrf
          <div class="input-group">
            <input type="text" class="form-control form-control-sm" style="max-width: 70px;" value="{{ $cart->qty }}" name="qty">
            <div class="input-group-append" id="button-addon4">
              <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-sync"></i></button>
            </div>
          </div>
        </form>
        @if($cart->model->old_price > 0)
          <small><s>$ {{ number_format($cart->model->old_price) }}</s></small><br>
        @endif
        @if($cart->qty == 1)
          <strong> $ {{ number_format($cart->model->price) }}</strong>
        @else
          (x{{ $cart->qty }})<strong> $ {{ number_format($cart->model->price * $cart->qty) }}</strong>
        @endif
      </div>
      <strong><a href="{{ route('book', $cart->model->slug) }}" target="_blank">{{ $cart->model->name }}</a></strong><br>
      <small>
        Autor(es): @foreach($cart->model->authors as $author)
          {{ $author->name }},
        @endforeach
        <br> Editorial: {{ $cart->model->publisher->name }}
      </small>
    </div>
  </div>
@endforeach
