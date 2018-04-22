<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Station extends Model
{
    protected $fillable=[
        'name','phone','location'
    ];
    
    public function messages(){
     return $this->hasMany('App\message');
    }
}
