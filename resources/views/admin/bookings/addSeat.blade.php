@extends('layouts.master')
@section('style')
<style>
.card-header{
    background-color:#fff;
}
.card-header>h3{
    border:1px solid #17a2b8;
    padding:10px;
    background:#17a2b8;
    border-radius:20px;
    color:#fff;
    margin:0px;
}
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
                    <div class="card " id="app3">
                        <div class="card-header">
                            <h3 class="card-title">Booking Seats</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('bookings.storeSeat',['booking_id'=>$booking->id,'id'=>$booking_movietheatertimetable->id] )}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="booking_no" class="col-md-4 col-form-label text-md-right">Booking.no:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="booking_no" name='booking_no' value="{{ $booking->booking_no }}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="booking_movietheatertimetable_id" class="col-md-4 col-form-label text-md-right">Booking Movietheatertimetable ID:</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" id="booking_movietheatertimetable_id" name='booking_no' value="{{ $booking_movietheatertimetable->id }}" disabled>
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
                                               {{ $seat->id==$booking_seat->id?'disabled checked':''}} 
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
{{-- @push('vue')
    <script>
        window.onload = function () {
            var app3= new Vue({
            el: '#app3',
             data: {
                checkedSeat:3,
                seatName:''
                },
                methods:{
                   /* seatName:function(value){
                        for(var j=0;j<value.length;j++){
                            for(var i=0;i<this.theaters.seats.length;i++){
                                if(this.theaters.seats[i].id==value[j]){
                                    return this.theaters.seats[i].seat_no
                                }
                            }
                        }
                            
                        
                    }
                }*/
                    getSeats:function(){
                        axios.get('/api/getSeats',{
                            params: {
                                id: this.checkedSeat
                            }
                        })
                        .then(function(response){
                            this.seatName= response.data;
                        }.bind(this));
                    }
                }
            })
        }
    </script>
@endpush --}}