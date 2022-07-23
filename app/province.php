<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    protected $table = "province";
    public function district()
	{
		return $this->hasMany('App\district','province_id','id');
	}
	public function User()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
}