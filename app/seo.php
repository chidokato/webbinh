<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class seo extends Model
{
    protected $table = "seo";
	public function category()
	{
		return $this->hasMany('App\category','seo_id','id');
	}
	public function articles()
	{
		return $this->hasMany('App\articles','seo_id','id');
	}
}
