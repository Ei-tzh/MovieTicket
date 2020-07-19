<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movie;
class Cinema extends Model
{
    public function movies(){
        return $this->belongsToMany('App\Movie');
    }
}
