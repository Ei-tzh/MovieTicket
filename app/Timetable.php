<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable=['show_date','show_time'];
    public function movie_theaters(){
        return $this->belongsToMany('App\Movie_theater','movietheater_timetables','timetable_id','movietheater_id')->withPivot('id');
    }
}
