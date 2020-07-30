<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function seat_timetable_theaters(){
        return $this->belongsToMany('App\Seat_timetabletheater','booking_seattimetable_theaters','booking_id','seat_timetable_theater_id');
    }
}
