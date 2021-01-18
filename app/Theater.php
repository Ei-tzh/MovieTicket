<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $fillable=['name','location','image','cinema_id'];
    public function cinema(){
        return $this->belongsTo('App\Cinema');
    }
    public function movies(){
        return $this->belongsToMany('App\Movie')->withPivot('id','status','start_date','end_date');
    }
    public function seats(){
        return $this->hasMany('App\Seat');
    }
}
