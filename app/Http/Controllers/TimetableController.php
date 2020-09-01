<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie_theater;
use App\Timetable;
use App\Movie;
use App\Theater;
use App\Cinema;
use App\Movietheater_timetable;
class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timetables=Timetable::all();
        $values=[];
        $movie_values=[];
        $seats=[];
        foreach($timetables as $timetable){
            $movietheaters=$timetable->movie_theaters;
            
            foreach($movietheaters as $movietheater){
                $theater=Theater::find($movietheater->theater_id);
                $movie=Movie::find($movietheater->movie_id);

                //$seat=Movietheater_timetable::where('id',$movietheater->pivot->id)->seats;
                
                array_push($values,$theater);
                array_push($movie_values,$movie);
                // array_push($seats,$seat);
                $theaters=array_unique($values);
                $movies=array_unique($movie_values);
                $cinema=$theater->cinema;
                
            }
        }
        
        //return $seats;
        return view('admin.timetables.index',compact('timetables','theaters','movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
