<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    //
    public function movietheaters(){
        return $this->belongsToMany('App\Movie_theater','movietheater_timetables','movietheater_id','timetable_id');
    }
}
