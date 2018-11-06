<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Order;
use Cart;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $carts = Cart::content();
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
}
