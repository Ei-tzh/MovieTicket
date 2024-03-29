<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Movie;
class Category extends Model
{
    protected $fillable=['name'];
    public function movies(){
        return $this->belongsToMany('App\Movie');
    }
}
