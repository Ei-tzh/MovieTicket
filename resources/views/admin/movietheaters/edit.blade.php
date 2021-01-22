@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}">Cinemas</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('theaters.index',$cinema->id)}}">Theaters</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('movietheaters.index',[$cinema->id,$cinematheater->id])}}">Movies</a></li>
                        <li class="breadcrumb-item active">{{ $movie_theater->id }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Edit A Movie at {{ $cinema->name }}</h3>
                        </div>
                        <form action="{{ route('movietheaters.update',[$cinema->id,$cinematheater->id,$movie_theater->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">Theater's Name:</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="name" name='name' placeholder="Enter theater's name" value="{{ $cinematheater->name }} " disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="movie" class="col-md-4 col-form-label text-md-right">Movies:</label>
                                    <div class="col-md-6">
                                        <select class="form-control @error('movie') is-invalid @enderror" id="movie" name="movie">
                                            <option disabled>Choose...<option>
                                            @foreach ($movies as $movie)
                                                <option value="{{ $movie->id }}" {{ $selected_movie->id == $movie->id ?'selected':''}}>{{ $movie->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('movie')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status" class="col-md-4 col-form-label text-md-right">Status:</label>
                                    <div class="col-md-6">
                                        <input type="checkbox" name="status" id="status" {{ $movie_theater->status == 1 ? 'checked':''}} data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-off-text="Inactive">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Edit Movie</button>
                                <a href="{{ route('movietheaters.index',[$cinema->id,$cinematheater->id])}}"><button type="button" class="btn btn-danger">Back</button></a>
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
        var theater=@JSON($cinematheater);
        //Movie_theaters
        $('#movie').select2({
                theme: 'bootstrap4',
                placeholder:"Select Movies you want to show at \'"+theater['name']+"\'",
                tags:true
            });
        $("#status").bootstrapSwitch('state');
    });
    </script>
@endpush