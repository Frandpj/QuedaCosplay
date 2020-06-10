<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaborator extends Model
{

  use SoftDeletes;

  protected $fillable = [
      'user_id', 'stay_id', 'toGo',
  ];

  //Una colaboración puede tener muchos usuarios
  public function users(){
      return $this->hasMany('App\User');
  }

  //Una colaboración pertenece a una quedada
  public function stay(){
      return $this->belongsTo('App\Stay');
  }

}
