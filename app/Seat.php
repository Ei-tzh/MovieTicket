<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable=['seat_no','price','theater_id'];
    public function theaters(){
        return $this->belongsToMany('App\Theater');
    }
    public function timetable_theaters(){
        return $this->belongsToMany('App\Timetable_theater','seat_timetabletheaters','timetabletheater_id','seat_id');
    }
}
