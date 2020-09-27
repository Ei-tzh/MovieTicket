<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie_theater;
use App\Movie;
use App\Theater;
class APIController extends Controller
{
    //
    public function getmovietheaters(){
        $movie_theaters=Movie_theater::all();
        return response()->json($movie_theaters);
    }
    public function gettimetables(Request $request){
        $movie_theater=Movie_theater::find($request->id);
        $aa=$movie_theater->timetables;
        return response()->json($aa);
    }
    public function getmovies(){
        $movie_theaters=Movie_theater::all();
        $movies=[];
        foreach($movie_theaters as $movie_theater){
            $movie=Movie::find($movie_theater->movie_id);

            if(!in_array($movie,$movies)){
                array_push($movies,$movie);
            }
            
        }
        return response()->json($movies);
    }
    public function gettheaters(){
        $movie_theaters=Movie_theater::all();
        $theaters=[];
        foreach($movie_theaters as $movie_theater){
            $theater=Theater::find($movie_theater->theater_id);
            $theater->cinema;
            if(!in_array($theater,$theaters)){
                array_push($theaters,$theater);
            }
            
        }
        return response()->json($theaters);
    }
}
