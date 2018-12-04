<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Publisher;

use Auth;
use URL;
use Image;

class PublisherController extends Controller
{
  public function index()
  {
    $publishers = Publisher::all();
    return view('admin.publishers.index', compact('publishers'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:categories|max:255'
    ]);
    $publisher = new Publisher;
    $publisher->name = $request->name;
    $publisher->slug = str_slug($request->slug);
    $publisher->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Publisher '.$publisher->name.' created.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $publisher->toJson()
    ]);

    flash('Record saved')->success();
    return redirect()->route('admin.publishers.index');
  }

  public function edit($id)
  {
    $publisher = Publisher::findOrFail($id);
    return view('admin.publishers.edit', compact('publisher'));
  }

  public function update(Request $request, $id)
  {
    $publisher = Publisher::findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:publishers,slug,'.$publisher->id.'|max:255'
    ]);
    //Picture
    if($request->file('picture')) {
      $img = Image::make($request->file('picture'));
      $img->fit(300, 250);
      $img->save('uploads/'.$publisher->id.'-'.$publisher->slug.'.'.$request->picture->extension());
      $publisher->picture = '/uploads/'.$publisher->id.'-'.$publisher->slug.'.'.$request->picture->extension();
    }
    $publisher->name = $request->name;
    $publisher->slug = str_slug($request->slug);
    $publisher->description = $request->description;
    $publisher->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Publisher '.$publisher->name.' updated.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $publisher->toJson()
    ]);

    flash('Record updated')->success();
    return redirect()->route('admin.publishers.index');
  }

  public function destroy($id)
  {
    $publisher = Publisher::findOrFail($id);
    if($publisher->books->count() > 0) {
      flash('Destroy or move all children contents before destroy this element.')->error();
      return redirect()->route('admin.publishers.edit', $publisher->id);
    }
    $publisher->delete();
    //log notification
    $notification = Notification::create([
      'name' => 'Publisher '.$publisher->name.' deleted.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $publisher->toJson()
    ]);
    flash('Record was destroyed.')->success();
    return redirect()->route('admin.publishers.index');
  }
}
