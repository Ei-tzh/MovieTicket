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
                    <h3 class="card-title">Edit Movie</h3>
                </div>
                <form action="{{ route('movies.update',$movie->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                    <div class="card-body">
                        <!-- Moviename -->
                        <div class="form-group">
                            <label for="name">Movie Name</label>
                            <input type="text" class="form-control" id="name" name='name' placeholder="Enter movie name" value="{{ $movie->name }}">
                            @error('name')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Director -->
                        <div class="form-group">
                            <label for="directorname">Director</label>
                            <input type="text" class="form-control" id="directorname" name='director' placeholder="Enter director's name" value="{{ $movie->director }}">
                            @error('director')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Start_date -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Start Date:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name='start_date' id="start_date" value={{ $movie->start_date }}>
                                        
                                    </div>
                                    @error('start_date')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                
                                </div>
                            </div>
                            <!-- End startdate -->
                            <!-- EndDate -->
                            <div class="col-6">
                                <div class="form-group">
                                    <label>End Date:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="end_date" id="end_date" value="{{ $movie->end_date }}">
                                        
                                    </div>
                                    @error('end_date')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                
                                </div>
                            </div>
                            <!-- end enddate -->
                        </div>
                        
                        <!-- Duration -->
                        <div class="form-group">
                            <label>Duration</label>
                            <div class="row">
                                <div class="input-group">
                                        <div class="col-2">
                                            <label for="hr">Hour:</label>
                                            <?php $time=explode(':',$movie->duration); ?>
                                            <input type="number" id="hr" class='form-control' name="hr" min="1" max="3" value="{{ $time[0] }}">
                                            @error('hr')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <label for="min">Min:</label>
                                            <input type="number" id="min" class='form-control' name="min" min="0" max="59" value="{{ $time[1] }}">
                                            @error('min')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- Poster -->
                        <div class="form-group mt-4">
                            <label for="poster">Poster</label>
                            <div class="input-group">
                                <img src="{{ $movie->poster}} " alt="" style="width:100px;height:auto;">
                                <input type="file" id="poster" name="poster" value="{{ $movie->poster }}" class='image_upload' >
                               
                                
                            </div>
                            @error('poster')
                                    <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    
                        <!-- description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class='form-control' placeholder="Enter description">{{ $movie->description }}</textarea>
                            @error('description')
                                    <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- type -->
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name='type'>
                                    <option value='2D' >2D</option>
                                    <option value='3D' {{ $movie->type=="3D"? 'selected':''}} >3D</option>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('cinemas.index') }}"><button type="submit" class="btn btn-success">Cancel</button></a>
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
        //Date range picker
        $('#start_date').datepicker({ dateFormat: 'yy-mm-dd' });
        $('#end_date').datepicker({ dateFormat: 'yy-mm-dd' });
        $('#spinner1').spinner({
            min: 0,
            step: 100000,
            });
        $( "#spinner2" ).spinner({
            min: 0,
            step: 100000,
            });
    </script>
@endpush