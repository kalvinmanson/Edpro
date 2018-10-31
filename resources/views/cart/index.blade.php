@extends('layouts.app')

@section('title', 'Completa tu pedido')
@section('description', 'Realiza tus compras en libros academicos de zootécnia y veterinaria especializada.')

@section('content')
  <div class="container">
    <div class="lineTitle">
      <h2>
        <small>Realizar pedido</small>
        Completa tu pedido
      </h2>
    </div>
    <div class="row">
      <div class="col-md-8">
        @if(count($carts) > 0)
          @include('partials.cart.cart')
        @else

        @endif
        <div class="text-secondary p-4">
          <p>Ediciones el profesional envia actualmente a todas las ciudades principales dle territorio Colombiano y algunos paises de latinoamerica cuando el cliente asume los costos de envio.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">Detalles del pedido</div>
          <table class="table">
            <tr>
              <td>Articulos</td>
              <td class="text-right">{{ Cart::count() }}</td>
            </tr>
            <tr>
              <td>Subtotal</td>
              <td class="text-right">$ {{ Cart::subtotal() }}</td>
            </tr>
            <tr>
              <td>Impuestos</td>
              <td class="text-right">$ {{ Cart::tax() }}</td>
            </tr>
            <tr>
              <td>Total</td>
              <td class="text-right"><strong>$ {{ Cart::total() }}</strong></td>
            </tr>
            <tr>
              <td colspan="2" class="text-center">
                <a href="{{ route('orders.create') }}" class="btn btn-primary btn-lg">Realizar Pedido</a>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
