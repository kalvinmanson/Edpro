<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Contact;
use App\Page;

use Auth;
use URL;

class ContactController extends Controller
{
  public function index()
  {
    $contacts = Contact::orderBy('updated_at', 'desc')->paginate(20);
    return view('admin.contacts.index', compact('contacts'));
  }
}
