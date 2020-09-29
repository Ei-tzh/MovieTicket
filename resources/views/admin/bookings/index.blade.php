@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
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
                        <a href='{{ route('bookings.create')}}' class="float-left">
                            <button class='btn btn-info'><i class="fas fa-plus"></i> Add New Booking</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Bookings</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>                  
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Booking.No</th>
                                    <th>User</th>
                                    <th>Movies</th>
                                    <th>Theaters</th>
                                    <th>Cinemas</th>
                                    
                                    <th>Show Date & Show Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $booking)
                                <tr>
                                    @if(count($booking->movietheater_timetables)>1)
                                        <td rowspan='1'>{{ $booking->id }}</td>
                                        <td rowspan='1'>{{ $booking->booking_no }}</td>
                                    @else
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->booking_no }}</td>
                                    @endif
                                    <td>{{ $booking->user->name }}</td>
                                    <td>
                                       
                                            @foreach($booking->movietheater_timetables as $movietheater_timetable)
                                                @foreach($movietheaters as $movietheater)
                                                    @if($movietheater_timetable->movietheater_id == $movietheater->id)
                                                        @foreach($movies as $movie)
                                                            @if($movietheater->movie_id == $movie->id)
                                                                <p>{{ $movie->name }}</p>
                                                                
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        
                                    </td>
                                    <td>
                                        @foreach($booking->movietheater_timetables as $movietheater_timetable)
                                            @foreach($movietheaters as $movietheater)
                                                @if($movietheater_timetable->movietheater_id == $movietheater->id)
                                                    @foreach($theaters as $theater)
                                                        @if($movietheater->theater_id == $theater->id)
                                                            <p class="text-primary">{{ $theater->name }}<p>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($booking->movietheater_timetables as $movietheater_timetable)
                                            @foreach($movietheaters as $movietheater)
                                                @if($movietheater_timetable->movietheater_id == $movietheater->id)
                                                    @foreach($theaters as $theater)
                                                        @if($movietheater->theater_id == $theater->id)
                                                           
                                                            <p class="text-bold">{{ $theater->cinema->name }}<p>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </td>
                                    
                                    <td>
                                        @foreach($booking->movietheater_timetables as $movietheater_timetable)
                                            @foreach($timetables as $timetable)
                                                @if($movietheater_timetable->timetable_id == $timetable->id)
                                                    <p>{{ $timetable->show_date }},{{ $timetable->show_time}}</p>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    </td>
                                    <td>
                                        <a href="" title="view">
                                            <i class="fas fa-eye green"></i>
                                        </a> /
                                        <a href="" title="Edit">
                                            <i class="fas fa-edit blue"></i>
                                        </a> /
                                        @method('DELETE')
                                        <a href="" title="Delete">
                                            <i class="fas fa-trash red"></i>
                                        </a>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
              <!-- /.card-body -->
              
            </div>
        </section>
    </div>
@endsection