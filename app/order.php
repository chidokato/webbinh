<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $table = "order";

    public function User()
	{
		return $this->belongsTo('App\User','user_id','id');
	}
	public function customer()
	{
		return $this->belongsTo('App\customer','customer_id','id');
	}
	public function channel()
	{
		return $this->belongsTo('App\channel','channel_id','id');
	}
	public function banhang()
	{
		return $this->hasMany('App\banhang','order_id','id');
	}
	// nhập hàng
	public function nhaphang()
	{
		return $this->hasMany('App\nhaphang','order_id','id');
	}
	public function supplier()
	{
		return $this->belongsTo('App\supplier','supplier_id','id');
	}
}
