@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    {{-- alert block --}}
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
                   <h1>{{ $cinematheater->cinema->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="">Admin</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}">Cinemas</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('theaters.index',$cinematheater->cinema->id)}}">Theaters</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('movietheaters.index',[$cinematheater->cinema->id,$cinematheater->id])}}">MovieTheaters</a></li>
                    <li class="breadcrumb-item active">Timetables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h2 class="card-title">{{ $movie->name }}<span class="badge badge-pill badge-primary">{{ $cinematheater->name }}</span></h2>
                            <a href="" class="float-right">
                                <button class='btn btn-primary'><i class="fas fa-plus"></i> Add New Timetables</button>
                            </a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="timetables">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">ID</th>
                                        <th>Show Date</th>
                                        <th>Show Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($timetables as $timetable)
                                       <tr>
                                            <td>{{ $timetable->id }}</td>
                                            <td>{{ $timetable->show_date }}</td>
                                            <td>{{ $timetable->show_time }}</td>
                                            <td>
                                                <a href="" title="Edit" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                @method('DELETE')                         
                                                <a href="" title="Delete" class="btn btn-danger"> 
                                                    <i class="fas fa-trash"></i>
                                                </a>
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
    </section>
</div> 
@endsection