<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Booking_movietheatertimetable;
use App\Booking;
use App\Movietheater_timetable;
use App\Timetable;
use App\Movie_theater;
use App\Movie;
use App\Theater;
class testController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking_movietheatertimetables=Booking_movietheatertimetable::orderBy('booking_id')->get();
        $bookings=[];
        $timetables=[];
        $movietheater_timetables=[];
        $movietheaters=[];
        $movies=[];
        $theaters=[];
        foreach($booking_movietheatertimetables as $val){
            
            $a=Booking::find($val->booking_id);
            if(!in_array($a,$bookings)){
                array_push($bookings,$a);
            }
            $movietheater_timetable=Movietheater_timetable::find($val->movietheater_timetable_id);
            if(!in_array($movietheater_timetable,$movietheater_timetables)){
                array_push($movietheater_timetables,$movietheater_timetable);
            }
            $timetable=Timetable::find($movietheater_timetable->timetable_id);
            if(!in_array($timetable,$timetables)){
                array_push($timetables,$timetable);
            }
            
            $movietheater=$timetable->movie_theaters()->having('pivot_id',$val->movietheater_timetable_id)->first();
            if(!in_array($movietheater,$movietheaters)){
                array_push($movietheaters,$movietheater);
            }
            $movie=Movie::find($movietheater->movie_id);
            if(!in_array($movie,$movies)){
                array_push($movies,$movie);
            }
            $theater=Theater::find($movietheater->theater_id);
            $theater->cinema;
            if(!in_array($theater,$theaters)){
                array_push($theaters,$theater);
            }
        }
        
       return view('test',compact('booking_movietheatertimetables','bookings','movietheater_timetables','timetables','movietheaters','movies','theaters'));
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
