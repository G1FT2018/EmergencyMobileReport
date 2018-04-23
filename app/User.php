<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable=[
        'username','password','email','fullname','address','type'
    ];

  
    public function messages(){
                return $this->hasMany('App\message');
    }
}
