<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Book;
use Session;

use Illuminate\Http\Request;

class CartController extends Controller
{
  public function json() {
    $carts = Cart::where('session', Session::getId())->with('book')->get();
    return $carts->toJson();
  }
  public function store($id, Request $request) {
    $book = Book::findOrFail($id);
    $cartValidate = Cart::where('session', Session::getId())->where('book_id', $book->id)->first();
    if($cartValidate) {
      $cart = $cartValidate;
      $cart->quantity = $cart->quantity + 1;
    } else {
      $cart = new Cart;
      $cart->session = Session::getId();
      $cart->book_id = $book->id;
      $cart->quantity = 1;
    }
    $cart->save();

    flash('Se agrego el libro a tu carro de compras.')->success();
    return redirect()->route('book', $book->slug);
  }
}
