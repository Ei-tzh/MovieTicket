@extends('layouts.master')

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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-info">
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
                                            <select class="form-control" id='user' name='user' style="width: 100%;" >
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

                                    <div class="form-group row">
                                        <label for="movietheater_timetables" class="col-md-4 col-form-label text-md-right">Movie Theater's timetables:</label>

                                        <div class="col-md-6">
                                            <select class="form-control" id='movietheater_timetables' name='movietheater_timetables' style="width: 100%;" >
                                                @foreach($movietheater_timetables as $key=>$movietheater_timetable)
                                                    @foreach($timetables as $timetable)
                                                        @if($key==$timetable->id)
                                                            <option value="{{ $timetable->id }}" disabled>{{ $timetable->show_time."/".$timetable->show_date }}</option>
                                                            @foreach($timetable->movie_theaters as $value)
                                                               
                                                                   @foreach($movies as $movie)
                                                                        @foreach($theaters as $theater)
                                                                            @if($value->movie_id== $movie->id && $value->theater_id== $theater->id )
                                                                                <option value="{{ $timetable->id }},{{ $value->id }}">{{ $movie->name.' - '.$theater->name.'( '.$theater->cinema->name.' )' }}</option>
                                                                                
                                                                            @endif
                                                                        @endforeach
                                                                
                                                                    @endforeach
                                                                
                                                            @endforeach 
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
                                    {{-- <div class="form-group row">
                                        <label for='date' class="col-md-4 col-form-label text-md-right">Date:</label>

                                        <div class="input-group col-md-6">
                                            <input type="text" class="form-control float-right" id="date" name="date" placeholder="Choose date">
                                        </div>
                                        @error('date')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div> --}}

                                    {{-- <div class="form-group row">
                                        <label for='time' class="col-md-4 col-form-label text-md-right">Time:</label>

                                        <div class="input-group col-md-6">
                                            <input type="text" class="form-control float-right" id="time" name="time" placeholder="Choose time">
                                        </div>
                                        @error('time')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Submit') }}
                                            </button>
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
            //Date range picker
            $('#date').datepicker({ dateFormat: 'yy-mm-dd' });
            //Timepicker
            $('#time').timepicker({
                timeFormat: 'HH:mm:ss' 
            });
            
        });
    </script>
@endpush
