<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CinemaRequest;
use App\Cinema;
use App\Township;
class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cinemas=Cinema::all();
        foreach($cinemas as $cinema){
            $township=$cinema->township;
            $theaters=$cinema->theaters;
        }
        //return $cinemas;
        return view('admin.cinemas.index',compact('cinemas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $townships=Township::all();
        return view('admin.cinemas.create',compact('townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CinemaRequest $request)
    {
        // $validate_array=['name' => 'required',
        //                 'address'  =>'required',
        //                 'theaters' => 'required',
        //                 'township' => 'required'];
        
        $validated = $request->validated();
        $filename = $request->image->getClientOriginalName();
        $request->image->storeAs('/public/images/cinemas',$filename);
        $url=Storage::url('images/cinemas/'.$filename);
        
        $phone=implode(",",$request->ph_no);
        $cinema=Cinema::create([
            'name' => $request->name,
            'address'=>$request->address,
            'ph_no'=>$phone,
            'image' => $url,
            'township_id'=>$request->township
        ]);
        $cinema_theater=Cinema::find($cinema->id);
       foreach($request->theaters as $theater){
            
            $cinema_theater->theaters()->create([
                'name' =>$theater,
                'location'=>'2nd floor'
            ]);
       }
       
        return redirect()->route('cinemas.index');
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
        $cinema=Cinema::find($id);
        return view('admin.cinemas.edit',compact('cinema'));
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
