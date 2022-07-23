<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class nhaphang extends Model
{
    protected $table = "nhaphang";

 	public function order()
	{
		return $this->belongsTo('App\order','order_id','id');
	}
	public function articles()
	{
		return $this->belongsTo('App\articles','articles_id','id');
	}
	public function mausac()
	{
		return $this->belongsTo('App\mausac','mausac_id','id');
	}
}
