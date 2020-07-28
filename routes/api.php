<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Movie;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/testing',function(){
    
    $movie= App\Movie::find(2);
    return $movie->cinemas;
});
Route::get('/testing_theater',function(){
    // $cinema_movie=App\Cinema_movie::find(1);
    // $cinema=App\Cinema::find($cinema_movie->cinema_id);
    // $movie=App\Movie::find($cinema_movie->cinema_id);
    $movie=App\Movie::find(1);
    $cinema=App\Cinema_movie::where('movie_id',$movie->id)->first();
    return $cinema->theaters;
    
    
});
Route::get('/testing_seat',function(){
    //$seat=App\Seat::count();
    $theater=App\Theater::find(1);

    return $theater->seats()->paginate(5);
});
Route::get('/booking',function(){
    //$seat=App\Seat::count();
    $user=App\User::find(1);
    
    //$booking=$user->bookings;
    $booking=App\Booking::find(1);
    $timetable=App\Timetable_theater::find($booking->timetabletheater_id);
    $theater=App\Theater::find($timetable->theater_id);
    //$showtime=App\Timetable::find($timetable->timetable_id);
    return $theater->seats;
});
Route::get('/seats',function(){
    $seat=App\Seat::find(1);
    $theater= $seat->theaters()->first();
    $aa=$theater->cinema_movie;
    $cinema=App\Cinema::find($aa->cinema_id);
    return $cinema->movies;
});
Route::get('/booking_seat',function(){
    $seat=App\Seat_theater::find(1);
    $booking=App\Booking::find(1);
    return $booking->seat_theaters;
});
