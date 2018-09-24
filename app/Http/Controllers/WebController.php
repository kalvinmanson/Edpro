<?php

namespace App\Http\Controllers;

use App\Block;
use App\Book;
use App\Page;

use Illuminate\Http\Request;

class WebController extends Controller
{
  public function index()
  {
    $banners = Block::where('position', 'BannerHome')->orderBy('weight', 'asc')->get();
    $topBooks = Book::orderBy('rank', 'desc')->limit(4)->get();
    $lastPost = Page::whereHas('categories', function ($query) {
      $query->where('slug', 'blog');
    })->get();
    return view('web.index', compact('banners', 'topBooks', 'lastPost'));
  }
  public function soon()
  {
    return view('web.soon');
  }
}
