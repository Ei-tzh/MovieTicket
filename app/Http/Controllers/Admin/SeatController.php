<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Theater;
use App\Seat;
class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id,$theater)
    {
        
        $cinematheater=Theater::find($theater);
        //$seats=$theater->seats()->orderby('price','asc')->get();
        $seats=$cinematheater->seats;
        return view('admin.seats.index',compact('id','cinematheater','seats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id,$theater)
    {
        $cinematheater=Theater::find($theater);
        return view('admin.seats.create',compact('cinematheater'));
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
            'seats.*'  => 'regex:/^([A-Z]?)([0-9]{1,2})$/', //any string that contain only 1st character uppercase A to Z and digit between 1 or 2 words.(eg-A22)
            'prices.*'  =>'regex:/^([1-9]+)(\d{1,4})$/'     //any digit that contain 1st number through 1 to 9 and any number only between 1 and 4 words
        ]);
        $cinematheater=Theater::find($theater);
        
        foreach($request->seats as $key=>$value){
            Seat::create([
                'seat_no'=>$value,
                'price'=>$request->prices[$key],
                'theater_id'=>$theater
            ]);
        }
       
        $request->session()->flash('status','You have successfully created new seats!');
        return redirect()->route('seats.index',[$id,$theater]);
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
    public function edit($id,$theater,$seat)
    {
        $cinematheater=Theater::find($theater);
        $seat=Seat::find($seat);
        //return $seat->theater->cinema->id;
        return view('admin.seats.edit',compact('id','cinematheater','seat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,$theater,$seat,Request $request)
    {
        $request->validate([
            'seat_no'  => 'regex:/^([A-Z]?)([0-9]{1,2})$/', //any string that contain only 1st character uppercase A to Z and digit between 1 or 2 words.(eg-A22)
            'price'    =>  'regex:/^([1-9]+)(\d{1,4})$/'     //any digit that contain 1st number through 1 to 9 and any number only between 1 and 4 words
        ]);
        $seat_update=Seat::find($seat);
        Seat::where('id',$seat)->update([
            'seat_no'=>$request->seat_no,
            'price' => $request->price
        ]);
        $request->session()->flash('status','You have successfully updated for '.$seat_update->seat_no.' .');
        return redirect()->route('seats.index',[$id,$theater]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$theater,$seat)
    {
        Seat::destroy($seat);
        return redirect()->route('seats.index',[$id,$theater]);
    }
}
