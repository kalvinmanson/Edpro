<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Block;

use Auth;
use URL;

class BlockController extends Controller
{
  public function index()
  {
    $blocks = Block::paginate(20);
    return view('admin.blocks.index', compact('blocks'));
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:255'
    ]);
    $block = new Block;
    $block->name = $request->name;
    $block->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Block '.$block->name.' created.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $block->toJson()
    ]);

    flash('Record saved')->success();
    return redirect()->route('admin.blocks.index');
  }

  public function edit($id)
  {
    $block = Block::findOrFail($id);
    return view('admin.blocks.edit', compact('block'));
  }

  public function update(Request $request, $id)
  {
    $block = Block::findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255'
    ]);
    $block->name = $request->name;
    $block->picture = $request->picture;
    $block->description = $request->description;
    $block->content = $request->content;
    $block->link = $request->link;
    $block->weight = $request->weight;
    $block->save();

    //log notification
    $notification = Notification::create([
      'name' => 'Block '.$block->name.' updated.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $block->toJson()
    ]);

    flash('Record updated')->success();
    return redirect()->route('admin.blocks.index');
  }

  public function destroy($id)
  {
    $block = Block::findOrFail($id);

    $block->delete();
    //log notification
    $notification = Notification::create([
      'name' => 'Block '.$block->name.' deleted.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $block->toJson()
    ]);
    flash('Record was destroyed.')->success();
    return redirect()->route('admin.blocks.index');
  }
}
