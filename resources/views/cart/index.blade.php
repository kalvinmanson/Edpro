@extends('layouts.app')

@section('title', 'Carro de compras')
@section('description', 'Realiza tus compras en libros academicos de zootécnia y veterinaria especializada.')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        @foreach($carts as $cart)
          <div class="card">
            <div class="card-body">
              <div class="float-right text-right">
                <small><s>$ {{ number_format($cart->model->old_price) }}</s></small><br>
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
      </div>
      <div class="col-md-4">
        @include('partials.cart.sidebar')
      </div>
    </div>
  </div>
@endsection
