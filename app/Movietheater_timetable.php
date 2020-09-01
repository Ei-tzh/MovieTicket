<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movietheater_timetable extends Model
{
    public function seats(){
        return $this->hasMany('App\Seat');
    }
}
