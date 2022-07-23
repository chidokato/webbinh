<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    protected $table = "customer";
	
	public function order()
	{
		return $this->hasMany('App\order','customer_id','id');
	}
}
