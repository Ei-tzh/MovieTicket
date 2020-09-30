<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking_movietheatertimetable_seat extends Model
{
    public function seats(){
        return $this->belongsToMany('App\Booking_movietheatertimetable_seat','booking_movietheatertimetable_seats','booking_timetable_id','seat_id')->withPivot('id');
    }
}
