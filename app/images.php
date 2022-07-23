<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    protected $table = "images";

	public function articles()
	{
		return $this->belongsTo('App\articles','articles_id','id');
	}
	public function section()
	{
		return $this->belongsTo('App\section','section_id','id');
	}
}
