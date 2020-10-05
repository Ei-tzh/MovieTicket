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
                                    <th>Booking.ID</th>
                                    <th>Seats</th>
                                    <th>Show Dates & Show Times</th>
                                    <th>Movies<th>
                                    <th>Theaters && Cinemas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($booking_movietheatertimetables as $booking_movietheatertimetable)
                                    <tr>
                                        
                                        @foreach($bookings as $booking)
                                            @if($booking->id == $booking_movietheatertimetable->booking_id)
                                                <td>{{ $booking->booking_no}}</td>
                                            @endif
                                        @endforeach

                                        <td>
                                            @foreach($booking_movietheatertimetable->seats as $seat)
                                                    {{ $seat->seat_no.' , '}}
                                            @endforeach
                                        </td>

                                        @foreach($movietheater_timetables as $movietheater_timetable)
                                            @if($movietheater_timetable->id == $booking_movietheatertimetable->movietheater_timetable_id)
                                                @foreach($timetables as $timetable)
                                                    @if($timetable->id == $movietheater_timetable->timetable_id)
                                                        <td>{{ $timetable->show_date }} / {{ $timetable->show_time }}</td>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
            
                                        @foreach($movietheater_timetables as $movietheater_timetable)
                                            @if($movietheater_timetable->id == $booking_movietheatertimetable->movietheater_timetable_id)
                                                @foreach($movietheaters as $movietheater)
                                                    @if($movietheater->id == $movietheater_timetable->movietheater_id)
                                                        @foreach($movies as $movie)
                                                            @if($movie->id == $movietheater->movie_id)
                                                                <td>{{ $movie->name }}</td>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach   
                                            @endif
                                        @endforeach
                                        <td></td>
                                        @foreach($movietheater_timetables as $movietheater_timetable)
                                            @if($movietheater_timetable->id == $booking_movietheatertimetable->movietheater_timetable_id)
                                                @foreach($movietheaters as $movietheater)
                                                    @if($movietheater->id == $movietheater_timetable->movietheater_id)
                                                        @foreach($theaters as $theater)
                                                            @if($theater->id == $movietheater->theater_id)
                                                                <td><p class='text-bold'>{{ $theater->name }}</p>{{ $theater->cinema->name }}</td>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach   
                                            @endif
                                        @endforeach
                                        <td>
                                        <a href="{{ route('bookings.addSeat',$booking_movietheatertimetable->id) }}" title="Add Seat">
                                            <i class="fas fa-plus green" ></i>
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