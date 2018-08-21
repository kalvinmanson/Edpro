<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
  public function topics()
  {
    return $this->hasMany('App\Topic', 'parent_id')->orderBy('name', 'asc');
  }
  public function parent()
  {
    return $this->belongsTo('App\Topic', 'parent_id');
  }
  public function books()
  {
    return $this->belongsToMany('App\Book')->orderBy('created_at', 'desc');
  }
}
