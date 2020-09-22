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
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings=Booking::all();
        $booking_movietheater_timetables=[];
        $timetables=[];
        $movietheaters=[];
        $movies=[];
        $theaters=[];
        $seats=[];
        foreach($bookings as $booking){
                $seats=$booking->seats;
            $value=$booking->movietheater_timetables;
            array_push($booking_movietheater_timetables,$value);
            foreach($value as $val){
                $timetable=Timetable::find($val->timetable_id);
                array_push($timetables,$timetable);

                $movietheater=Movie_theater::find($val->movietheater_id);
                array_push($movietheaters,$movietheater);

                $movie=Movie::find($movietheater->movie_id);
                array_push($movies,$movie);


                $theater=Theater::find($movietheater->theater_id);
                $theater->cinema;
                array_push($theaters,$theater);

               
                

            }
            
        }
       // return $bookings;
       return view('admin.bookings.index',compact('bookings','timetables','movietheaters','movies','theaters'));
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
        
        return view('admin.bookings.create',compact('users','booking_no'));
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
            'booking_no'  => ['required'],
            'user' => ['required']
        ]);
        $dt = Carbon::now();
        
        Booking::create([
            'booking_no' => $request->booking_no,
            'user_id'   =>  $request->user,
            'date'      =>  $dt->toDateString(),
            'time'      =>  $dt->toTimeString()
        ]);
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
}
