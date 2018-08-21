<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  public function categories()
  {
    return $this->belongsToMany('App\Category');
  }
  public function fields()
  {
    return $this->hasMany('App\Field')->orderBy('name', 'asc')->orderBy('weight', 'asc');
  }
}
