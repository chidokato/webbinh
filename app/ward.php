<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ward extends Model
{
    protected $table = "ward";
    public function district()
	{
		return $this->belongsTo('App\district','district_id','id');
	}
	public function province()
	{
		return $this->belongsTo('App\province','province_id','id');
	}
	public function User()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
}
