<?php

namespace App\Http\Controllers;

use App\Block;
use App\Book;
use App\Topic;
use App\Page;
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
    return view('web.index', compact('banners', 'topBooks', 'lastPost'));
  }
  public function soon()
  {
    return view('web.soon');
  }
  public function migrate() {
    $string = file_get_contents(public_path("books.json"));
    $records = json_decode($string, true);
    //dd($records);
    $newPublishers = [
      'hs' => 5,
      'mp' => 15,
      'ac' => 2,
      'om' => 4,
      '' => 14,
      'st' => 3,
      'amv' => 14,
      'sint' => 10,
      'bm' => 14,
      'alb' => 14,
      'ml' => 14,
      'everest' => 14,
      'crc' => 14,
      'im' => 14,
      'var' => 14,
      'aso-edi' => 14,
      'mgh' => 11,
      'bg' => 14,
      'tv' => 14,
      'mnl-mod' => 13,
      'mm' => 13,
      'mer' => 14,
      'ab' => 14,
      'mb' => 14,
      'varios' => 14,
      'wil' => 14,
      'cabi' => 14,
      'dre' => 14,
      'he' => 14,
      'tt' => 14,
      'els' => 14,
      'ulla' => 14,
      'man' => 14,
      'im-axon' => 14,
      'tril' => 14,
      'ceamvet' => 14,
      'cmg' => 8,
      'eve' => 14,
      'dun' => 14,
      'mosby' => 14,
      'hb' => 14,
      'de-vecchi' => 14,
      'vecc' => 14,
      'it' => 14,
      'paraninfo' => 14,
      'iberia' => 14,
      'pearson' => 14,
      'sau' => 14,
      'nap' => 14,
      'nrc' => 14,
      'pan' => 14,
      'ull' => 14,
      'eds' => 14,
      'cel' => 14,
      'masso' => 14,
      'hc' => 14,
      'ds' => 14,
      'tri' => 14,
      'pear' => 14,
      'plm' => 14,
      'ediciones-s-lexus' => 14,
      'cd' => 14,
      'cib' => 14,
      'prod' => 14
    ];
    //$books = Book::where('id', '>', 0)->delete();
    //dd($books);
    /*
    foreach($records as $record) {
      $tags = [];
      //validate
      if(!Book::where('slug', str_slug($record['name']))->first() && str_slug($record['name'])) {
        $book = new Book;
        $book->publisher_id = $newPublishers[str_slug($record['publisher'])];
        $book->name = ucfirst(strtolower($record['name']));
        $book->slug = str_slug($record['name']);
        $book->lang = $record['lang'];

        //ISBN
        $newIsbn = preg_replace('/[^0-9]/', '', $record['isbn']);
        if(empty($newIsbn)) { $newIsbn = '10000000000000'.rand(100,999); }
        $book->isbn = $newIsbn;

        //price
        $newPrice = preg_replace('/[^0-9]/', '', $record['price']);
        if(empty($newPrice)) { $newPrice = 0; }
        if($newPrice < 1000) { $newPrice = $newPrice * 3030; }
        $book->price = intval($newPrice);

        //tags
        if(!empty($record['publisher'])) { array_push($tags, $record['publisher']); }
        array_push($tags, ucfirst(strtolower($record['topic'])));
        array_push($tags, ucfirst(strtolower($record['author'])));
        $book->tags = implode(",", $tags);

        //year
        $year = preg_replace('/[^0-9]/', '', $record['year']);
        if(empty($year)) { $year = 0; }
        $book->year = $year;
        $book->stock = 1;

        //dd($book);
        $book->save();

        //after save
        //topics
        $topics = Topic::where('name', 'LIKE', '%'.$record['topic'].'%')->pluck('id');
        $book->topics()->attach($topics);
        echo $book->name.' ::: OK<br>';
      }
    }*/
  }
}
