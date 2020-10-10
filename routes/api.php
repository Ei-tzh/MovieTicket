<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Movie;
use App\Cinema_movie;
use App\Timetable;
use App\Theater;
use App\Movietheater_timetable;
use App\Movie_theater;
use App\Booking_movietheatertimetable;
use App\Seat;
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
    // $movie=App\Movie::find(1);
    // $cinema=App\Cinema_movie::where('movie_id',$movie->id)->first();
    // return $cinema->theaters;
    $theater=App\Theater::find(1);
    return $theater->cinema_movie;

    
});
Route::get('/testing_seat',function(){
    //$seat=App\Seat::count();
    $theater=App\Theater::find(1);

    return $theater->seats()->paginate(5);
});
Route::get('/booking',function(){
    $booking=App\Booking::find(1);
    return $booking->seat_timetable_theaters;
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
Route::get('/theater_timetable',function(){
    $theater=App\Theater::find(2);
    $aa=$theater->timetables()->having('pivot_id',3)->first();
    $bb=$aa->pivot->id;
    $theater_timetable=App\Timetable_theater::find($bb);

    return $theater_timetable->seats;
});
Route::get('/test',function(){
    $movies=Movie::find(1);
    //$cinemas=$movies->cinemas()->get();
    foreach($movies->cinemas as $cinema){
        
        // foreach($cinemas as $cinema)
        // {
            $cinemas[]=$cinema;
            $cinema_movies=Cinema_movie::where('id',$cinema->pivot->id)->get();
            
            $cinemamovies[]=$cinema_movies;
           foreach($cinema_movies as $cinema_movie){
                $cinema_theaters=$cinema_movie->theaters;
                $theaters[]=$cinema_theaters;
              
                foreach($cinema_theaters as $cinema_theater){
                    $timetables=$cinema_theater->timetables;
                    $theater_timetables[]=$timetables;
                    
                }
           }
            
        // }
    }
        return $cinemas;
});
Route::get('/array',function(){
        $timetables=Timetable::all();
        $values=[];
        $movie_values=[];
        $seats=[];
        foreach($timetables as $timetable){
            $movietheaters=$timetable->movie_theaters;
            
            foreach($movietheaters as $movietheater){
                $theater=Theater::find($movietheater->theater_id);
                $movie=Movie::find($movietheater->movie_id);
                $seat=Movietheater_timetable::find($movietheater->pivot->id)->seats;

                if(!in_array($theater,$values)){
                    array_push($values,$theater);
                }
                if(!in_array($movie,$movie_values)){
                    array_push($movie_values,$movie);
                }
                
            }
        }
        return $movie_values;
});

Route::get('/getmovietheaters','Admin\APIController@getmovietheaters');
Route::get('/gettimetables','Admin\APIController@gettimetables');
Route::get('/getmovies','Admin\APIController@getmovies');
Route::get('/gettheaters','Admin\APIController@gettheaters');
Route::get('/getSeats','Admin\APIController@getSeatsNo');