<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    protected $fillable=['seat_no','price','theater_id'];
    public function theaters(){
        return $this->belongsToMany('App\Theater');
    }
}
