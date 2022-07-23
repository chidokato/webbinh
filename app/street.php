<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class street extends Model
{
    protected $table = "street";
    public function product()
	{
		return $this->hasMany('App\product','street_id','id');
	}
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
