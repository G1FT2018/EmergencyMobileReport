<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
 public function messages(){
            return $this->hasMany('App\message');
 }
}
