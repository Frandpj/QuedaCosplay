<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'alias', 'email', 'password', 'image', 'town_id', 'province_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Un usuario puede tener muchas quedadas
    public function stays(){
        return $this->hasMany('App\Stay');
    }

    //Un usuario puede tener muchos comentarios
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    //Un usuario puede tener muchos productos
    public function products(){
        return $this->hasMany('App\Product');
    }

    //Un usuario pertecene a una población
    public function town(){
        return $this->belongsTo('App\Town');
    }

    //Un usuario pertecene a una provincia
    public function province(){
        return $this->belongsTo('App\Province');
    }

    //Un usuario pertecene a una colaboración
    public function collaborators(){
        return $this->belongsTo('App\Collaborator');
    }

}
