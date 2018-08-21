<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Attachment;

use Auth;
use URL;
use File;
use Image;

class AttachmentController extends Controller
{

    public function index(Request $request)
    {
      $attachments = Attachment::all();
      if($request->CKEditor) { $isEditor = true; } else { $isEditor = false; }
      return view('admin.attachments.index', compact('attachments', 'isEditor'));
    }
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'upload' => 'required|mimes:jpeg,bmp,png,doc,docx,pdf,xls,xlsx,csv'
      ]);
      $filename = str_slug(explode('.', $request->file('upload')->getClientOriginalName())[0]).'.'.$request->file('upload')->getClientOriginalExtension();
      if(Attachment::where('user_id', Auth::user()->id)->where('name', $filename)->first()) {
        $filename = str_slug(explode('.', $request->file('upload')->getClientOriginalName())[0]).rand(10000,99999).'.'.$request->file('upload')->getClientOriginalExtension();
      }
      //create folder
      if(!File::exists(public_path().'/uploads/'.Auth::user()->id)) {
        File::makeDirectory(public_path().'/uploads/'.Auth::user()->id);
      }

      //Create thumbnail
      Image::make($request->file('upload'))->save('uploads/'.Auth::user()->id.'/'.$filename);
      Image::make($request->file('upload'))->widen(300)->save('uploads/'.Auth::user()->id.'/thumb-'.$filename);

      $attachment = new Attachment;
      $attachment->user_id = Auth::user()->id;
      $attachment->name = $filename;
      $attachment->mime = $request->file('upload')->getClientOriginalExtension();
      $attachment->size = $request->file('upload')->getClientSize();
      $attachment->path = '/uploads/'.Auth::user()->id.'/'.$filename;
      $attachment->thumbnail = '/uploads/'.Auth::user()->id.'/thumb-'.$filename;
      $attachment->save();
      if($request->responseHTML) {
        return redirect()->route('admin.attachments.index');
      } else {
        return response()->json([
          'uploaded' => 1,
          'fileName' => $filename,
          'url' => '/uploads/'.Auth::user()->id.'/'.$filename
        ]);
      }

    }
    public function destroy($id)
    {
      $attachment = Attachment::findOrFail($id);
      File::delete(public_path().$attachment->path);
      File::delete(public_path().$attachment->thumbnail);
      $attachment->delete();
      return redirect()->route('admin.attachments.index');
    }
}
