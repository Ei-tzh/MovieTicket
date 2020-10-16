@extends('layouts.master')
@section('style')
<style>
.form-check{
    display:inline;
    padding-right:8px;
    
}
.checkbox{
    padding-top:5px;
}

</style>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary" id="app3">
                        <div class="card-header">
                            <h3 class="card-title">Edit Booking Seats</h3>
                        </div>
                        <!-- form start -->
                        <form action="" method="post">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="booking_no" class="col-md-4 col-form-label text-md-right">Booking.no:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="booking_no" name='booking_no' value="{{ $booking->booking_no }}" disabled>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="timetable" class="col-md-4 col-form-label text-md-right">Show Date && Time:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="timetable" name='timetable' value="{{ $timetable->show_date.'( '.$timetable->show_time.' )' }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="movie" class="col-md-4 col-form-label text-md-right">Movie:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="movie" name='movie' value="{{ $movie->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cinema" class="col-md-4 col-form-label text-md-right">Cinema:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="cinema" name='cinema' value="{{ $theater->cinema->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="theater" class="col-md-4 col-form-label text-md-right">Theater:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="theater" name='theater' value="{{ $theater->name }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="seats" class="col-md-4 col-form-label text-md-right">Seats:</label>
                                <div class="checkbox col-md-5">
                                   
                                    @foreach($theater->seats as $seat)
                                        <div class="form-check">
                                            <input class="form-check-input" id="{{ $seat->id }}" type="checkbox" value="{{ $seat->id }}" name="seats[]"  @foreach($booking_movietheatertimetable->seats as $booking_seat)
                                               {{ $seat->id==$booking_seat->id?'checked':''}} 
                                            @endforeach >
                                            <label class="form-check-label" for="{{ $seat->id }}" >{{ $seat->seat_no}}</label>
                                        </div>
                                        @if($seat->seat_no =='A7+A8' ||$seat->seat_no =='B10' || $seat->seat_no =='C10' || $seat->seat_no =='D10' || $seat->seat_no =='E10' || $seat->seat_no =='F10')
                                            <br>
                                        @endif   
                                    @endforeach
                                    
                                </div>
                                @error('seats')
                                    <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                        </div>    
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Booking</button>
                            <a href="{{ route('bookings.index') }}">
                                <button type="button" class="btn btn-danger">Back</button>
                            </a>
                        </div>
                        </form>
                         <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
