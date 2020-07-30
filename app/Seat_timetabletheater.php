<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat_timetabletheater extends Model
{
    public function bookings(){
        return $this->belongsToMany('App\Booking','booking_seattimetable_theaters','booking_id','seat_timetable_theater_id');
    }
}
