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
