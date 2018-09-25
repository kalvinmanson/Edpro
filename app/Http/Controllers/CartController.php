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
  public function store($id, Request $request) {
    $book = Book::findOrFail($id);
    Cart::add($book, 1);
    flash('Se agrego el libro a tu carro de compras.')->success();
    return redirect()->route('book', $book->slug);
  }
}
