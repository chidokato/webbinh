<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class home extends Model
{
    protected $table = "home";
	
    public function section()
    {
        return $this->hasMany('App\section','home_id','id');
    }
}
