@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if ($message = Session::get('status'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            <br>
        @endif
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Booking Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('bookings.index')}}">Bookings</a></li>
                            <li class="breadcrumb-item active">{{ $booking->id }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="callout callout-info">
                            <h5><i class="fas fa-info"></i> Note:</h5>
                            <p>Movies,theaters and seats for these booking are shown in below.Click add new movietheater to add more movies,theaters and cinemas.Also,Edit and Delete as you wish!!</p>
                        </div>
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-film" style='color:#117a8b'></i> Movie Booking
                                        {{-- <small class="float-right">Date: {{ $booking->date }}</small> --}}
                                    </h4>
                                </div>
                            </div>
                            <!-- end title row -->

                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ ucfirst(Auth::user()->name) }}</strong><br>
                                        Phone: {{ Auth::user()->ph_no }}<br>
                                        Email: {{ Auth::user()->email }}
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ ucfirst($booking->user->name) }}</strong><br>
                                        Phone: {{ $booking->user->ph_no }}<br>
                                        Email: {{ $booking->user->email }}
                                    </address>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <b>Booking.No :  {{ $booking->booking_no }}</b><br>
                                    <br>
                                    
                                    <b>Date:</b> {{ $booking->date }}<br>
                                    <b>Time:</b> {{ $booking->time }}
                                </div>
                            </div>
                            <!--end info row -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">ID</th>
                                                <th>Movies</th>
                                                <th>Theaters && Cinemas</th>
                                                <th>Show Dates && Times</th>
                                                <th>Seats</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($booking->movietheater_timetables as $movietheatertimetable)
                                                <tr>
                                                    <td>{{ $movietheatertimetable->id }}</td>
                                                    @foreach($movietheaters as $movietheater)
                                                        @if($movietheater->id == $movietheatertimetable->movietheater_id)
                                                            @foreach($movies as $movie)
                                                                @if($movie->id == $movietheater->movie_id)
                                                                    <td>{{ $movie->name }}</td>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach

                                                    @foreach($movietheaters as $movietheater)
                                                        @if($movietheater->id == $movietheatertimetable->movietheater_id)
                                                            @foreach($theaters as $theater)
                                                                @if($theater->id == $movietheater->theater_id)
                                                                    <td>{{ $theater->name }}
                                                                        <p class="text-bold">{{ $theater->cinema->name }}</p>
                                                                    </td>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach

                                                    @foreach($timetables as $timetable)
                                                        @if($timetable->id == $movietheatertimetable->timetable_id)
                                                            <td>{{ $timetable->show_date }}
                                                                <p class="text-bold">{{ $timetable->show_time }}</p>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    <td>
                                                    @forelse($seats as $seat)
                                                            @foreach($seat as $val)
                                                                @if($movietheatertimetable->pivot->id == $val->pivot->booking_timetable_id)
                                                                {{ $val->seat_no}}
                                                                @endif
                                                            @endforeach
                                                    @empty
                                                        <p>no seat</p>
                                                    @endforelse
                                                    </td> 
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>  
@endsection