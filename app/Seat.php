<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public $fillable=['seat_no','price','theater_id','booking_id'];

    public function theater(){
        return $this->belongsTo('App\Theater');
    }
    public function booking(){
        return $this->belongsTo('App\Booking');
    }
    public function booking_movietheater_timetables(){
        return $this->belongsToMany('App\Booking_movietheatertimetable_seat','booking_movietheatertimetable_seats','seat_id','booking_timetable_id')->withPivot('id');
    }
}
