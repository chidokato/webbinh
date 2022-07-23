<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    protected $table = "section";
	public function articles()
	{
		return $this->belongsTo('App\articles','articles_id','id');
	}
	public function images()
    {
        return $this->hasMany('App\images','section_id','id');
    }
    public function home()
	{
		return $this->belongsTo('App\home','home_id','id');
	}
}
