@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="card card-info" id="edit">
                            <div class="card-header">
                                <h3 class="card-title">Edit Booking</h3>
                            </div>
                            <form action="" method="post">
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="booking_no" class="col-md-4 col-form-label text-md-right">Booking.No:</label>

                                        <div class="col-md-6">
                                            <input id="booking_no" type="text" class="form-control @error('booking_no') is-invalid @enderror" name="booking_no" value="{{ $booking->booking_no }}" disabled>

                                            
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="movietheater_timetables" class="col-md-4 col-form-label text-md-right">Movie Theater's timetables:</label>

                                        <div class="col-md-6">
                                            <select class="form-control @error('movietheater_timetables') is-invalid @enderror" id='movietheater_timetables' name='movietheater_timetables[]' style="width: 100%;">
                                                @foreach($movietheater_timetables as $movietheater_timetable)
                                                    
                                                        @foreach($timetables as $timetable)
                                                            @if($movietheater_timetable->timetable_id==$timetable->id)
                                                                
                                                                        @foreach($movietheaters as $movietheater)
                                                                            @if($movietheater_timetable->movietheater_id==$movietheater->id)
                                                                                @foreach($movies as $movie)
                                                                                @foreach($theaters as $theater)
                                                                                    @if($movietheater->movie_id== $movie->id && $movietheater->theater_id== $theater->id )
                                                                                        <option value="{{$movietheater_timetable->id}}"
                                                                                        {{ $booking_movietheatertimetable->movietheater_timetable_id == $movietheater_timetable->id ? 'selected':''}}
                                                                                        >
                                                                                        {{ $movie->name.' - '.$theater->name.'( '.$theater->cinema->name.' )' }}
                                                                                        </option>
                                                                                    @endif
                                                                                @endforeach
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach 
                                                                </optgroup>
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
                                                {{ __('Update') }}
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
         
         $('#movietheater_timetables').select2({
             theme: 'bootstrap4',
             placeholder:"Please Select Movies You Want To Book",
             tags:true
         });
     });
    </script>
@endpush