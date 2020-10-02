@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="card card-info" id="test">
                            <div class="card-header">
                                <h3 class="card-title">Test</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>                  
                                        <tr>
                                            <th>Booking.ID</th>
                                            <th>Seats</th>
                                            <th>Show Dates & Show Times</th>
                                            <th>Movies<td>
                                            <th>Theaters && Cinemas</th>
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
                                                                        <td><p>{{ $theater->name }}</p>{{ $theater->cinema->name }}</td>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach   
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>   
    </div>
@endsection
