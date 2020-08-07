@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Movies</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <a href="{{ route('movies.create') }}" class="float-right">
                    <button class='btn btn-success'><i class="fas fa-plus"></i> Add New Movie</button>
            </a>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-lg-12">
              <table class='table table-striped'>
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>MovieName</th>
                    <th>Poster</th>
                    <th>Duration</th>
                    <th>StartDate/EndDate</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($movies as $movie)
                    <tr>
                        <td>{{ $movie->id }}</td>
                        <td>{{ $movie->name }}</td>
                        <td><img src="{{ $movie->poster }}" alt="poster" style="width:100px;height:auto;"></td>
                        <td>{{ $movie->duration}}</td>
                        <td>{{ $movie->start_date.'/'.$movie->end_date}}</td>
                        <td>{{ $movie->type }}</td>
                        <td><a href="{{ route('movies.show',$movie->id) }}" title="view">
                              <i class="fas fa-eye green"></i>
                            </a> /
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
          <!-- ./col -->
         
          
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection