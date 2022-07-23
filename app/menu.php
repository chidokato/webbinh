<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table = "menu";
	public function User()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
	public function seo()
	{
		return $this->belongsTo('App\seo','seo_id','id');
	}
	public function articles()
    {
        return $this->hasMany('App\articles','menu_id','id');
    }
}
