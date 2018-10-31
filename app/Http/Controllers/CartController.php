<?php

namespace App\Http\Controllers;

use App\Book;
use Cart;

use Illuminate\Http\Request;

class CartController extends Controller
{
  public function index() {
    $carts = Cart::content();
    return view('cart.index', compact('carts'));
  }
  public function json() {
    $cart = Cart::content();
    return $cart->toJson();
  }
  public function store($id) {
    $book = Book::findOrFail($id);
    Cart::add($book, 1);
    flash('Se agrego el libro a tu carro de compras.')->success();
    return back();
  }
  public function update($rowId, Request $request) {
    Cart::update($rowId, $request->qty);
    flash('Se actualizo la cantidad en tu carro de compras.')->warning();
    return back();
  }
  public function remove($rowId) {
    Cart::remove($rowId);
    flash('Se elimino el libro a tu carro de compras.')->error();
    return back();
  }
}
