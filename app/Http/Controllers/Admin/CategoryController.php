<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Category;

use Auth;
use URL;

class CategoryController extends Controller
{
  public function index()
  {
    $categories = Category::orderBy('parent_id', 'asc')->get();
    return view('admin.categories.index', compact('categories'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:categories|max:255'
    ]);
    $category = new Category;
    $category->name = $request->name;
    $category->slug = str_slug($request->slug);
    $category->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Category '.$category->name.' created.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $category->toJson()
    ]);

    flash('Record saved')->success();
    return redirect()->route('admin.categories.index');
  }

  public function edit($id)
  {
    $category = Category::findOrFail($id);
    $parentCategories = Category::where('parent_id', 0)->where('id', '!=', $category->id)->get();
    return view('admin.categories.edit', compact('category', 'parentCategories'));
  }

  public function update(Request $request, $id)
  {
    $category = Category::findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:categories,slug,'.$category->id.'|max:255'
    ]);
    $category->name = $request->name;
    $category->slug = str_slug($request->slug);
    $category->parent_id = $request->parent_id;
    $category->picture = $request->picture;
    $category->description = $request->description;
    $category->content = $request->content;
    $category->weight = $request->weight;
    $category->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Category '.$category->name.' updated.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $category->toJson()
    ]);

    flash('Record updated')->success();
    return redirect()->route('admin.categories.index');

  }

  public function destroy($id)
  {
    $category = Category::findOrFail($id);
    if($category->categories->count() > 0) {
      flash('Destroy or move all children contents before destroy this element.')->error();
      return redirect()->route('admin.categories.edit', $category->id);
    }
    $category->delete();
    //log notification
    $notification = Notification::create([
      'name' => 'Category '.$category->name.' deleted.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $category->toJson()
    ]);
    flash('Record was destroyed.')->success();
    return redirect()->route('admin.categories.index');
  }
}
