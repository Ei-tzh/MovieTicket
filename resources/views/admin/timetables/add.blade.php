@extends('layouts.master')
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $timetable->show_date}}<span class="border rounded p-1 ml-3 border-white">{{ $timetable->show_time }}</span></h3>
                            </div>
                        <form action="{{ route('timetables.add_new',$timetable->id )}}" method="post">
                        @csrf
                            <div class="card-body">
                                <table class="table">
                                    <thead class="table-primary">  
                                        <tr>
                                            <th>Cinema</th>
                                            <th>Theater</th>
                                            <th>Movie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($timetable->movie_theaters as $movie_theater)
                                            
                                                @foreach($theaters as $theater)
                                                    @if($movie_theater->theater_id == $theater->id)
                                                    <tr>
                                                        <td>{{$theater->name}}</td>
                                                        <td>{{ $theater->cinema->name }}</td>
                                                        
                                                    
                                                    @endif 
                                                @endforeach
                                                @foreach($movies as $movie)
                                                    @if($movie_theater->movie_id == $movie->id)
                                                        <td>{{$movie->name}}</td>
                                                    @endif
                                                @endforeach
                                                    </tr>
                                        @endforeach
                                    </tbody> 
                                </table>
                                        
                                <div class="form-group mt-3">
                                    <label for='movie_theaters'>Movies & Theaters:</label>
                                        <select class="form-control" id='movie_theaters' name='movie_theaters[]' style="width: 100%;" multiple="multiple">
                                                @foreach($movie_theaters as $movie_theater)
                                                    @foreach($movies as $movie)
                                                        @foreach($theaters as $theater)
                                                        
                                                            @if($movie_theater->movie_id == $movie->id && $movie_theater->theater_id == $theater->id)
                                                                
                                                                <option value="{{ $movie_theater->id}}" 
                                                                    @foreach($timetable->movie_theaters as $value)
                                                                    {{$value->id == $movie_theater->id ? 'disabled':''}}
                                                                    @endforeach
                                                                    >{{ $movie->name.' - '.$theater->name.'( '.$theater->cinema->name.' )'}}</option>
                                                            
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
                                           
                                        </select>
                                        @error('movie_theaters')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="{{ route('timetables.index') }}">
                                    <button type="button" class="btn btn-danger">Back</button>
                                </a>
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
        //Movie_theaters

        $('#movie_theaters').select2({
                placeholder:"Select Movies to show date and time",
                tags:true
            });
    });
    </script>
@endpush