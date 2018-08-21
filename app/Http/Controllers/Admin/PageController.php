<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Category;
use App\Page;

use Auth;
use URL;

class PageController extends Controller
{
  public function index()
  {
    $pages = Page::orderBy('updated_at', 'desc')->paginate(20);
    return view('admin.pages.index', compact('pages'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:pages|max:255'
    ]);
    $page = new Page;
    $page->name = $request->name;
    $page->slug = $request->slug;
    $page->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Page '.$page->name.' created.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $page->toJson()
    ]);

    flash('Record saved')->success();
    return redirect()->route('admin.pages.index');
  }
  public function edit($id)
  {
    $page = Page::findOrFail($id);
    $categories = Category::orderBy('parent_id', 'asc')->get();
    return view('admin.pages.edit', compact('page', 'categories'));
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
    $page = Page::findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:pages,slug,'.$page->id.'|max:255'
    ]);
    $page->name = $request->name;
    $page->slug = str_slug($request->slug);
    $page->picture = $request->picture;
    $page->description = $request->description;
    $page->content = $request->content;
    $page->weight = $request->weight;
    // asociated categories
    $page->categories()->detach();
    $page->categories()->attach($request->categories);
    $page->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Page '.$page->name.' updated.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $page->toJson()
    ]);

    flash('Record updated')->success();
    return redirect()->route('admin.pages.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $page = Page::findOrFail($id);
    if($page->fields->count() > 0) {
      flash('Destroy or move all children contents before destroy this element.')->error();
      return redirect()->route('admin.pages.edit', $page->id);
    }
    $page->delete();
    //log notification
    $notification = Notification::create([
      'name' => 'Page '.$category->name.' deleted.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $page->toJson()
    ]);
    flash('Record was destroyed.')->success();
    return redirect()->route('admin.pages.index');
  }
}
