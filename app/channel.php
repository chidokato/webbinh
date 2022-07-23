<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class channel extends Model
{
    protected $table = "channel";
	
	public function order()
	{
		return $this->hasMany('App\order','channel_id','id');
	}
	
	
    public $timestamps = false;
}
