<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Station extends Model
{
    public function messages(){
     return $this->hasMany('App\message');
    }
}
