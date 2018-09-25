<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class Book extends Model implements Buyable
{
  public function getBuyableIdentifier($options = NULL){
    return $this->id;
  }
  public function getBuyableDescription($options = NULL){
    return $this->name;
  }
  public function getBuyablePrice($options = NULL){
    return $this->price;
  }
  public function comments()
  {
    return $this->hasMany('App\Comment');
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
