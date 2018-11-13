@extends('layouts.app')

@section('title', 'Completa tu pedido')
@section('description', 'Realiza tus compras en libros academicos de zootécnia y veterinaria especializada.')

@section('content')
<?php
/*
  $payU['merchantId'] = '736363';
  $payU['ApiKey'] = '0hUT4PobpT0WwbMxc0k9l2HYkv';
  $payU['referenceCode'] = 'numerb1654';
  $payU['referenceDescription'] = 'Descripcion de la compra';
  $payU['amount'] = '20000.00';
  $payU['currency'] = 'COP';
  $payU['accountId'] = '741904';
  $payU['buyerEmail'] = 'kalvinmanson@gmail.com';
  $payU['responseUrl'] = 'https://edicioneselprofesional.com.co/order/response';
  $payU['confirmationUrl'] = 'https://edicioneselprofesional.com.co/order/confirmation';
  $payU['signature'] = md5($payU['ApiKey']."~".$payU['merchantId']."~".$payU['referenceCode']."~".$payU['amount']."~".$payU['currency']);
  */

  // $url = 'https://checkout.payulatam.com/ppp-web-gateway-payu/'; // Producción
    $url = 'https://checkout.payulatam.com/ppp-web-gateway-payu/'; // Sandbox

    $ApiKey = '0hUT4PobpT0WwbMxc0k9l2HYkv'; // Obtener este dato dela cuenta de Payu
    $merchantId = '736363'; // Obtener este dato dela cuenta de Payu
    $accountId = '741904'; // Obtener este dato dela cuenta de Payu
    $description = 'Compra de libros'; //Descripción del pedido
    $referenceCode = 'BB'.rand(0, 500).'AAAADF013'; // Referencia Unica del pedido
    $amount = '10000'; //Es el monto total de la transacción. Puede contener dos dígitos decimales. Ej. 10000.00 ó 10000.
    $tax = '0'; // Es el valor del IVA de la transacción, si se envía el IVA nulo el sistema aplicará el 19% automáticamente. Puede contener dos dígitos decimales. Ej: 19000.00. En caso de no tener IVA debe enviarse en 0.
    $taxReturnBase = '0'; // Es el valor base sobre el cual se calcula el IVA. En caso de que no tenga IVA debe enviarse en 0.
    $currency = 'COP'; // Moneda
    $test = '0'; // Variable para poder utilizar tarjetas de crédito de pruebas, los valores pueden ser 1 ó 0.
    $buyerEmail = 'shacarmona@musculocreativo.com.co'; // Respuesta por Payu al comprador
    $responseUrl = 'https://edicioneselprofesional.com.co/order/response'; // URL de respuesta,
    $confirmationUrl = 'https://edicioneselprofesional.com.co/order/confirmation'; // URL de confirmación
    $confirmacionEmail = 'shacarmona@musculocreativo.com.co'; // Confirmación email

  $firma = "$ApiKey~$merchantId~$referenceCode~$amount~$currency";
	$firmaMd5 = md5($firma);
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
            <div class="card-header">Detalles del pedido</div>
            <div class="card-body">
              <form method="post" action="<?php echo $url; ?>">
            	  <input name="merchantId"    	value="<?php echo $merchantId; ?>" ><br>
            	  <input name="accountId"     	value="<?php echo $accountId; ?>" ><br>
            	  <input name="description"   	value="<?php echo $description; ?>" ><br>
            	  <input name="referenceCode" 	value="<?php echo $referenceCode; ?>" ><br>
            	  <input name="amount"        	value="<?php echo $amount; ?>" ><br>
            	  <input name="tax"           	value="<?php echo $tax; ?>" ><br>
            	  <input name="taxReturnBase" 	value="<?php echo $taxReturnBase; ?>" ><br>
            	  <input name="currency"      	value="<?php echo $currency; ?>" ><br>
            	  <input name="signature"     	value="<?php echo $firmaMd5; ?>" ><br>
            	  <input name="buyerEmail"    	value="<?php echo $buyerEmail; ?>" ><br>
            	  <input name="responseUrl"    	value="<?php echo $responseUrl; ?>" ><br>
            	  <input name="confirmationUrl" value="<?php echo $confirmationUrl; ?>" ><br>

            	  <input name="Submit" type="submit" value="Enviar" >
            	</form>
              <hr>
              {{--
              <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                <input name="merchantId"    type="text"  value="{{ $payU['merchantId'] }}">
                <input name="accountId"     type="text"  value="{{ $payU['accountId'] }}">
                <input name="description"   type="text"  value="{{ $payU['referenceDescription'] }}">
                <input name="referenceCode" type="text"  value="{{ $payU['referenceCode'] }}">
                <input name="amount"        type="text"  value="{{ $payU['amount'] }}">
                <input name="tax"           type="text"  value="0">
                <input name="taxReturnBase" type="text"  value="0">
                <input name="currency"      type="text"  value="{{ $payU['currency'] }}">
                <input name="signature"     type="text"  value="{{ $payU['signature'] }}">
                <input name="test"          type="text"  value="1" >
                <input name="buyerEmail"    type="text"  value="{{ $payU['buyerEmail'] }}">
                <input name="responseUrl"    type="text"  value="{{ $payU['responseUrl'] }}">
                <input name="confirmationUrl"    type="text"  value="{{ $payU['confirmationUrl'] }}">
                <input name="Submit"        type="submit"  value="Enviar">
              </form>
              --}}
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
