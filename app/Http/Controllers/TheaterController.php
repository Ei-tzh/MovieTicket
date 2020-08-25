<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cinema;
use App\Movie;
class TheaterController extends Controller
{
    public function create($cinema_id,$theater_id){
        $cinema=Cinema::find($cinema_id);
        $theater=$cinema->theaters()->where('id',$theater_id)->first();
        $movies=Movie::all();
        return view('admin.theaters.create')->with('cinema',$cinema)->with('theater',$theater)->with('movies',$movies);
    }
    public function store($cinema_id,$theater_id){
        $cinema=Cinema::find($cinema_id);
        return redirect()->route('cinemas.show',$cinema->id);
    }
}
