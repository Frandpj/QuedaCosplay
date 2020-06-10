<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{

  use SoftDeletes;

  protected $fillable = [
      'province',
  ];

  //Un provincia puede tener muchas poblaciones
  public function towns(){
      return $this->hasMany('App\Town');
  }

  //Un provincia puede tener muchos usuarios
  public function users(){
      return $this->hasMany('App\User');
  }

//Un provincia puede tener muchas quedadas
  public function stays(){
      return $this->hasMany('App\Stay');
  }

}
