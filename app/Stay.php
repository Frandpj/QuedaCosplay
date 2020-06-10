<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stay extends Model
{

  use SoftDeletes;

  protected $fillable = [
      'title', 'description', 'datetime', 'location', 'whatsappurl', 'user_id', 'province_id',
  ];

  //Una quedada pertence a un usuario
  public function user(){
      return $this->belongsTo('App\User');
  }

  //Una quedada puede tener muchos comentarios
  public function comments(){
      return $this->hasMany('App\Comment');
  }

  //Una quedada puede tener muchos colaboradores
  public function collaborators(){
      return $this->hasMany('App\Collaborator');
  }

  //Una quedada pertence a una provincia
  public function province(){
      return $this->belongsTo('App\Province', 'province_id');
  }

}
