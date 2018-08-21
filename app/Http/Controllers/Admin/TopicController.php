<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Topic;

use Auth;
use URL;

class TopicController extends Controller
{
  public function index()
  {
    $topics = Topic::orderBy('parent_id', 'asc')->get();
    return view('admin.topics.index', compact('topics'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:topics|max:255'
    ]);
    $topic = new Topic;
    $topic->name = $request->name;
    $topic->slug = str_slug($request->slug);
    $topic->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Topic '.$topic->name.' created.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $topic->toJson()
    ]);

    flash('Record saved')->success();
    return redirect()->route('admin.topics.index');
  }

  public function edit($id)
  {
    $topic = Topic::findOrFail($id);
    $parentTopics = Topic::where('parent_id', 0)->where('id', '!=', $topic->id)->get();
    return view('admin.topics.edit', compact('topic', 'parentTopics'));
  }

  public function update(Request $request, $id)
  {
    $topic = Topic::findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'slug' => 'required|unique:topics,slug,'.$topic->id.'|max:255'
    ]);
    $topic->name = $request->name;
    $topic->slug = str_slug($request->slug);
    $topic->parent_id = $request->parent_id;
    $topic->picture = $request->picture;
    $topic->description = $request->description;
    $topic->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Topic '.$topic->name.' updated.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $topic->toJson()
    ]);

    flash('Record updated')->success();
    return redirect()->route('admin.topics.index');

  }

  public function destroy($id)
  {
    $topic = Topic::findOrFail($id);
    if($topic->topics->count() > 0) {
      flash('Destroy or move all children contents before destroy this element.')->error();
      return redirect()->route('admin.topics.edit', $topic->id);
    }
    $topic->delete();
    //log notification
    $notification = Notification::create([
      'name' => 'Topic '.$topic->name.' deleted.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $topic->toJson()
    ]);
    flash('Record was destroyed.')->success();
    return redirect()->route('admin.topics.index');
  }
}
