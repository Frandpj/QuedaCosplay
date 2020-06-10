<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

  use SoftDeletes;

  protected $fillable = [
      'name', 'title', 'description', 'price', 'image',
  ];

  //Un producto pertenece a un usuario
  public function user(){
      return $this->belongsTo('App\User');
  }

}
