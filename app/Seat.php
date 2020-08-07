<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    public $fillable=['seat_no','price','movietheater_timetable_id'];

    
}
