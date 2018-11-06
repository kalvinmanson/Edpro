@extends('layouts.app')

@section('title', 'Completa tu pedido')
@section('description', 'Realiza tus compras en libros academicos de zootécnia y veterinaria especializada.')

@section('content')
  <div class="container">
    <div class="lineTitle">
      <h2>
        <small>Pedido #{{ $order->id }}</small>
        Orden de compra
      </h2>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Detalles del pedido</div>
            <div class="card-body">
              
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Detalles del pedido</div>
            <table class="table">
              @foreach(json_decode($order->books) as $book)
              <tr>
                <td>{{ $book->name }} (x{{ $book->qty }})</td>
                <td>$ {{ number_format($book->subtotal) }}</td>
              </tr>
              @endforeach
              <tr>
                <td>Subtotal</td>
                <td class="text-right">$ {{ number_format($order->subtotal) }}</td>
              </tr>
              <tr>
                <td>Impuestos</td>
                <td class="text-right">$ {{ number_format($order->taxes) }}</td>
              </tr>
              <tr>
                <td>Total</td>
                <td class="text-right"><strong>$ {{ number_format($order->total) }}</strong></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
