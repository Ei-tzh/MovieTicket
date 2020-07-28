<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat_theater extends Model
{
    protected $fillable=['seat_id','theater_id'];
    protected $table='seat_theater';
    public function bookings(){
        return $this->belongsToMany('App\Booking','seat_theater_bookings','booking_id','seat_theater_id');
    }
}
