<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Movie;
use App\Cinema_movie;
use App\Theater;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies=Movie::all();
        return view('admin.index',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'name'          =>'required',
            'director'      =>'required',
            'start_date'    =>'required|date_format:Y-m-d',
            'end_date'      =>'required|date_format:Y-m-d|after:start_date',
            'hr'      => 'required|date_format:H',
            'min'      =>'required',
            'poster'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
            'description'   => 'required',
            'type'          => 'required'
        ]);
        $extension=$request->poster->extension();
        //$videoextension=$request->trailer->extension();

        $uuid=Str::uuid();

        $request->poster->storeAs('/public/images',$uuid.".".$extension);
        //$request->trailer->storeAs('/public/videos',$uuid.".".$extension);

        $url=Storage::url('images/'.$uuid.".".$extension);
        //$video_url=Storage::url($uuid.".".$videoextension);
        
        $hr=$request->hr;
        $min=$request->min;

        $movie=Movie::create([
            'name' => $request->name,
            'director'=>$request->director,
            'start_date'=>$request->start_date,
            'end_date' => $request->end_date,
            'duration' => $hr.":".$min,
            'poster'  => $url,
            //'trailer'   =>$video_url,
            'description'=>$request->description,
            'type'     => $request->type
        ]);
        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie=Movie::find($id);
        $categories=$movie->categories;
        $cinemas=$movie->cinemas()->get();
        
        foreach($cinemas as $cinema)
        {
            $cinema_movies=Cinema_movie::where('id',$cinema->pivot->id)->get();
            
            $cinemamovies[]=$cinema_movies;
           foreach($cinema_movies as $cinema_movie){
                $theaters=$cinema_movie->theaters;
                //$theaters[]=$cinema_theaters;
              
                foreach($theaters as $theater){
                    $timetables=$theater->timetables;
                    //$theater_timetables[]=$timetables;
                    
                }
           }
            
        }
        //return $cinemamovies;
        return view('admin.movies.show',compact('movie','categories','cinemamovies','cinemas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $movie=Movie::find($id);
        return view('admin.edit',compact('movie'));
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
        $movie=Movie::find($id);
        $request->validate([
            'name'          =>'required',
            'director'      =>'required',
            'start_date'    =>'required|date_format:Y-m-d',
            'end_date'      =>'required|date_format:Y-m-d|after:start_date',
            'hr'      => 'required|date_format:H',
            'min'      =>'required',
            'poster'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'   => 'required',
            'type'          => 'required'
        ]);
        $hr=$request->hr;
        $min=$request->min;

        //image upload
        if($request->hasfile('poster')){
            if(file_exists(public_path($movie->poster))){
                unlink(public_path($movie->poster));
            }
            $extension=$request->poster->extension();
            $uuid=Str::uuid();
            $request->poster->storeAs('/public/images',$uuid.".".$extension);
            $url=Storage::url('images/'.$uuid.".".$extension);
        }
            Movie::where('id',$id)->update([
           'name'=>$request->name,
           'director'=>$request->director,
            'start_date'=>$request->start_date,
            'end_date' => $request->end_date,
            'duration' => $hr.":".$min,
            'poster'  => $request->poster==''? $movie->poster : $url,
            'description'=>$request->description,
            'type'     => $request->type
            ]);
        
        return redirect()->route('movies.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Movie::destroy($id);
        return redirect()->route('movies.index');
    }
}
