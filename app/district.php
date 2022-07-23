<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    protected $table = "district";
    public function province()
	{
		return $this->belongsTo('App\province','province_id','id');
	}
	public function ward()
	{
		return $this->hasMany('App\ward','district_id','id');
	}
	public function User()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
}
