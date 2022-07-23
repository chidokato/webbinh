<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class investor extends Model
{
    protected $table = "investor";
	public function User()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
	
}
