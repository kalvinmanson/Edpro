<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Order;
use Cart;
use Auth;
use Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $orders = Order::where('user_id', Auth::user()->id)->paginate(10);
      return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $carts = Cart::content();
      if(Cart::count() < 1) {
        flash('Tu carro de compra esta vacio.')->info();
        return redirect()->route('store');
      }
      return view('orders.create', compact('carts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(Cart::count() < 1) {
        flash('Tu carro de compra esta vacio.')->info();
        return redirect()->route('store');
      }
      $carts = Cart::content();
      $validatedData = $request->validate([
        'shipping_name' => 'required|max:150',
        'shipping_country' => 'required',
        'shipping_city' => 'required',
        'shipping_address' => 'required',
        'shipping_phone' => 'required'
      ]);
      $order = new Order;
      $order->user_id = Auth::user()->id;
      $order->books = "".$carts->toJson()."";
      $order->shipping_method = $request->shipping_method;
      $order->shipping_name = $request->shipping_name;
      $order->shipping_country = $request->shipping_country;
      $order->shipping_city = $request->shipping_city;
      $order->shipping_address = $request->shipping_address;
      $order->shipping_phone = $request->shipping_phone;
      $order->subtotal = intval(Cart::subtotal(0,'',''));
      $order->discount = 0;
      $order->taxes = intval(Cart::tax(0,'',''));
      $order->shipping = 0;
      $order->total = intval(Cart::total(0,'',''));
      $order->save();


      $user = Auth::user();
      $user->name = $request->shipping_name;
      $user->country = $request->shipping_country;
      $user->city = $request->shipping_city;
      $user->address = $request->shipping_address;
      $user->phone = $request->shipping_phone;
      $user->save();

      Cart::destroy();

      Mail::send('emails.orders.new', ['order' => $order], function ($m) use ($order) {
        $m->from('contacto@edicioneselprofesional.com.co', 'Ediciones el Profesional');
        $m->to($order->user->email, $order->user->name)->subject('Pedido recibido #'.$order->id);
        $m->bcc('contacto@edicioneselprofesional.com.co', 'Ediciones el profesional');
        $m->bcc('edicioneselprofesional@hotmail.com', 'Ediciones el profesional');
      });

      return redirect()->route('orders.show', $order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $order = Order::findOrFail($id);
      return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function confirmation(Request $request) {
      $file = fopen("archivo.txt", "w");
      fwrite($file, json_encode($request->all()) . PHP_EOL);
      fclose($file);

      $orderId = explode("-", explode("T", $request->reference_sale)[0])[1];
      $order = Order::findOrFail($orderId);

      $payU['ApiKey'] = env('PAYU_APIKEY'); // Obtener este dato dela cuenta de Payu
      $payU['merchantId'] = env('PAYU_MERCHANT_ID'); // Obtener este dato dela cuenta de Payu
      $payU['accountId'] = env('PAYU_ACCOUNT_ID'); // Obtener este dato dela cuenta de Payu

      //tests
      /*$payU['ApiKey'] = '4Vj8eK4rloUd272L48hsrarnUA'; // Obtener este dato dela cuenta de Payu
      $payU['merchantId'] = '508029'; // Obtener este dato dela cuenta de Payu
      $payU['accountId'] = '512321'; // Obtener este dato dela cuenta de Payu*/


      $referenceCode = $request->reference_sale;
      $txtValue = $request->value;
      $newValue = number_format($txtValue, 1, '.', '');
      $currency = $request->currency;
      $statePol = $request->state_pol;
      $sign = $request->sign;

      $firma = $payU['ApiKey']."~".$payU['merchantId']."~".$referenceCode."~".$newValue."~".$currency."~".$statePol;
	    $firmaMd5 = md5($firma);
      $estadoTxt = 'Firma no concuerda';

      if(strtoupper($sign) == strtoupper($firmaMd5)){

  		switch ($statePol) {
        case 4:
          $estadoTxt = "Transacción aprobada";
          $order->pay_status = 'Paid';
          break;
        case 6:
         	$estadoTxt = "Transacción rechazada";
          $order->pay_status = 'Rejected';
          break;
        case 7:
          $estadoTxt = "Transacción pendiente";
          $order->pay_status = 'Pending';
          break;
        case 104:
          $estadoTxt = "Error";
          $order->pay_status = 'Error';
          break;
        default:
        	$estadoTxt=$request->mensaje;
  		}
      $order->pay_date = date('Y-m-d H:i:s');
      $order->pay_response = $statePol;
      $order->save();
  	 }
    }

    public function response(Request $request) {
      $orderId = explode("-", explode("T", $request->referenceCode)[0])[1];
      $order = Order::findOrFail($orderId);

      $payU['ApiKey'] = env('PAYU_APIKEY'); // Obtener este dato dela cuenta de Payu
      $payU['merchantId'] = env('PAYU_MERCHANT_ID'); // Obtener este dato dela cuenta de Payu
      $payU['accountId'] = env('PAYU_ACCOUNT_ID'); // Obtener este dato dela cuenta de Payu

      //tests
      /*$payU['ApiKey'] = '4Vj8eK4rloUd272L48hsrarnUA'; // Obtener este dato dela cuenta de Payu
      $payU['merchantId'] = '508029'; // Obtener este dato dela cuenta de Payu
      $payU['accountId'] = '512321'; // Obtener este dato dela cuenta de Payu*/

      $referenceCode = $request->referenceCode;
      $txtValue = $request->TX_VALUE;
      $newValue = number_format($txtValue, 1, '.', '');
      $currency = $request->currency;
      $statePol = $request->transactionState;
      $sign = $request->signature;

      $firma = $payU['ApiKey']."~".$payU['merchantId']."~".$referenceCode."~".$newValue."~".$currency."~".$statePol;
	    $firmaMd5 = md5($firma);
      $estadoTxt = 'Firma no concuerda';

      if(strtoupper($sign) == strtoupper($firmaMd5)){
    		switch ($statePol) {
          case 4:
            $estadoTxt = "Transacción aprobada";
            $order->pay_status = 'Paid';
            break;
          case 6:
           	$estadoTxt = "Transacción rechazada";
            $order->pay_status = 'Rejected';
            break;
          case 7:
            $estadoTxt = "Transacción pendiente";
            $order->pay_status = 'Pending';
            break;
          case 104:
            $estadoTxt = "Error";
            $order->pay_status = 'Error';
            break;
          default:
          	$estadoTxt=$request->mensaje;
  		}
      $order->pay_date = date('Y-m-d H:i:s');
      $order->pay_response = $statePol;
      $order->save();
  	 }
     flash($estadoTxt)->info();
     return redirect()->route('orders.show', $order->id);
    }
}
