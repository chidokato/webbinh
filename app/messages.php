<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    protected $table = "messages";
	public function User()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
}
