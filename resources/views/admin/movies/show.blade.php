@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Movie Details</h1>
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
                            
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap ">
                                    <thead>
                                        <tr class="bg-success">
                                            <th>Cinemas</th>
                                            <th>Theaters</th>
                                            <th>Timetables</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($theaters as $theater)
                                            <tr>
                                                <td>{{ $theater->cinema->name }}</td>
                                                <td>{{ $theater->name }}</td>
                                                @foreach($movie_theaters as $movie_theater)
                                                    @foreach($movie_theater as $val)
                                                        @if($val->id == $theater->pivot->id)
                                                        <td>
                                                            <table class="table table-bordered table-sm">
                                                                <tbody>
                                                                    @foreach($val->timetables as  $aa)
                                                                    <tr class= "table-info">
                                                                    <td >{{ $aa->show_date.' / '.$aa->show_time }}</td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                                            
                                                            </table>
                                                        </td>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                <td>
                                                    <a href="{{ route('movies.edit',$movie->id) }}" title="Edit">
                                                        <i class="fas fa-edit blue"></i>
                                                    </a> /
                                                    @method('DELETE')
                                                    <a href="{{ route('movies.destroy',$movie->id) }}" title="Delete">
                                                        <i class="fas fa-trash red"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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

