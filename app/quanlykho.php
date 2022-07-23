<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class quanlykho extends Model
{
    protected $table = "quanlykho";
    public function articles()
	{
		return $this->belongsTo('App\articles','articles_id','id');
	}
	public function mausac()
	{
		return $this->belongsTo('App\mausac','mausac_id','id');
	}
	public function form()
	{
		return $this->belongsTo('App\form','form_id','id');
	}
	public function size()
	{
		return $this->belongsTo('App\size','size','id');
	}
}