<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function cinema_movie(){
        return $this->belongsTo('App\Cinema_movie');
    }
    
}
