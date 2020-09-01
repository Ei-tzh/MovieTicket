<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cinema;
use App\Movie;
use App\Theater;
use App\Movie_theater;
class TheaterController extends Controller
{
    public function create($cinema_id,$theater_id){
        $cinema=Cinema::find($cinema_id);
        $theater=$cinema->theaters()->where('id',$theater_id)->first();
       
        $movies=Movie::all();
        return view('admin.theaters.create')->with('cinema',$cinema)->with('theater',$theater)->with('movies',$movies);
    }
    public function store($cinema_id,$theater_id,Request $request){
        $cinema=Cinema::find($cinema_id);

        $request->status=($request->has('status')) ? 1 : 0;//active or inactive
        $request->validate([
            'movies' => 'required',
            'start_date'    =>'required|date_format:Y-m-d',
            'end_date'      =>'required|date_format:Y-m-d|after:start_date',
        ]);
        $theater=Theater::find($theater_id);
        $movies=$request->movies;
        $theater->movies()->attach($movies,['status'=>$request->status,'start_date'=>$request->start_date,'end_date'=>$request->end_date]);
        return redirect()->route('cinemas.show',$cinema->id);
    }
    public function edit($cinema_id,$theater_id,$id){
        $cinema=Cinema::find($cinema_id);
        $theater=$cinema->theaters()->where('id',$theater_id)->first();
        $movie_theater=Movie_theater::find($id);
        $movie=Movie::find($movie_theater->movie_id);
        
        return view('admin.theaters.edit')->with('cinema',$cinema)->with('theater',$theater)->with('movie_theater',$movie_theater)->with('movie',$movie);
    }
    public function update($cinema_id,$theater_id,$id,Request $request){
        $cinema=Cinema::find($cinema_id);
        $theater=$cinema->theaters()->where('id',$theater_id)->first();

        $request->status=($request->has('status')) ? 1 : 0;//active or inactive

        //validation
        $request->validate([
            
            'start_date'    =>'required|date_format:Y-m-d',
            'end_date'      =>'required|date_format:Y-m-d|after:start_date',
        ]);
        
        //updating movie_theater table
        $theater->movies()->updateExistingPivot($request->movie,['status'=>$request->status,'start_date'=>$request->start_date,'end_date'=>$request->end_date]);
        return redirect()->route('cinemas.show',$cinema->id);

    }
    public function destroy($cinema_id,$theater_id,$id){
        $cinema=Cinema::find($cinema_id);
        $theater=$cinema->theaters()->where('id',$theater_id)->first();
        $movie_id=Movie_theater::find($id);

        $theater->movies()->detach($movie_id->movie_id);//removing single row from movie_theater

        return redirect()->route('cinemas.show',$cinema->id);
    }
    
}
