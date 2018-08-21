<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
  public function page()
  {
    return $this->belongsTo('App\Page');
  }
}
