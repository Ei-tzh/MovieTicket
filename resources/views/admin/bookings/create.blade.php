@extends('layouts.master')
@section('style')
<style>
   select>option{ 
                   height:20px;
                 }
</style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('bookings.index') }}">Bookings</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section> --}}
        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="card card-info" id="app1">
                            <div class="card-header">
                                <h3 class="card-title">Create Booking</h3>
                            </div>
                            <form action="{{ route('bookings.store')}}" method="post">
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="booking_no" class="col-md-4 col-form-label text-md-right">Booking.No:</label>

                                        <div class="col-md-6">
                                            <input id="booking_no" type="text" class="form-control @error('booking_no') is-invalid @enderror" name="booking_no" value="{{ $booking_no }}"  autocomplete="name" autofocus>

                                            @error('booking_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="user" class="col-md-4 col-form-label text-md-right">User:</label>

                                        <div class="col-md-6">
                                            <select class="form-control js-states select2" id='user' name='user' style="width: 100%;" >
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            <select>
                                            @error('user')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- <div class="form-group row" >
                                        <label for="movietheater" class="col-md-4 col-form-label text-md-right">Movie Theaters:</label>

                                        <div class="col-md-6">
                                           <select class="form-control"  id='movietheater' name="movietheater" v-model='movietheater' @change='gettimetables()'>
                                                <option value='0'>Select Movietheaters</option>
                                                <option v-for='data in movietheaters' :value='data.id'>@{{ movienames(data.movie_id) }}-@{{ theaters_cinema(data.theater_id) }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" >
                                        <label for="timetables" class="col-md-4 col-form-label text-md-right">Timetables:</label>

                                        <div class="col-md-6">
                                           <select class='form-control' id='timetables' name='timetables' v-model='timetable'>
                                                <option value='0'>Select Timetables</option>
                                                <option v-for='data in timetables'  :value='data.id'>@{{ data.show_time }} - @{{ data.show_date}}</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                
                                    <div class="form-group row">
                                        <label for="movietheater_timetables" class="col-md-4 col-form-label text-md-right">Movie Theater's timetables:</label>

                                        <div class="col-md-6">
                                            <select class="form-control js-states" id='movietheater_timetables' name='movietheater_timetables[]' style="width: 100%;" multiple >
                                                @foreach($movietheater_timetables as $key=>$movietheater_timetable)
                                                    @foreach($timetables as $timetable)
                                                        @if($key==$timetable->id)
                                                            <optgroup label='{{ $timetable->show_time."/".$timetable->show_date }}'>
                                                                @foreach($timetable->movie_theaters as $value)
                                                                
                                                                    @foreach($movies as $movie)
                                                                            @foreach($theaters as $theater)
                                                                                @if($value->movie_id== $movie->id && $value->theater_id== $theater->id )
                                                                                    <option value="{{ $timetable->id }},{{ $value->id }}">{{ $movie->name.' - '.$theater->name.'( '.$theater->cinema->name.' )' }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                    
                                                                        @endforeach
                                                                    
                                                                @endforeach 
                                                            </optgroup>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            <select>
                                            @error('movietheater_timetables')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Submit') }}
                                            </button>
                                            <a href="{{ route('bookings.index')}}">
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
         $('#user').select2({
            theme: 'bootstrap4',
        });
         $('#movietheater_timetables').select2({
            
             placeholder:"Please Select Movies You Want To Book"
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
