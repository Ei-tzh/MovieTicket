<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Booking;
use App\User;
use App\Timetable;
use App\Movie_theater;
use App\Movie;
use App\Theater;
use App\Booking_movietheatertimetable;
use App\Movietheater_timetable;
class BookingController extends Controller
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
       //return $seats;
       return view('admin.bookings.index',compact('booking_movietheatertimetables','bookings','movietheater_timetables','timetables','movietheaters','movies','theaters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::where('role','user')->get();
        $booking_no=mt_rand();
        $movietheater_timetables=Movietheater_timetable::all()->groupBy('timetable_id');
        $timetables=[];
        $movies=[];
        $theaters=[];
        foreach($movietheater_timetables as $key=>$movietheater_timetable){
           
                $timetable=Timetable::find($key);
                $movietheater=$timetable->movie_theaters;
                array_push($timetables,$timetable);
                    foreach($movietheater as $movie_theater){
                        $movie=Movie::find($movie_theater->movie_id);
                        $theater=Theater::find($movie_theater->theater_id);
                        $theater->cinema;
                        if(!in_array($movie,$movies)){
                            array_push($movies,$movie);
                        }
                        if(!in_array($theater,$theaters)){
                            array_push($theaters,$theater);
                        }
                    }
                
            
        }
        //return $timetables;
        return view('admin.bookings.create',compact('users','booking_no','movietheater_timetables','timetables','movies','theaters'));
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
            'booking_no'  => 'required',
            'user' => 'required',
            'movietheater_timetables'=>'required'
        ]);
        $movietheaters=$this->getmovietheater($request->movietheater_timetables);//call function getmovietheater
        $dt = Carbon::now();//creating booking date and time
        
        $booking=Booking::create([
            'booking_no' => $request->booking_no,
            'user_id'   =>  $request->user,
            'date'      =>  $dt->toDateString(),
            'time'      =>  $dt->toTimeString()
        ]);
        $aa=Booking::find($booking->id);
        $aa->movietheater_timetables()->attach($movietheaters);//inserting booking_movietheatertimetables(many to many)

        $request->session()->flash('status','Congratulation,A New Booking is created successfully!');
        return redirect()->route('bookings.index');
       
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
    protected function getmovietheater(array $array){
        $movietheaters=[];
        foreach($array as $a){
            $value=explode(',',$a);
            $movietheater=Movietheater_timetable::where('movietheater_id',$value[1])->where('timetable_id',$value[0])->first();
            array_push($movietheaters,$movietheater->id);
        }
        return $movietheaters;
    }
}
