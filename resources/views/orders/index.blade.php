@extends('layouts.app')

@section('title', 'Administrar pedidos')
@section('description', 'Realiza tus compras en libros academicos de zootécnia y veterinaria especializada.')

@section('content')
  <div class="container">
    <div class="lineTitle">
      <h2>
        <small>Mi cuenta</small>
        Consulta tus pedidos
      </h2>
    </div>
    <table class="table table-hover">
      <tr>
        <th width="30">#</th>
        <th>Pedido</th>
        <th>Estado</th>
      </tr>
      @foreach($orders as $order)
      <tr class="{{ $order->pay_status == 'Pending' ? 'table-warning' : '' }}">
        <td>{{ $order->id }}</td>
        <td>
          <a href="{{ route('orders.show', $order->id)}}">
          @foreach(json_decode($order->books) as $bookDes)
            {{ $bookDes->name }} (x{{ $bookDes->qty }})<br>
          @endforeach
          </a>
        </td>
        <td>{{ $order->pay_status }}</td>
      </tr>
      @endforeach
    </table>
  </div>
@endsection
