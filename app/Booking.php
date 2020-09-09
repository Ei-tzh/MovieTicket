<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public function movietheater_timetables(){
        return $this->belongsToMany('App\Movietheater_timetable','booking_movietheatertimetables','booking_id','movietheater_timetable_id')->withPivot('id');
    }
}
