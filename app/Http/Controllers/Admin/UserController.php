<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\User;

use Auth;
use URL;
use Hash;

class UserController extends Controller
{
  public function index()
  {
    $users = User::orderBy('updated_at', 'desc')->paginate(20);
    return view('admin.users.index', compact('users'));
  }


  public function edit($id)
  {
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
  }

  public function update(Request $request, $id)
  {
    $user = User::findOrFail($id);
    $validatedData = $request->validate([
      'name' => 'required|max:255',
    ]);
    $user->name = $request->name;
    if(!empty($request->password)) {
      $user->password = Hash::make($request->password);
    }
    $user->role = $request->role;
    $user->avatar = $request->avatar;
    $user->city = $request->city;
    $user->address = $request->address;
    $user->phone = $request->phone;
    $user->gender = $request->gender;
    $user->save();

    //log notification
    $notification = Notification::create([
      'name' => 'User '.$user->name.' updated.',
      'user_id' => Auth::user()->id,
      'location' => URL::previous(),
      'data' => $user->toJson()
    ]);

    flash('Record updated')->success();
    return redirect()->route('admin.users.index');
  }
}
