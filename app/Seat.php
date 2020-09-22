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
}
