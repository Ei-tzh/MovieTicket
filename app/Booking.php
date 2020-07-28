<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function timetabletheater(){
        return $this->belongsTo('App\Timetable_theater');
    }
    public function seat_theaters(){
        return $this->belongsToMany('App\Seat_theater','seat_theater_bookings','booking_id','seat_theater_id');
    }
}
