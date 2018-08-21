<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;
use App\Contact;

use URL;

class ContactController extends Controller
{
  public function store(Request $request) {
    $validatedData = $request->validate([
      'name' => 'required|max:255',
      'email' => 'required|email|max:255'
    ]);
    $contact = new Contact;
    $contact->name = $request->name;
    $contact->email = $request->email;
    $contact->subject = $request->subject;
    $contact->content = $request->content;
    $contact->location = $request->ip();
    $contact->referer = URL::previous();
    $contact->save();

    flash('Tu mensaje ha sido recibido, pronto nos pondremos en contacto contigo.')->success();
    return redirect()->route('soon');
  }
}
