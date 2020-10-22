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
    public function index($cinema_id,$theater_id)
    {
        $theater=Theater::find($theater_id);

        return view('admin.seats.index',compact('theater'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cinema_id,$theater_id)
    {
        $theater=Theater::find($theater_id);
        return view('admin.seats.create',compact('theater'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$cinema_id,$theater_id)
    {
        $request->validate([
            'seats.*'  => 'regex:/^([A-Z]?)([0-9]{1,2})$/', //any string that contain only 1st character uppercase A to Z and digit between 1 or 2 words.(eg-A22)
            'prices.*'  =>'regex:/^([1-9]+)(\d{1,4})$/'     //any digit that contain 1st number through 1 to 9 and any number only between 1 and 4 words
        ]);
        return $request;
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
