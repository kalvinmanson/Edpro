<div style="text-align: center; background-color: #f2f2f2;">
  <div style="padding: 15px; width:700px; display: inline-block; text-align: left;  background-color: #FFFFFF;">
      <img src="{{ url('/') }}/img/emails/email-header.jpg">
      <h2>
        <small>Pedido #{{ $order->id }}</small><br>
        Orden de compra
      </h2>

      <h4>Detalles del pedido</h4>
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
        <p>Puedes consultar los detalles y <strong>realizar el pago</strong> en el siguiente enlace:</p>
        <p>
          <a href="{{ url('/') }}/orders/{{ $order->id }}">{{ url('/') }}/orders/{{ $order->id }}</a>
        </p>
      @endif

      <table width="100%">
        @foreach(json_decode($order->books) as $book)
        <tr>
          <td>{{ $book->name }} (x{{ $book->qty }})</td>
          <td align="right">$ {{ number_format($book->subtotal) }}</td>
        </tr>
        @endforeach
        <tr>
          <td>Subtotal</td>
          <td align="right">$ {{ number_format($order->subtotal) }}</td>
        </tr>
        <tr>
          <td>Impuestos</td>
          <td align="right">$ {{ number_format($order->taxes) }}</td>
        </tr>
        <tr>
          <td>Total</td>
          <td align="right"><strong>$ {{ number_format($order->total) }}</strong></td>
        </tr>
      </table>
      <hr>
      <address>
        <p>
          EdicionesElProfesional.com<br>
          Teléfono: 281 09 31 - FAX: 243 07 39<br>
          Direccion: AVENIDA JIMENEZ No 12-42 OF. 602,<br>
          Bogotá, Colombia
        </p>
      </address>
      <small>© 2018 Todos los derechos reservados por Ediciones el Profesional LTDA.</small>
    </div>
</div>
