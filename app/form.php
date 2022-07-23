<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class form extends Model
{
    protected $table = "form";
    public function quanlykho()
	{
		return $this->hasMany('App\quanlykho','form_id','id');
	}
}
