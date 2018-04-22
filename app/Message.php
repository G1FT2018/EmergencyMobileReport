<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    protected $fillable=[
        'emergency','user_id','latitude','longitude'
    ];

    /**
     * @brief - gets all messages that have not been responded
     * @return (object)(eloquent collection)
     */ 
    public static function unresponded(){
        return Message::where(['responded'=>0])->orderBy('created_at','desc')->simplePaginate(10);
    }

    /**
     * @brief - gets all new message alerts as they are arrive
     * @return (object)(eloquent collection)
     */
    public static function getNew($bound){
        return Message::where('id','>',$bound)->where(['responded'=>0])->orderBy('created_at','desc')->get();
    }
    
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
