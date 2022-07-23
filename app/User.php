<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function order()
    {
        return $this->hasMany('App\order','user_id','id');
    }
    public function category()
    {
        return $this->hasMany('App\category','user_id','id');
    }
    public function articles()
    {
        return $this->hasMany('App\articles','user_id','id');
    }
    public function province()
    {
        return $this->hasMany('App\province','user_id','id');
    }
    public function messages()
    {
        return $this->hasMany('App\messages','user_id','id');
    }
    public function option()
    {
        return $this->belongsTo('App\option','option_id','id');
    }
}

