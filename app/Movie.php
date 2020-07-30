<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Cinema;
class Movie extends Model
{
    //
    protected $fillable=['name','director','start_date','end_date',
    'duration','poster','trailer','description','type'];


    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function cinemas(){
        return $this->belongsToMany('App\Cinema','cinema_movies','movie_id','cinema_id')->withPivot('id');
    }
}
