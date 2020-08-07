<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function cinema(){
        return $this->belongsTo('App\Cinema');
    }
    public function movies(){
        return $this->belongsToMany('App\Movie');
    }
}
