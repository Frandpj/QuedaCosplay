<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{

  use SoftDeletes;

  protected $fillable = [
      'message', 'user_id', 'stay_id',
  ];

  //Un comentario pertenece a un usuario
  public function user(){
      return $this->belongsTo('App\User');
  }

  //Un comentario pertenece a una quedada
  public function stay(){
      return $this->belongsTo('App\Stay');
  }

}
