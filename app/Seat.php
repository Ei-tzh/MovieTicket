<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public $fillable=['seat_no','price','movietheater_timetable_id'];

    public function movietheater_timetable(){
        return $this->belongsTo('App\Movietheater_timetable');
    }
}
