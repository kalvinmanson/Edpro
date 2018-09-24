<?php

namespace App\Http\Controllers;

use App\Book;
use App\Comment;
use App\Topic;
use App\Author;
use Auth;

use Illuminate\Http\Request;

class StoreController extends Controller
{
  public function search(Request $request) {
    $books = Book::orderBy('updated_at', 'desc');
    if($request->q) {
      $books = $books->where('name', 'LIKE', '%'.$request->q.'%');
    }
    $books = $books->paginate(20);
    $authors = Author::where('name', 'LIKE', '%'.$request->q.'%')->get();
    return view('store.search', compact('books', 'authors'));
  }
  public function index(Request $request) {
    $books = Book::orderBy('updated_at', 'desc');
    //filtros
    if($request->topic) {
      $topic = Topic::where('slug', $request->topic)->firstOrFail();
      $books = $books->whereHas('topics', function($query) use ($topic) {
        $query->where('id', $topic->id);
      });
    }
    $books = $books->paginate(15);
    $topics = Topic::where('parent_id', 0)->get();
    return view('store.index', compact('books', 'topics'));
  }
  public function book($slug) {
    $book = Book::where('slug', $slug)->firstOrFail();
    return view('store.book', compact('book'));
  }
  public function addcomment($slug, Request $request) {
    $book = Book::where('slug', $slug)->firstOrFail();
    $comment = new Comment;
    $comment->book_id = $book->id;
    $comment->user_id = Auth::user()->id;
    $comment->content = $request->content;
    $comment->save();

    flash('Hemos recibido tu comentario, será publicado luego de su revisión.')->success();
    return redirect()->route('book', $book->slug);
  }
}
