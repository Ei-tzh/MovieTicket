<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Movie;
use App\Cinema_movie;
use App\Theater;
use App\Movie_theater;
use App\Category;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies=Movie::paginate(3);
        return view('admin.movies.index',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.movies.create',compact('categories'));
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
            'hr'            =>'required|date_format:H',
            'min'           =>'required',
            'poster'        =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'   =>'required',
            'casts'         =>'required',
            'categories'    =>'required',
            'type'          =>'required'
        ]);

        $extension=$request->poster->extension();
        $uuid=Str::uuid();

        $request->poster->storeAs('/public/images/movies',$uuid.".".$extension);
        $url=Storage::url('images/movies/'.$uuid.".".$extension);

        $hr=$request->hr;
        $min=$request->min;

        $movie=Movie::create([
            'name' => $request->name,
            'director'=>$request->director,
            'duration' => $hr.":".$min,
            'poster'  => $url,
            'description'=>$request->description,
            'casts'     => $request->casts,
            'type'     => $request->type
        ]);
        $movie->categories()->attach($request->categories);
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
        $theaters=$movie->theaters;
        foreach($theaters as $theater){
            $cinema=$theater->cinema;
            $movie_theater=Movie_theater::where('id',$theater->pivot->id)->get();
            $movie_theaters[]=$movie_theater;
            foreach($movie_theater as $val){
                $timetable=$val->timetables;
            }
        }
       return view('admin.movies.show',compact('movie','categories','theaters','movie_theaters'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::all();
        $movie=Movie::find($id);
        $movie_categories=$movie->categories;
        return view('admin.movies.edit',compact('movie','movie_categories','categories'));
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
            'hr'      => 'required|date_format:H',
            'min'      =>'required',
            'poster'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'   => 'required',
            'casts'   => 'required',
            'categories'=>'required',
            'type'          => 'required'
        ]);
        $hr=$request->hr;
        $min=$request->min;

        //image upload
        //if you upload a new photo,it will remove old photo in folder.
        if($request->hasfile('poster')){
            if(file_exists(public_path($movie->poster))){
                unlink(public_path($movie->poster));
            }
            $extension=$request->poster->extension();
            $uuid=Str::uuid();
            $request->poster->storeAs('/public/images/movies',$uuid.".".$extension);
            $url=Storage::url('images/movies/'.$uuid.".".$extension);
        }
            Movie::where('id',$id)->update([
            'name'=>$request->name,
            'director'=>$request->director,
            'duration' => $hr.":".$min,
            'poster'  => $request->poster==''? $movie->poster : $url,
            'description'=>$request->description,
            'casts'      =>$request->casts,
            'type'     => $request->type
            ]);

        $movie->categories()->sync($request->categories); //it detachs all datas and set them up new with newID
        $request->session()->flash('status','Congratulation,You have updated successfully!');
        return redirect()->route('movies.index');
        //return $extension;
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
