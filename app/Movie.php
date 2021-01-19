<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Cinema;
class Movie extends Model
{
    //
    protected $fillable=['name','director','duration','poster','trailer','description','casts','type'];


    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function theaters(){
        return $this->belongsToMany('App\Theater')->withPivot('id','status');
    }
}
