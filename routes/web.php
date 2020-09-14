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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/admin','adminController@index')->name('admin')->middleware('admin');

Route::resource('/home/movies','MovieController');
Route::resource('/home/cinemas','CinemaController');
Route::resource('/home/test','test\testController');

Route::get('/home/cinemas/{cinema_id}/theaters/{theater_id}','TheaterController@create')->name('theaters.create');
Route::post('/home/cinemas/{cinema_id}/theaters/{theater_id}','TheaterController@store')->name('theaters.store');
Route::get('/home/cinemas/{cinema_id}/theaters/{theater_id}/edit/{id}','TheaterController@edit')->name('theaters.edit');
Route::put('/home/cinemas/{cinema_id}/theaters/{theater_id}/edit/{id}','TheaterController@update')->name('theaters.update');
Route::get('/home/cinemas/{cinema_id}/theaters/{theater_id}/delete/{id}','TheaterController@destroy')->name('theaters.destroy');

Route::resource('/home/timetables','TimetableController');
Route::get('/home/timetables/{id}/add','TimetableController@add')->name('timetables.add');
Route::post('/home/timetables/{id}','TimetableController@add_new')->name('timetables.add_new');
Route::get('/home/timetables/{id}/remove/{movietheater_id}','TimetableController@remove')->name('timetables.remove');
//Route::get('/home/timetables/delete','TimetableController@delete')->name('timetables.delete');

Route::resource('/home/users','UserController');