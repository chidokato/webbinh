<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mausac extends Model
{
    protected $table = "mausac";
    
    public function quanlykho()
    {
        return $this->hasMany('App\quanlykho','mausac_id','id');
    }
}
