<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = "supplier";
    public function order()
	{
		return $this->hasMany('App\order','order_id','id');
	}
}
