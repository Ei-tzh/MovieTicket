@extends('layouts.master');

@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Movie Details</h1>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <img src="{{ $movie->poster }}" alt="{{ $movie->poster }}" style='width:200px;height:300px'>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <h3 class="my-3">{{ $movie->name.'('.$movie->type.')' }}</h3>
                                    <p>Duration - <span class="text-primary font-weight-normal">{{$movie->duration}}</span></p>
                                    <p>Director - <span class="text-primary font-weight-normal">{{$movie->director}}</span></p>
                                    <p>Cast - </p>
                                    @foreach($categories as $category)
                                        <span class="text-primary font-weight-bold">{{ $category->name."," }}</span>
                                    @endforeach
                                    <p></p>
                                    <p>Description - <span class="text-primary font-weight-normal">{{ $movie->description}}</span></p>
                                     <hr>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card-header bg-success">
                            <h3 class="card-title">Show Times</h3>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 150px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <!-- </card-header> -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>Show Dates</th>
                                            <th>Show Times</th>
                                            <th>Cinemas</th>
                                            <th>Theaters</th>
                                            <th>Bookings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                            <td>{{ $cinemas->name }}</td>
                                            @foreach($theaters as $theater)
                                                
                                                <td>{{ $theater->name }}</td>
                                                
                                            @endforeach
                                            @foreach($timetables as $timetable)
                                                <td>{{ $timetable->show_date}}</td>
                                                <td>{{ $timetable->show_time}}</td>
                                                <td></td>
                                            @endforeach
                                            
                                    </tr>
                                </table>
                            </div>
                            <!-- </card-body> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection