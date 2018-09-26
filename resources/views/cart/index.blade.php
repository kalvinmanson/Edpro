@extends('layouts.app')

@section('title', 'Completa tu pedido')
@section('description', 'Realiza tus compras en libros academicos de zootécnia y veterinaria especializada.')

@section('content')
  <div class="container">
    <div class="lineTitle">
      <h2>
        <small>Carro de compra</small>
        Completa tu pedido
      </h2>
    </div>
    <div class="row">
      <div class="col-md-8">
        @if(count($carts) > 0)
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
        @else
          
        @endif
        <div class="text-secondary p-4">
          <p>Ediciones el profesional envia actualmente a todas las ciudades principales dle territorio Colombiano y algunos paises de latinoamerica cuando el cliente asume los costos de envio.</p>
        </div>
      </div>
      <div class="col-md-4">
        @include('partials.cart.sidebar')
      </div>
    </div>
  </div>
@endsection
