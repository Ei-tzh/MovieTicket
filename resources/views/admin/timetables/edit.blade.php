@extends('layouts.master');
@section('style')
<style>
.input-group-text{
    color: #fff;
    background-color: #6cb2eb;
    border: 1px solid #6cb2eb;
}
.select2-container .select2-selection--single{
    height:40px;
}
.select2-container--default .select2-selection--multiple{
    border: 1px solid #6cb2eb;
   
}
</style>
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Timetable</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('timetables.update',$timetable->id) }}" method="post">
                        @csrf
                        @method('put')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for='date'>Date:</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="date" name="show_date" value="{{ $timetable->show_date }}">
                                    </div>
                                    @error('show_date')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    <!-- /.input group -->
                                </div>

                                {{-- show time --}}
                                <div class="form-group">
                                    <label>Time:</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend" >
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="time" name="show_time" value="{{ $timetable->show_time }}">
                                    </div>
                                   @error('show_time')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                {{-- Movie --}}
                                <div class="form-group">
                                    <label for='movie_theaters'>Movies & Theaters:</label>
                                    <select class="form-control" id='movie_theaters' name='movie_theaters[]' style="width: 100%;" multiple="multiple" disabled>
                                        @foreach($timetable->movie_theaters as $movie_theater)
                                            @foreach($movies as $movie)
                                                @foreach($theaters as $theater)
                                                    @if($movie_theater->movie_id == $movie->id && $movie_theater->theater_id == $theater->id)
                                                            
                                                        <option value="{{ $movie_theater->id}}" selected>{{ $movie->name.' - '.$theater->name.'( '.$theater->cinema->name.' )'}}</option>
                                                        
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            
                                        @endforeach
                                    </select>
                                    
                                </div>
                                
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('timetables.index') }}">
                                    <button type="button" class="btn btn-danger">Back</button>
                                </a>
                            </div>
                        </form>
                         <!-- form end -->
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
        //Movie_theaters

        $('#movie_theaters').select2({
                placeholder:"Select Movies to show date and time",
                tags:true
            });
    });
    </script>
@endpush