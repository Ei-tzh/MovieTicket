@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $cinematheater->cinema->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}">Cinemas</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('theaters.index',$cinematheater->cinema->id)}}">Theaters</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('movietheaters.index',[$cinematheater->cinema->id,$cinematheater->id])}}">Movies</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('timetables.index',[$cinematheater->cinema->id,$cinematheater->id,$movie_theater->id])}}">Timetables</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $movie->name }}<span class="badge badge-pill badge-light">{{ $cinematheater->name }}</span></h3>
                        </div>
                        <form action="{{ route('timetables.store',[$cinematheater->cinema->id,$cinematheater->id,$movie_theater->id])}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Show Date:</label>
                                    <div class="input-group date" id="datepicker" data-target-input="nearest">
                                        <div class="input-group-prepend" data-target="#datepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                        <input type="text" class="form-control datetimepicker-input" name="showdate" data-target="#datepicker" data-toggle="datetimepicker"/>
                                    </div>
                                    @error('showdate')
                                        <small id="bodyhelp" class="form-text text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Show Time:</label>
                                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                                        <div class="input-group-prepend" data-target="#timepicker" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                        </div>
                                        <input type="text" class="form-control datetimepicker-input" name="showtime" data-target="#timepicker" data-toggle="datetimepicker"/>
                                    </div>
                                    @error('showtime')
                                        <small id="bodyhelp" class="form-text text-danger">*{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add Movie</button>
                                <a href="{{ route('timetables.index',[$cinematheater->cinema->id,$cinematheater->id,$movie_theater->id]) }}"><button type="button" class="btn btn-danger">Back</button></a>
                            </div>
                        </form>
                    <div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('jquery')
    <script>
        $(document).ready(function(){
            // $('#datepicker').datepicker({
            //     container:'.main-header',
            //     format: 'yyyy/mm/dd',
            //     todayHighlight:true,
            //     autoclose:true
            // });
            $('#datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
            $('#timepicker').datetimepicker({format: 'HH:mm:ss'});
        });
    </script>
@endpush