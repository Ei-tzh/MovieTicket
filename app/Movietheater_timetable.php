<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movietheater_timetable extends Model
{
    // public function seats(){
    //     return $this->hasMany('App\Seat');
    // }
    public function bookings(){
        return $this->belongsToMany('App\Booking','booking_movietheatertimetables','movietheater_timetable_id','booking_id')->withPivot('id');
    }

}
