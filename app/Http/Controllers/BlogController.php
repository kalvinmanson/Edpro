<?php

namespace App\Http\Controllers;

use App\Block;
use App\Book;
use App\Page;

use Illuminate\Http\Request;

class BlogController extends Controller
{
  public function index()
  {
    $posts = Page::whereHas('categories', function ($query) {
      $query->where('slug', 'blog');
    })->get();
    return view('blog.index', compact('posts'));
  }
  public function show($slug)
  {
    return view('web.soon');
  }
}
