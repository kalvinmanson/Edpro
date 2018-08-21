<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  public function pages()
  {
    return $this->belongsToMany('App\Page')->orderBy('weight', 'asc');
  }
  public function blocks()
  {
    return $this->hasMany('App\Block')->orderBy('weight', 'asc');
  }
  public function categories()
  {
    return $this->hasMany('App\Category', 'parent_id')->orderBy('weight', 'asc');
  }
  public function parent()
  {
    return $this->belongsTo('App\Category', 'parent_id');
  }
}
