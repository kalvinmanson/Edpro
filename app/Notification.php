<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $fillable = [
      'user_id', 'name', 'location', 'data'
  ];
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
