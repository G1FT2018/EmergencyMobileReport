<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinate extends Model
{
    protected $fillable=[
        'latitude','longitude'
    ];
    
    public function message()
    {
    	return $this->belongsTo('App\Message');
    }
}
