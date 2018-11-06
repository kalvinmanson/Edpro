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
          </table>
        </div>

        @if(count($carts) > 0)
          @include('partials.cart.cart')
        @endif
        <div class="text-secondary p-4">
          <p>Ediciones el profesional envia actualmente a todas las ciudades principales dle territorio Colombiano y algunos paises de latinoamerica cuando el cliente asume los costos de envio.</p>
        </div>
      </div>
      <div class="col-md-5">
        <form method="POST" action="{{ route('orders.store') }}">
          @csrf
          <div class="form-group">
            <label for="shipping_method">Envio</label>
            <input type="text" name="shipping_method" class="form-control" value="Estandar" readonly>
          </div>
          <div class="form-group">
            <label for="shipping_name">Nombre completo</label>
            <input type="text" name="shipping_name" class="form-control" value="{{ Auth::user()->name }}" required>
          </div>
          <div class="form-group">
            <label for="shipping_country">País</label>
            <select name="shipping_country" id="shipping_country" class="form-control">
              <option value="co">Colombia</option>
            </select>
          </div>
          <div class="form-group">
            <label for="shipping_city">Ciudad</label>
            <input type="text" name="shipping_city" class="form-control" value="{{ Auth::user()->city }}" required>
          </div>
          <div class="form-group">
            <label for="shipping_address">Dirección</label>
            <input type="text" name="shipping_address" id="shipping_address" class="form-control" value="{{ Auth::user()->address }}" required>
          </div>
          <div class="form-group">
            <label for="shipping_phone">Teléfono</label>
            <input type="text" name="shipping_phone" id="shipping_phone" class="form-control" value="{{ Auth::user()->phone }}" required>
          </div>

          <button type="submit" class="btn btn-primary btn-lg">Confirmar y realizar pago</button>
        </form>
      </div>
    </div>
  </div>
@endsection
