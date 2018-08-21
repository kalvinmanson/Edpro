<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Field;

use Auth;
use URL;

class FieldController extends Controller
{

    public function index()
    {
      $fields = Field::distinct()->select('name')->get();
      return response()->json($fields);
    }

    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'name' => 'required|max:255',
        'format' => 'required|max:255',
        'page_id' => 'required',
        'content' => 'required'
      ]);
      $field = new Field;
      $field->page_id = $request->page_id;
      $field->format = $request->format;
      $field->name = $request->name;
      $field->content = $request->content;
      $field->weight = $request->weight;
      $field->save();

      //log notification
      $notification = Notification::create([
        'name' => 'Field '.$field->name.' created on page.',
        'user_id' => Auth::user()->id,
        'location' => URL::previous(),
        'data' => $field->toJson()
      ]);

      flash('Record saved')->success();
      return redirect()->route('admin.pages.edit', $request->page_id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $field = Field::findOrFail($id);
      $field->delete();

      //log notification
      $notification = Notification::create([
        'name' => 'Field '.$field->name.' deleted on page.',
        'user_id' => Auth::user()->id,
        'location' => URL::previous(),
        'data' => $field->toJson()
      ]);

      flash('Record removed')->success();
      return redirect()->route('admin.pages.edit', $field->page_id);
    }
}
