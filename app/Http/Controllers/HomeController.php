<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Movie;
use App\Theater;
use App\Timetable;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('admin');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dt = Carbon::now();
        $current_date=$dt->toDateString();
        $movies=[];
        $theaters=[];

        $timetables=Timetable::where('show_date',$current_date)->get();
        foreach($timetables as $timetable){
            $movie_theaters=$timetable->movie_theaters;

            foreach($movie_theaters as $movie_theater){
                $movie=Movie::find($movie_theater->movie_id);
                $theater=Theater::find($movie_theater->theater_id);
                $cinema=$theater->cinema;
               
                if(!in_array($movie,$movies)){
                    array_push($movies,$movie);
                }
                if(!in_array($theater,$theaters)){
                    array_push($theaters,$theater);
                }
            }
        }
        
        //return $theaters;
        return view('home',compact('timetables','movies','theaters'));
    }
}
