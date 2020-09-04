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
                $seat=Movietheater_timetable::find($movietheater->pivot->id)->seats;

                array_push($values,$theater);
                array_push($movie_values,$movie);
                array_push($seats,$seat);

                $theaters=array_unique($values);
                $movies=array_unique($movie_values);
                $cinema=$theater->cinema;
                
            }
        }
        // return $theaters;
       return view('admin.timetables.index',compact('timetables','theaters','movies','seats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$movies=Movie::all();
        $movie_arrays=[];
        $theater_arrays=[];
        $movie_theaters=Movie_theater::all();
        foreach($movie_theaters as $movie_theater){
            $movie=Movie::find($movie_theater->movie_id);
            $theaters=Theater::find($movie_theater->theater_id);
            $cinema=$theaters->cinema;
            array_push($movie_arrays,$movie);
            array_push($theater_arrays,$theaters);
        }
        $movies=array_unique($movie_arrays);
        $theaters=array_unique($theater_arrays);
        
        //return $theaters;
        return view('admin.timetables.create',compact('movie_theaters'))->with('movies',$movies)->with('theaters',$theaters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'show_date'=>'required|date_format:Y-m-d',
            'show_time'=>'required',
            'movie_theaters'=> 'required'
        ]);
        //return $request;
        $timetable=Timetable::create([
            'show_date' => $request->show_date,
            'show_time' => $request->show_time
        ]);
        $movie_theaters=$request->movie_theaters;
        $timetable->movie_theaters()->attach($movie_theaters);
        return redirect()->route('timetables.index');
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
