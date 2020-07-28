<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable_theater extends Model
{
    //
    protected $table='timetable_theater';

    public function bookings(){
        return $this->hasMany('App\Booking');
    }
}
