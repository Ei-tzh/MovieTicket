@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ $cinema->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{route('cinemas.index')}}">Cinemas</a></li>
                            <li class="breadcrumb-item active">{{ $cinema->id }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <img src="{{ $cinema->image }}" alt="{{ $cinema->image }}" style='width:280px;height:250px'>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                                    <p class="text-muted">{{ $cinema-> address}}</p>
                                    <hr>
                                    <strong><i class="fas fa-city  mr-1"></i>Township</strong>
                                    <p class="text-muted">{{ $township->name }}</p>
                                    <hr>
                                    <strong><i class="fas fa-phone mr-1"></i>Ph.no</strong>
                                    <p class="text-muted">{{ $cinema->ph_no}}</p>
                                    <hr>
                                    
                                    
                                     
                                </div>  
                            </div>
                        </div>
                    </div>
                    @foreach($theaters as $theater)
                    <div class="row mt-3">
                        <div class="col-8 col-sm-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                <h3 class="card-title">{{ $theater->name }}<span style='font-size:16px'> ({{$theater->location}}) </span></h3>
                                <a href="{{ route('theaters.create',['cinema_id'=>$cinema->id,'theater_id'=>$theater->id ]) }}"><button type="button" class='btn btn-outline-light float-right'>Create</button></a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Movies</th>
                                                <th>Status</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($theater->movies as $movie)
                                            <tr>
                                                <td>{{ $movie->name }}</td>
                                                @foreach($movietheaters as $movietheater)
                                                    @foreach($movietheater as $value)
                                                       @if($theater->id == $value->theater_id)
                                                        <td class="text-success">{{ $value->status==1 ?'Active':'Inactive' }}</td>
                                                        <td>{{ $value->start_date }}</td>
                                                        <td>{{ $value->end_date }}</td>
                                                        @endif 
                                                    @endforeach
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
              <!-- /.card-body -->
                </div>
            </div>
        </section>
    </div>
@endsection