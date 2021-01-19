<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
       
        //$filename  = $name.time().'.'.$extension;
        $extension=$request->image->extension();
        $uuid=Str::uuid();
        $request->image->storeAs('/public/images/theaters',$uuid.".".$extension);
        $url=Storage::url('images/theaters/'.$uuid.'.'.$extension);
        
        Theater::create([
            'name'  => $request->name,
            'location'  => $request->location,
            'image'     => $url,
            'cinema_id' => $id
        ]);
        $request->session()->flash('status','Congratulation,A New Theater was created successfully!');
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
    public function edit($id,$theater)
    {
        $cinema=Cinema::find($id);
        $theater=Theater::find($theater);
        return view('admin.theaters.edit',compact('theater','cinema'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$theater)
    {
        $cinema_theater=Theater::find($theater);
        $request->validate([
            'name'      => 'required',
            'location'  => 'required',
            'image'     => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);
        if($request->hasfile('image')){
           
            if(file_exists(public_path($cinema_theater->image))){
                unlink(public_path($cinema_theater->image));
            }
            $extension=$request->image->extension();
            $uuid=Str::uuid();
            $request->image->storeAs('/public/images/theaters',$uuid.".".$extension);
            $url=Storage::url('images/theaters/'.$uuid.'.'.$extension);
        }
        Theater::where('id',$theater)->update([
            'name'      =>  $request->name,
            'location'  =>  $request->location,
            'image'     =>  $request->image==''? $cinema_theater->image:$url,
        ]);
        $request->session()->flash('status','Congratulation,You have updated successfully!');
        return redirect()->route('theaters.index',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$theater)
    {
        $cinema_theater=Theater::find($theater);
        $cinema_theater->delete();
        return redirect()->route('theaters.index',$id);
    }
}
