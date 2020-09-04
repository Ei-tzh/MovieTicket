@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- @if ($message = Session::get('status'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            <br>
        @endif --}}
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="{{ route('timetables.create') }}" class="float-left">
                            <button class='btn btn-success'><i class="fas fa-plus"></i> Add New Timetable</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Timetables</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Timetables Table</h3>
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
                        <table class="table ">
                            <thead class="bg-success text-white">  
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Dates & Times</th>
                                    <th>Cinemas & Theaters<th>
                                    <th>Movies</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timetables as $timetable)
                                    <tr>
                                        <td>{{ $timetable->id }}</td>
                                        <td>{{ $timetable->show_date }}<span class="border rounded p-1 ml-3 border-success">{{ ' '.$timetable->show_time}}</span></td>
                                        {{-- getting cinemas and theater --}}
                                        <td>
                                            <table class="table">
                                                    @foreach($timetable->movie_theaters as $movie_theater)
                                                        @foreach($theaters as $theater)
                                                            @if($movie_theater->theater_id == $theater->id)
                                                                <tr class="table-success">
                                                                    <td>{{ $theater->cinema->name }}<br>{{ $theater->name }}</td>
                                                                    {{-- <td>{{ $movie_theater->id }}</td> --}}
                                                                </tr>
                                                            @endif 
                                                        @endforeach
                                                    @endforeach 
                                            </table>
                                        </td>
                                        {{-- ??? --}}
                                        <td></td>
                                        {{-- getting movie name --}}
                                        <td>
                                            <table class="table ">
                                                @foreach($timetable->movie_theaters as $movie_theater)
                                                    @foreach($movies as $movie)
                                                        @if($movie_theater->movie_id == $movie->id)
                                                            <tr class="table-success">
                                                                <td class="p-4">{{ $movie->name }}</td>
                                                                <td class="p-4">
                                                                        <a href="{{ route('movies.edit',$movie->id) }}" title="Edit">
                                                                            <i class="fas fa-edit blue"></i>
                                                                        </a> /
                                                                        @method('DELETE')
                                                                        <a href="{{ route('movies.destroy',$movie->id) }}" title="Delete">
                                                                            <i class="fas fa-trash red"></i>
                                                                        </a>
                                                                </td>
                                                            </tr>
                                                        @endif 
                                                    @endforeach
                                                @endforeach 
                                            </table>
                                        </td>
                                        {{-- total numbers of seats --}}
                                        {{-- <td>
                                            <table class="table">
                                                @foreach($timetable->movie_theaters as $movie_theater)
                                                    @foreach($seats as $key=>$value)
                                                        @if($value[$key]->movietheater_timetable_id == $movie_theater->pivot->id)
                                                            <tr class="table-success">
                                                                <td class="p-4">{{ count($value).' seats' }}</td>
                                                                    <td class="p-4">
                                                                        <a href="{{ route('movies.edit',$movie->id) }}" title="Edit">
                                                                            <i class="fas fa-edit blue"></i>
                                                                        </a> /
                                                                        @method('DELETE')
                                                                        <a href="{{ route('movies.destroy',$movie->id) }}" title="Delete">
                                                                            <i class="fas fa-trash red"></i>
                                                                        </a>
                                                                    </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </table>
                                        </td> --}}
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