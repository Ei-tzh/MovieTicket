@extends('layouts.master')
@section('content')

    <div class="content-wrapper">
        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="card card-info" id="create_booking">
                            <div class="card-header">
                                <h3 class="card-title">Create Booking</h3>
                            </div>
                            <form action="{{ route('bookings.storemovietheater',$booking->id)}}" method="post">
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="booking_no" class="col-md-4 col-form-label text-md-right">Booking.No:</label>

                                        <div class="col-md-6">
                                            <input id="booking_no" type="text" class="form-control " name="booking_no" value="{{ $booking->booking_no }}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user" class="col-md-4 col-form-label text-md-right">User:</label>

                                        <div class="col-md-6">
                                            <input id="user" type="text" class="form-control " name="user" value="{{ $booking->user->name }}"  disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="movietheater_timetables" class="col-md-4 col-form-label text-md-right">Movie Theater's timetables:</label>

                                        <div class="col-md-6">
                                            <select class="form-control @error('movietheater_timetables') is-invalid @enderror" id='movietheater_timetables' name='movietheater_timetables[]' style="width: 100%;" multiple >
                                               @foreach($movietheater_timetables as $movietheater_timetable)
                                                    @foreach($timetables as $timetable)
                                                        @if($movietheater_timetable->timetable_id==$timetable->id)
                                                            
                                                            @foreach($movietheaters as $movietheater)
                                                                @if($movietheater_timetable->movietheater_id==$movietheater->id)
                                                                    @foreach($movies as $movie)
                                                                        @foreach($theaters as $theater)
                                                                            @if($movietheater->movie_id== $movie->id && $movietheater->theater_id== $theater->id )
                                                                            <optgroup label='{{ $timetable->show_time."/".$timetable->show_date }}'>
                                                                                <option value="{{$movietheater_timetable->id}}">
                                                                                   {{ $movie->name.' - '.$theater->name.'( '.$theater->cinema->name.' )'}}
                                                                                </option>
                                                                            </optgroup>
                                                                            @endif
                                                                        @endforeach
                                                                    @endforeach
                                                                @endif
                                                            @endforeach 
                                                            
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            <select>
                                            @error('movietheater_timetables')
                                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Submit') }}
                                            </button>
                                            <a href="{{ route('bookings.show',$booking->id)}}">
                                                <button type="button" class="btn btn-danger">
                                                   Cancel
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection



@push('jquery')
    <script>
     $(document).ready(function(){
         /*$('#user').select2({
            
        });*/
         $('#movietheater_timetables').select2({
             theme: 'bootstrap4',
             placeholder:"Please Select Movies",
             tags:true
         });
     });
    </script>
@endpush
{{-- @push('vue')
<script>

    window.onload = function () {
       //$('#movietheater').select2();
        var app1= new Vue({
            el: '#app1',
            data: {
                message:'Hello',
                movietheater:0,
                movietheaters:'',
                timetable:0,
                timetables:'',
                movies:'',
                theaters:''
               
            },
        
            methods:{
                    getmovietheaters:function(){
                        axios.get('/api/getmovietheaters')
                    .then(function (response) {
                        this.movietheaters = response.data;
                    }.bind(this));
                },
                gettimetables:function(){
                    axios.get('/api/gettimetables',{
                        params: {
                            id: this.movietheater
                        }
                    })
                    .then(function(response){
                        this.timetables = response.data;
                    }.bind(this));
                },
                getmovies:function(){
                    axios.get('/api/getmovies')
                    .then(function(response){
                        this.movies = response.data;
                    }.bind(this));
                },
                getTheaters:function(){
                    axios.get('/api/gettheaters')
                    .then(function(response){
                        this.theaters = response.data;
                    }.bind(this));
                },
                movienames:function(value){
                    for(var i=0;i<this.movies.length;i++){
                        if(this.movies[i].id==value){
                            return this.movies[i].name
                        }
                    }
                },
                theaters_cinema:function(value){
                    for(var i=0;i<this.theaters.length;i++){
                        if(this.theaters[i].id==value){
                            var theater= this.theaters[i].name
                            var cinema=this.theaters[i].cinema.name
                            return (theater.concat('( ',cinema,' )'))
                        }
                    }
                }

               
            },
            created: function(){
                this.getmovietheaters(),
                this.getmovies(),
                this.getTheaters()
            }
        })
    }
    
</script>
@endpush --}}