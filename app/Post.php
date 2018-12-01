<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  public function user()
  {
    return $this->belongsTo('App\User','user_id');
  }

  public function scopeNotReply($query)
  {
    return $query->whereNull('parent_id');
  }

  public function replies()
  {
    return $this->hasMany('App\Post','parent_id');
  }

  public function post()
  {
    return $this->belongsTo('App\Post','parent_id');
  }

  public function attendees()
  {
    return $this->hasMany('App\Attendees','post_id');
  }
  
  public function likes()
  {
    return $this->hasMany('App\Like','post_id');
  }

}
