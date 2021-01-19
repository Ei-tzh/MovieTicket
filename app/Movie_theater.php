<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie_theater extends Model
{
    public $table='movie_theater';

    public $fillable=['movie_id','cinema_id','status'];

    public function timetables(){
        return $this->belongsToMany('App\Timetable','movietheater_timetables','movietheater_id','timetable_id')->withPivot('id');
    }
}
