<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class themes extends Model
{
    protected $table = "themes";
    public function User()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
}
