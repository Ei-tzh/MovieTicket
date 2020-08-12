<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movie;
class Cinema extends Model
{
    protected $fillable=['name','address','ph_no','image','township_id'];
    public function theaters(){
        return $this->hasMany('App\Theater');
    }
    public function township(){
        return $this->belongsTo('App\Township');
    }
}
