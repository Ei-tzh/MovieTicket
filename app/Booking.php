<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    protected $fillable=['booking_no','user_id','date','time'];
    public function movietheater_timetables(){
        return $this->belongsToMany('App\Movietheater_timetable','booking_movietheatertimetables','booking_id','movietheater_timetable_id')->withPivot('id');
    }
    public function seats(){
        return $this->hasMany('App\Seat');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
