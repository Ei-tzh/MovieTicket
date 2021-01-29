@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row" >
                <div class="col-lg-12">
                    
                    <div class="card card-info" id="edit">
                        <div class="card-header">
                            <h3 class="card-title">New Booking</h3>
                        </div>
                        <form action="{{ route('bookings.store')}}" method="post">
                        @csrf
                        
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="booking_no">Booking.No:</label>
                                    <input id="booking_no" type="text" class="form-control " name="booking_no" value="{{ $booking_no }}" readonly>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="user">User:</label>
                                    <select class="form-control col-md-6 select2" id='user' name='user' style="width: 100%;" >
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    <select>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <div class="form-check">
                                            <input class="form-check-input" id="current_datetime" type="checkbox"  name="checkbox">
                                            <label class="form-check-label" for="current_datetime" ><u>Current Date and Time</u></label>
                                        </div>
                                    </div>
                                    @error('checkbox')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('bookings.index') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>
                        </form>
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
             placeholder:"Please Select Movies You Want To Book",
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
