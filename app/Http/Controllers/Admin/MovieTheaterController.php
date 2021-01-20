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
