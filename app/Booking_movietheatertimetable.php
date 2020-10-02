<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking_movietheatertimetable extends Model
{
    // public function bookings(){
    //     return $this->belongsToMany('App\Movietheater_timetable','booking_movietheatertimetables','movietheater_timetable_id','booking_id')->withPivot('id');
    // }
    public function seats(){
        return $this->belongsToMany('App\Seat','booking_movietheatertimetable_seats','booking_timetable_id','seat_id')->withPivot('id');
    }
}
