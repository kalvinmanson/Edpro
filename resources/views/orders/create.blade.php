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
      <div class="col-md-7">
        @if(count($carts) > 0)
          @include('partials.cart.cart')
        @else

        @endif
        <div class="text-secondary p-4">
          <p>Ediciones el profesional envia actualmente a todas las ciudades principales dle territorio Colombiano y algunos paises de latinoamerica cuando el cliente asume los costos de envio.</p>
        </div>
      </div>
      <div class="col-md-5">
        <a href="{{ route('orders.create') }}" class="btn btn-primary btn-lg">Realizar Pedido</a>
        @include('partials.cart.sidebar')
      </div>
    </div>
  </div>
@endsection
