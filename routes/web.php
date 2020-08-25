<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/home/movies','MovieController');
Route::resource('/home/cinemas','CinemaController');
Route::resource('/home/test','test\testController');
Route::get('/home/cinemas/{cinema_id}/theaters/{theater_id}','TheaterController@create')->name('theaters.create');
Route::post('/home/cinemas/{cinema_id}/theaters/{theater_id}','TheaterController@store')->name('theaters.store');