<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = "category";
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
        return $this->hasMany('App\articles','category_id','id');
    }
}
