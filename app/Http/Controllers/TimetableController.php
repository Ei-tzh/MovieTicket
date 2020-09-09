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

        $theaters=[];
        $movies=[];
        //$seats=[];
        foreach($timetables as $timetable){
            $movietheaters=$timetable->movie_theaters;
            
            foreach($movietheaters as $movietheater){
                $theater=Theater::find($movietheater->theater_id);
                $movie=Movie::find($movietheater->movie_id);
                //$seat=Movietheater_timetable::find($movietheater->pivot->id)->seats;
                
                // array_push($theaters,$theater);
                // array_push($movies,$movie);
                // array_push($seats,$seat);

                if(!in_array($theater,$theaters)){
                    array_push($theaters,$theater);
                }
                if(!in_array($movie,$movies)){
                    array_push($movies,$movie);
                }

                // $theaters=array_unique($values);
                // $movies=array_unique($movie_values);
                // $cinema=$theater->cinema;
                
            }
        }
        //return $theaters;
       return view('admin.timetables.index',compact('timetables','theaters','movies'));
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
            if(!in_array($movie,$movie_arrays)){
                array_push( $movie_arrays,$movie);
            }
            if(!in_array($theaters,$theater_arrays)){
                array_push($theater_arrays,$theaters);
            }
            
        }
        
        //return $theaters;
        return view('admin.timetables.create',compact('movie_theaters'))->with('movies',$movie_arrays)->with('theaters',$theater_arrays);
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
        $request->session()->flash('status','New dates & times are added!');
        return redirect()->route('timetables.index');
    }
    public function add($id){
        $timetable=Timetable::find($id);
        $movie_theater_timetables=$timetable->movie_theaters;
        $movie_theaters=Movie_theater::all();
        $theaters=[];
        $movies=[];
        foreach($movie_theaters as $movie_theater){
            $movie=Movie::find($movie_theater->movie_id);
            $theater=Theater::find($movie_theater->theater_id);
            $cinema=$theater->cinema;
            if(!in_array($movie,$movies)){
                array_push( $movies,$movie);
            }
            if(!in_array($theater,$theaters)){
                array_push($theaters,$theater);
            }
        }
        

        //return $timetable;
        return view('admin.timetables.add',compact('timetable','movie_theaters','movies','theaters'));

    }
    public function add_new($id,Request $request){
        $request->validate([
            'movie_theaters'=> 'required'
        ]);
        $timetable=Timetable::find($id);
        $timetable->movie_theaters()->attach($request->movie_theaters);
        $request->session()->flash('status','You have added to successfully!');
        return redirect()->route('timetables.index');
    }
    public function remove($id,$movietheater_id){
        $timetable=Timetable::find($id);
        $timetable->movie_theaters()->detach($movietheater_id);
        //$request->session()->flash('status','You have added to successfully!');
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
        $timetable=Timetable::find($id);
        $movie_theaters=$timetable->movie_theaters;
        $movies=[];
        $theaters=[];
        foreach($movie_theaters as $movie_theater){
            $movie=Movie::find($movie_theater->movie_id);
            $theater=Theater::find($movie_theater->theater_id);
            $cinema=$theater->cinema;
            if(!in_array($movie,$movies)){
                array_push( $movies,$movie);
            }
            if(!in_array($theater,$theaters)){
                array_push($theaters,$theater);
            }
        }
        return view('admin.timetables.edit',compact('timetable','movies','theaters'));
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
            'show_date'=>'required|date_format:Y-m-d',
            'show_time'=>'required'
        ]);
        $timetable=Timetable::find($id);
        Timetable::where('id',$id)->update([
            'show_date'=>$request->show_date,
            'show_time'=>$request->show_time
        ]);
        $request->session()->flash('status','You have updated from '.$timetable->show_date.'( '.$timetable->show_time.' )'.' to '.$request->show_date.'( '.$request->show_time.' )!');
        return redirect()->route('timetables.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timetable=Timetable::find($id);
        
        return $timetable;
    }

    // public function delete(Request $request){
    //     $id=$request->id;
    //     Timetable::destroy($id);
    //     return $request;
    //     //return redirect()->route('timetables.index');
    // }
    
}
