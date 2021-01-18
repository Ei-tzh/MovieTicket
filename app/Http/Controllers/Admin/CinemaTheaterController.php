<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Theater;
use App\Cinema;
class CinemaTheaterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $cinema=Cinema::find($id);
        $theaters=$cinema->theaters;
        return view('admin.theaters.index',compact('theaters','cinema'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $cinema=Cinema::find($id);
        return view('admin.theaters.create',compact('cinema'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'location'  => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        $filename=$request->image->getClientOriginalName();
        //$filename  = $name.time().'.'.$extension;
        $request->image->storeAs('/public/images/theaters',$filename);
        $url=Storage::url('images/theaters/'.$filename);
        
        Theater::create([
            'name'  => $request->name,
            'location'  => $request->location,
            'image'     => $url,
            'cinema_id' => $id
        ]);
        return redirect()->route('theaters.index',$id);
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
