<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class option extends Model
{
    protected $table = "option";
    
	public function User()
	{
		return $this->hasMany('App\User','option_id','id');
	}
	
}
