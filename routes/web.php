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

Route::resource('/admin/dashboard', 'Admin\AdminController')->middleware(['auth','admin']);
Route::get('/home','HomeController@index')->name('home')->middleware(['auth','user']);

Route::resource('/admin/movies','Admin\MovieController');
Route::resource('/admin/movieCategories','Admin\MovieCategoriesController');
Route::resource('/admin/cinemas','Admin\CinemaController');
Route::resource('/admin/cinemas/{id}/theaters','Admin\CinemaTheaterController');
Route::resource('/admin/cinemas/{id}/theaters/{theater}/movietheaters','Admin\MovieTheaterController');
Route::resource('/admin/cinemas/{id}/theaters/{theater}/seats','Admin\SeatController');
Route::resource('/admin/townships','Admin\TownshipController');

// Route::get('/admin/cinemas/{cinema_id}/theaters/{theater_id}','Admin\TheaterController@create')->name('theaters.create');
// Route::post('/admin/cinemas/{cinema_id}/theaters/{theater_id}','Admin\TheaterController@store')->name('theaters.store');
// Route::get('/admin/cinemas/{cinema_id}/theaters/{theater_id}/edit/{id}','Admin\TheaterController@edit')->name('theaters.edit');
// Route::put('/admin/cinemas/{cinema_id}/theaters/{theater_id}/edit/{id}','Admin\TheaterController@update')->name('theaters.update');
// Route::get('/admin/cinemas/{cinema_id}/theaters/{theater_id}/delete/{id}','Admin\TheaterController@destroy')->name('theaters.destroy');

//Route::resource('/admin/cinemas/{cinema_id}/theaters/{theater_id}/seats','Admin\SeatController');

Route::resource('/admin/timetables','Admin\TimetableController');
Route::get('/admin/timetables/{id}/add','Admin\TimetableController@add')->name('timetables.add');
Route::post('/admin/timetables/{id}','Admin\TimetableController@add_new')->name('timetables.add_new');
Route::get('/admin/timetables/{id}/remove/{movietheater_id}','Admin\TimetableController@remove')->name('timetables.remove');
//Route::get('/admin/timetables/delete','TimetableController@delete')->name('timetables.delete');

Route::resource('/admin/users','Admin\UserController');
Route::resource('/admin/bookings','Admin\BookingController');


Route::get('/admin/bookings/{id}/addmovietheater','Admin\BookingController@addmovietheater')->name('bookings.addmovietheater');
Route::post('/admin/bookings/{id}','Admin\BookingController@storemovietheater')->name('bookings.storemovietheater');
Route::get('/admin/bookings/{booking_id}/{id}/addSeat','Admin\BookingController@addSeat')->name('bookings.addSeat');  
Route::post('/admin/bookings/{booking_id}/{id}','Admin\BookingController@storeSeat')->name('bookings.storeSeat');  
Route::get('/admin/bookings/{booking_id}/{id}/edit-BookingSeat','Admin\BookingController@editBookingSeat')->name('bookings.editBookingSeat');  
Route::put('/admin/bookings/{booking_id}/{id}','Admin\BookingController@updateBookingSeat')->name('bookings.updateBookingSeat');  
Route::delete('/admin/bookings/{booking_id}/{id}','Admin\BookingController@deleteMovietheater')->name('bookings.deleteMovietheater');  

Route::resource('/admin/testing','test\testController');

//main page
Route::resource('/home/allmovies','Main\MoviesController');
