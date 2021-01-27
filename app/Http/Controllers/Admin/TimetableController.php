<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cinema;
use App\Theater;
use App\Movie;
use App\Movie_theater;
use App\Timetable;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$theater,$movietheater)
    {
        
        $cinematheater=Theater::find($theater);
        $movie_theater=Movie_theater::find($movietheater);
        $movie=Movie::find($movie_theater->movie_id);
        $timetables=$movie_theater->timetables()->orderBy('show_date','ASC')->orderBy('show_time','ASC')->get();
        return view('admin.movietimetables.index',compact('cinematheater','movie_theater','timetables','movie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$theater,$movietheater)
    {
        $cinematheater=Theater::find($theater);
        $movie_theater=Movie_theater::find($movietheater);
        $movie=Movie::find($movie_theater->movie_id);
        return view('admin.movietimetables.create',compact('cinematheater','movie_theater','movie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id,$theater,$movietheater)
    {
        $request->validate([
            'showdate'=>'required',
            'showtime'=>'required'
        ]);
        $movie_theater=Movie_theater::find($movietheater);

        //Retrieve same data which is compared with $request data and old inserted datas in timetables table
        $oldtimetable=Timetable::where('show_date',$request->showdate)->where('show_time',$request->showtime)->first();

        //want to avoid duplicate datas in many to many table(movietheater_timetables)
        if(!$movie_theater->timetables()->where('show_date',$request->showdate)->where('show_time',$request->showtime)->count()) {  //if duplicate datas not found,we will compared with the overall timetables table.
                if($oldtimetable){                                                                                                  //if old data is founded,we will attach with it's id.
                    $movie_theater->timetables()->attach($oldtimetable->id);
                }
                else{                                                                                                               //else we will insert new data in timetables table and attach with its id.
                    $newtimetable=Timetable::Create([
                        'show_date'=> $request->showdate,
                        'show_time'=> $request->showtime
                    ]);
                    $movie_theater->timetables()->attach($newtimetable->id);
                }
             $request->session()->flash('status','Congratulation! A New Schedule was created successfully!');
       }else{                                                                                                                       //to show error alert box for creating existing datas.
        $request->session()->flash('error','You have created \''.$request->showdate.'\' & \''.$request->showtime.'\'!');
       }
        return redirect()->route('timetables.index',[$id,$theater,$movietheater]);
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
