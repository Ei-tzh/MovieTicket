<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    public function theaters(){
        return $this->belongsToMany('App\Theater','timetable_theater','theater_id','timetable_id');
    }
}
