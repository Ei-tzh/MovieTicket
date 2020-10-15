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
        
       $bookings=Booking::all();
       foreach($bookings as $booking){
           $user=$booking->user;
       }
      
       return view('admin.bookings.index',compact('bookings'));
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
            'booking_no' => 'required',
            'checkbox'  => 'required'
        ]);
        $dt = Carbon::now();
        Booking::create([
            'booking_no'=>$request->booking_no,
            'user_id'   =>$request->user,
            'date'      =>$dt->toDateString(),
            'time'      =>$dt->toTimeString()
        ]);

        $request->session()->flash('status','A New Booking is created successfully!');
        return redirect()->route('bookings.index');
       
    }
    public function addSeat($booking_id,$id){
        $booking_movietheatertimetable=Booking_movietheatertimetable::find($id);
        $seats=$booking_movietheatertimetable->seats;
        $booking=Booking::find($booking_movietheatertimetable->booking_id);
        $movietheater_timetable=Movietheater_timetable::find($booking_movietheatertimetable->movietheater_timetable_id);
        $timetable=Timetable::find($movietheater_timetable->timetable_id);

        $movietheater=Movie_theater::find($movietheater_timetable->movietheater_id);
        $movie=Movie::find($movietheater->movie_id);
        $theater=Theater::find($movietheater->theater_id);
        $theater->cinema;
        $theater->seats;
        return view('admin.bookings.addSeat',compact('booking_movietheatertimetable','booking','timetable','movie','theater'));
    }
    public function storeSeat($id,Request $request){
        $request->validate([
            'seats'  => 'required'
        ]);
        $booking=Booking_movietheatertimetable::find($id);
        $booking->seats()->attach($request->seats);
        
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
        $seats=[];
        $timetables=[];
        $movietheaters=[];
        $movies=[];
        $theaters=[];

        $booking=Booking::find($id);
        $user=$booking->user;
        
        $movietheatertimetables=$booking->movietheater_timetables;

        foreach($movietheatertimetables as $movietheatertimetable){
            $seat=Booking_movietheatertimetable::find($movietheatertimetable->pivot->id)->seats;
            //$seat=$bookingmovietheater->seats;

            if(!in_array($seat,$seats)){
                array_push($seats,$seat);
            }
            $timetable=Timetable::find($movietheatertimetable->timetable_id);
            if(!in_array($timetable,$timetables)){
                array_push($timetables,$timetable);
            }

            $movietheater=Movie_theater::find($movietheatertimetable->movietheater_id);
            if(!in_array($movietheater,$movietheaters)){
                array_push($movietheaters,$movietheater);
            }

            $movie=Movie::find($movietheater->movie_id);
            if(!in_array($movie,$movies)){
                array_push($movies,$movie);
            }
            $theater=Theater::find($movietheater->theater_id);
            $cinema=$theater->cinema;
            if(!in_array($theater,$theaters)){
                array_push($theaters,$theater);
            }
        }

        //return $movietheatertimetables;
        return view('admin.bookings.show',compact('booking','movietheatertimetables','timetables','movietheaters','movies','theaters','seats'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking=Booking::find($id);
        $users=User::where('role','user')->get();
        return view('admin.bookings.edit',compact('booking','users'));
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
       
        $request->validate([
            'date'  => 'required',
            'hr'    => 'required',
            'min'   => 'required',
            'sec'   => 'required'
        ]);
        $dt = Carbon::now();
       
        $datetime=$request->hr.':'.$request->min.':'.$request->sec;
        Booking::where('id',$id)->update([
            'user_id'=>$request->user,
            'date'   =>$request->current_datetime==''?$request->date : $dt->toDateString(),
            'time'   =>$request->current_datetime==''?$datetime : $dt->toTimeString()
        ]);
        return redirect()->route('bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking_movietheatertimetable=Booking_movietheatertimetable::find($id);
        return $booking_movietheatertimetable;
    }
    public function delete($id){
        $booking_movietheatertimetable=Booking_movietheatertimetable::find($id);
        $booking=Booking::find($booking_movietheatertimetable->booking_id);
        $booking->movietheater_timetables()->detach($booking_movietheatertimetable->movietheater_timetable_id);
        return redirect()->route('bookings.index');
    }
    public function addmovietheater($id){
        $booking_id=[];
        $timetables=[];
        $movies=[];
        $theaters=[];
        $movietheaters=[];

        $booking=Booking::find($id);
        $booking_movietheatertimetables=$booking->movietheater_timetables;
        foreach($booking_movietheatertimetables as $val){
            array_push($booking_id,$val->id);
        }

        
        $movietheater_timetables=Movietheater_timetable::whereNotIn('id',$booking_id)->get();//retrieve except booking's movietheater timetables

        foreach($movietheater_timetables as $movietheater_timetable){

                $timetable=Timetable::find($movietheater_timetable->timetable_id);
                if(!in_array($timetable,$timetables)){
                    array_push($timetables,$timetable); 
                }
                $movietheater=Movie_theater::find($movietheater_timetable->movietheater_id);
                if(!in_array($movietheater,$movietheaters)){
                    array_push($movietheaters,$movietheater); 
                }
                   
                $movie=Movie::find($movietheater->movie_id);
                $theater=Theater::find($movietheater->theater_id);
                $theater->cinema;
                if(!in_array($movie,$movies)){
                    array_push($movies,$movie);
                }
                if(!in_array($theater,$theaters)){
                    array_push($theaters,$theater);
                }
                    

                
        }
        //return $movietheater_timetables;
       return view('admin.bookings.addmovietheater',compact('booking','movietheater_timetables','timetables','movietheaters','movies','theaters'));
    }

    public function storemovietheater(Request $request, $id){
        $request->validate([
            'movietheater_timetables'  => 'required'
        ]);
        $booking=Booking::find($id);
        //$booking->movietheater_timetables()->attach($request->movietheater_timetables);
        if(count($request->movietheater_timetables)>1){
            $request->session()->flash('status','Movies are booked successfully!'); 
        }else{
            $request->session()->flash('status','A New Movie is booked successfully!');
        }
       
        return redirect()->route('bookings.show',$booking->id);
        
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
