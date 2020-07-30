<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cinema_movie extends Model
{
    //protected $table='cinema_movies';

    public function theaters(){
        return $this->hasMany('App\Theater');
    }
}
