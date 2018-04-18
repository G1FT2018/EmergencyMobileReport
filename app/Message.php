<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    public function response(){
     return $this->hasOne('App\Response');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function station()
    {
    	return $this->belongsTo('App\Station');
    }

    public function coordinates()
    {
    	return $this->hasOne('App\Coordinate');
    }
}
