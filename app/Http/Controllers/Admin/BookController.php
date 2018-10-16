<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Publisher;
use App\Topic;
use App\Author;
use App\Book;

use Auth;
use URL;

class BookController extends Controller
{
  public function index(Request $request)
  {
    $books = Book::orderBy('updated_at', 'asc');
    if(isset($request->q)) {
      $books = $books->where('name', 'LIKE', '%'.$request->q.'%')->orWhere('isbn', '%'.$request->q.'%')->orWhere('description', 'LIKE', '%'.$request->q.'%');
    }
    $books = $books->paginate(20);

    $publishers = Publisher::orderBy('name', 'asc')->get();
    return view('admin.books.index', compact('books', 'publishers'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:books|max:255',
      'publisher_id' => 'required',
      'isbn' => 'required|max:255'
    ]);
    $book = new Book;
    $book->name = $request->name;
    $book->slug = $request->slug;
    $book->isbn = $request->isbn;
    $book->publisher_id = $request->publisher_id;
    $book->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Book '.$book->name.' created.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $book->toJson()
    ]);

    flash('Record saved')->success();
    return redirect()->route('admin.books.index');
  }
  public function edit($id)
  {
    $book = Book::findOrFail($id);
    $publishers = Publisher::orderBy('name', 'asc')->get();
    $topics = Topic::orderBy('name', 'asc')->get();
    $authors = Author::orderBy('name', 'asc')->get();
    return view('admin.books.edit', compact('book', 'publishers', 'topics', 'authors'));
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
    $book = Book::findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:books,slug,'.$book->id.'|max:255',
      'publisher_id' => 'required'
    ]);
    $book->name = $request->name;
    $book->slug = str_slug($request->slug);
    $book->picture = $request->picture;
    $book->isbn = $request->isbn;
    $book->lang = $request->lang;
    $book->pages = $request->pages;
    $book->year = $request->year;
    $book->tags = $request->tags;
    $book->format = $request->format;
    $book->size_w = $request->size_w;
    $book->size_h = $request->size_h;
    $book->size_d = $request->size_d;
    $book->weight = $request->weight;
    $book->description = $request->description;
    $book->content = $request->content;
    $book->content_table = $request->content_table;
    $book->preview = $request->preview;
    $book->video = $request->video;
    $book->attachment = $request->attachment;
    $book->stock = $request->stock;
    $book->price = $request->price;
    $book->old_price = $request->old_price;
    if($request->promo) { $book->promo = true; } else { $book->promo = false; }
    // asociated categories
    $book->topics()->detach();
    $book->topics()->attach(array_unique($request->topics));
    $book->authors()->detach();
    $book->authors()->attach(array_unique($request->authors));
    $book->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Book '.$book->name.' updated.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $book->toJson()
    ]);

    flash('Record updated')->success();
    return redirect()->route('admin.books.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $book = Book::findOrFail($id);
    if($book->comments->count() > 0) {
      flash('Destroy or move all children contents before destroy this element.')->error();
      return redirect()->route('admin.books.edit', $book->id);
    }
    $book->delete();
    //log notification
    $notification = Notification::create([
      'name' => 'Book '.$book->name.' deleted.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $book->toJson()
    ]);
    flash('Record was destroyed.')->success();
    return redirect()->route('admin.books.index');
  }
}
