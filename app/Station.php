<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Station extends Model
{
    protected $fillable=[
        'name','phone','location','stationlatitude','stationlongitude'
    ];
    
    public function messages(){
     return $this->hasMany('App\message');
    }
}
