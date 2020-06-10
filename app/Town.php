<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Town extends Model
{

  use SoftDeletes;

  protected $fillable = [
      'province_id', 'town',
  ];

  //Una población pertecene a una provincia
  public function province(){
      return $this->belongsTo('App\Province');
  }

  //Una población puede tener muchos usuarios
  public function users(){
      return $this->hasMany('App\User');
  }

}
