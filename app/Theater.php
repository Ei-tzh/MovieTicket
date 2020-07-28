<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public function cinema_movie(){
        return $this->belongsTo('App\Cinema_movie');
    }
    public function seats(){
       return $this->belongsToMany('App\Seat');
    }
    public function timetables(){
        return $this->belongsToMany('App\Timetable','timetable_theater','theater_id','timetable_id');
    }
}
