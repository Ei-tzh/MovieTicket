<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cinema;
use App\Theater;
use App\Movie;
use App\Movie_theater;
class MovieTheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$theater)
    {
        $cinema=Cinema::find($id);
        $cinematheater=Theater::find($theater);
        $movies=$cinematheater->movies;
        $startdates=[];
        $enddates=[];
        foreach($movies as $movie){
            $movietheater=Movie_theater::find($movie->pivot->id);
            $enddate=$movietheater->timetables()->orderBy('show_date','DESC')->first();
            $startdate=$movietheater->timetables()->orderBy('show_date','ASC')->first();
            array_push($startdates,$startdate);
            array_push($enddates,$enddate);
        }
        //return $enddates;
        return view('admin.movietheaters.index',compact('cinema','cinematheater','startdates','enddates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$theater)
    {
        $cinema=Cinema::find($id);
        $cinematheater=Theater::find($theater);
        $movies=Movie::all();
        return view('admin.movietheaters.create',compact('cinema','cinematheater','movies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id,$theater)
    {
        $request->validate([
            'movie' =>'required',
        ]);
        $status=($request->has('status')) ? 1 : 0;//active or inactive
        $cinematheater=Theater::find($theater);
        $cinematheater->movies()->attach($request->movie,['status'=>$status]);
        $request->session()->flash('status','A New Movie is added to '.$cinematheater->name.' successfully!');
        return redirect()->route('movietheaters.index',[$id,$theater]);
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
    public function edit($id,$theater,$movietheater)
    {
        $cinema=Cinema::find($id);
        $cinematheater=Theater::find($theater);
        $movies=Movie::all();    // to show all movies in selectbox
        $movie_theater=Movie_theater::find($movietheater);
        $selected_movie=Movie::find($movie_theater->movie_id);
        //return $selected_movie;
        return view('admin.movietheaters.edit',compact('cinema','cinematheater','movies','movie_theater','selected_movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$theater,$movietheater)
    {
        $request->validate([
            'movie' =>'required',
        ]);
        $status=($request->has('status')) ? 1 : 0;//active or inactive
        $cinematheater=Theater::find($theater);
        Movie_theater::where('id',$movietheater)->update([
            'movie_id'  => $request->movie,
            'status'    => $status
        ]);
        $request->session()->flash('status','You have updated successfully!');
        return redirect()->route('movietheaters.index',[$id,$theater]);
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
