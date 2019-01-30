<?php

namespace App\Http\Controllers;

use App\Block;
use App\Book;
use App\Topic;
use App\Page;
use App\Publisher;
use Auth;

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
    $publishers = Publisher::inRandomOrder()->limit(7)->get();
    return view('web.index', compact('banners', 'topBooks', 'lastPost', 'publishers'));
  }
  public function soon()
  {
    return view('web.soon');
  }
  public function page($slug) {
    $page = Page::where('slug', $slug)->firstOrFail();
    return view('web.page', compact('page'));
  }
}
