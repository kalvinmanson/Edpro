@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <form method="GET" action="{{ route('admin.orders.index')}}" class="float-right form-inline">
    <input type="text" class="form-control" role="search" name="q" placeholder="Search..." required>
    <button type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
  </form>
  <h1>Orders</h1>
  <table class="table table-striped">
    <tr>
      <th width="20">Id</th>
      <th>User</th>
      <th>Books</th>
      <th>Order Info</th>
      <th>Total</th>
      <th>Payment</th>
      <th>Timestamps</th>
    </tr>
    @foreach($orders as $order)
    <tr class="{{ $order->pay_status == 'Paid' ? 'table-success' : '' }}">
      <td>{{ $order->id }}</td>
      <td>
        {{ $order->user->name }}<br>
        {{ $order->user->email }}<br>
        Orders: {{ $order->user->orders->count() }}<br>
        Join date: {{ $order->user->created_at }}
      </td>
      <td>
        <ul>
        @foreach(json_decode($order->books) as $book)
        <li>
          <strong>{{ $book->name }}
            (x{{ $book->qty }})</strong><br>
          <span>
            <small>(u. $ {{ number_format($book->price) }})</small>
            $ {{ number_format($book->subtotal) }}
          </span>
        </li>
        @endforeach
        </ul>
      </td>
      <td>
        Shipping method: {{ $order->shipping_method }}<br>
        Shipping name: {{ $order->shipping_name }}<br>
        Shipping phone: {{ $order->shipping_phone }}<br>
        Shipping Location: {{ $order->shipping_country }}, {{ $order->shipping_city }} {{ $order->shipping_address }}
      </td>
      <td>
        Subtotal: {{ number_format($order->subtotal) }}<br>
        Discount: {{ number_format($order->discount) }}<br>
        Taxes: {{ number_format($order->taxes) }}<br>
        Shipping: {{ number_format($order->shipping) }}<br>
        <strong>Total: {{ number_format($order->total) }}</strong>
      </td>
      <td>
        Pay method: {{ $order->pay_method }}<br>
        Pay status: {{ $order->pay_status }}<br>
        Pay response: {{ $order->pay_response }}<br>
        Pay date: {{ $order->pay_date }}
      </td>
      <td>
        <small>
          Created at {{ $order->created_at }},<br>
          Last update {{ $order->updated_at->diffForHumans() }}
        </small>
      </td>
    </tr>
    @endforeach
  </table>
  {{ $orders->links() }}
</div>
@endsection
