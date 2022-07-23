<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $table = "product";
	public function street()
    {
        return $this->belongsTo('App\street','street_id','id');
    }
    public function district()
    {
        return $this->belongsTo('App\district','district_id','id');
    }
    public function province()
    {
        return $this->belongsTo('App\province','province_id','id');
    }
    public function ward()
    {
        return $this->belongsTo('App\ward','ward_id','id');
    }
    public function articles()
    {
        return $this->hasMany('App\articles','articles_id','id');
    }
}
