@extends('layouts.app')

@section('title', 'Completa tu pedido')
@section('description', 'Realiza tus compras en libros academicos de zootécnia y veterinaria especializada.')

@section('content')
<?php

    $payU['url'] = 'https://checkout.payulatam.com/ppp-web-gateway-payu/'; // Producción
    $payU['ApiKey'] = env('PAYU_APIKEY'); // Obtener este dato dela cuenta de Payu
    $payU['merchantId'] = env('PAYU_MERCHANT_ID'); // Obtener este dato dela cuenta de Payu
    $payU['accountId'] = env('PAYU_ACCOUNT_ID'); // Obtener este dato dela cuenta de Payu
    //tests
    /*
    $payU['url'] = 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu';
    $payU['ApiKey'] = '4Vj8eK4rloUd272L48hsrarnUA'; // Obtener este dato dela cuenta de Payu
    $payU['merchantId'] = '508029'; // Obtener este dato dela cuenta de Payu
    $payU['accountId'] = '512321'; // Obtener este dato dela cuenta de Payu
    */

    $payU['description'] = 'Libros: '; //Descripción del pedido
    foreach(json_decode($order->books) as $bookDes) {
      $payU['description'] .= '['.$bookDes->name.' (x'.$bookDes->qty.')], ';
    }
    $payU['referenceCode'] = 'EP00'.$order->user->id.'-'.$order->id.'T'.rand(1000000,9999999); // Referencia Unica del pedido
    $payU['amount'] = $order->total; //Es el monto total de la transacción. Puede contener dos dígitos decimales. Ej. 10000.00 ó 10000.
    $payU['tax'] = '0'; // Es el valor del IVA de la transacción, si se envía el IVA nulo el sistema aplicará el 19% automáticamente. Puede contener dos dígitos decimales. Ej: 19000.00. En caso de no tener IVA debe enviarse en 0.
    $payU['taxReturnBase'] = '0'; // Es el valor base sobre el cual se calcula el IVA. En caso de que no tenga IVA debe enviarse en 0.
    $payU['currency'] = 'COP'; // Moneda
    $payU['test'] = '0'; // Variable para poder utilizar tarjetas de crédito de pruebas, los valores pueden ser 1 ó 0.
    $payU['buyerEmail'] = $order->user->email; // Respuesta por Payu al comprador
    $payU['responseUrl'] = 'https://edicioneselprofesional.com.co/orders/response'; // URL de respuesta,
    $payU['confirmationUrl'] = 'https://edicioneselprofesional.com.co/orders/confirmation'; // URL de confirmación
    $payU['confirmacionEmail'] = $order->user->email; // Confirmación email
    $payU['buyerFullName'] = $order->user->name; // Confirmación email


  $payU['firma'] = $payU['ApiKey']."~".$payU['merchantId']."~".$payU['referenceCode']."~".$payU['amount']."~".$payU['currency'];
	$payU['firmaMd5'] = md5($payU['firma']);
?>
  <div class="container">
    <div class="lineTitle">
      <h2>
        <small>Pedido #{{ $order->id }}</small>
        Orden de compra
      </h2>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              Detalles del pedido
            </div>
            <div class="card-body">
              <p>
                Estado de pago: {{ $order->pay_status }}<br>
                Fecha de pago: {{ $order->pay_date }}
              </p>
              @if($order->pay_status == "Paid")
                <p>Tu pago se ha recibido de manera satisfactoria.</p>
                <p>
                  Tu pedido ya ha sido procesado y esta en proceso de despacho. <br>
                  Dentro de poco lo recibiras en tu dirección de envío.
                </p>
              @else
              <form method="post" action="{{ $payU['url'] }}">
            	  <input type="hidden" name="merchantId"    	value="{{ $payU['merchantId'] }}">
            	  <input type="hidden" name="accountId"     	value="{{ $payU['accountId'] }}">
            	  <input type="hidden" name="description"   	value="{{ $payU['description'] }}">
            	  <input type="hidden" name="referenceCode" 	value="{{ $payU['referenceCode'] }}">
            	  <input type="hidden" name="amount"        	value="{{ $payU['amount'] }}">
            	  <input type="hidden" name="tax"           	value="{{ $payU['tax'] }}">
            	  <input type="hidden" name="taxReturnBase" 	value="{{ $payU['taxReturnBase'] }}">
            	  <input type="hidden" name="currency"      	value="{{ $payU['currency'] }}">
            	  <input type="hidden" name="signature"     	value="{{ $payU['firmaMd5'] }}">
            	  <input type="hidden" name="buyerEmail"    	value="{{ $payU['buyerEmail'] }}">
            	  <input type="hidden" name="responseUrl"    	value="{{ $payU['responseUrl'] }}">
            	  <input type="hidden" name="confirmationUrl" value="{{ $payU['confirmationUrl'] }}">
                <input type="hidden" name="buyerFullName" value="{{ $payU['buyerFullName'] }}">
            	  <button name="Submit" type="submit" class="btn btn-success btn-lg">Pagar Ahora</button>
            	</form>
              @endif
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
                <td class="text-right">$ {{ number_format($book->subtotal) }}</td>
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
