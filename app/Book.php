<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  public function comments()
  {
    return $this->hasMany('App\Comment');
  }
  public function carts()
  {
    return $this->hasMany('App\Cart');
  }
  public function publisher()
  {
    return $this->belongsTo('App\Publisher');
  }
  public function topics()
  {
    return $this->belongsToMany('App\Topic')->orderBy('name', 'asc');
  }
  public function authors()
  {
    return $this->belongsToMany('App\Author')->orderBy('name', 'asc');
  }
}
