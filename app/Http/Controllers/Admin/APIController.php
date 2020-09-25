<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie_theater;
class APIController extends Controller
{
    //
    public function getmovietheaters(){
        $movie_theaters=Movie_theater::all();
        return $movie_theaters;
    }
}
