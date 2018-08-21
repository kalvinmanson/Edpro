<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Author;

use Auth;
use URL;

class AuthorController extends Controller
{
  public function index()
  {
    $authors = Author::orderBy('name', 'asc')->get();
    return view('admin.authors.index', compact('authors'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:authors|max:255'
    ]);
    $author = new Author;
    $author->name = $request->name;
    $author->slug = str_slug($request->slug);
    $author->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Author '.$author->name.' created.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $author->toJson()
    ]);

    flash('Record saved')->success();
    return redirect()->route('admin.authors.index');
  }

  public function edit($id)
  {
    $author = Author::findOrFail($id);
    return view('admin.authors.edit', compact('author'));
  }

  public function update(Request $request, $id)
  {
    $author = Author::findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:authors,slug,'.$author->id.'|max:255'
    ]);
    $author->name = $request->name;
    $author->slug = str_slug($request->slug);
    $author->picture = $request->picture;
    $author->description = $request->description;
    $author->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Author '.$author->name.' updated.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $author->toJson()
    ]);

    flash('Record updated')->success();
    return redirect()->route('admin.authors.index');

  }

  public function destroy($id)
  {
    $author = Author::findOrFail($id);
    $author->delete();
    //log notification
    $notification = Notification::create([
      'name' => 'Author '.$author->name.' deleted.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $author->toJson()
    ]);
    flash('Record was destroyed.')->success();
    return redirect()->route('admin.authors.index');
  }
}
