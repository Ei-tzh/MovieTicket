@extends('layouts.master')

@section('content')
<div class="content-wrapper">
   <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $theater->name }}</h3>
                </div>
                <form action="{{ route('theaters.update',['cinema_id'=>$cinema->id,'theater_id'=>$theater->id,'id'=>$movie_theater->id])}}" method="POST" >
                @csrf
                @method('put')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="movie">Movies:</label>
                                <select class="form-control select2" id='movie' name='movie' style="width: 100%;" readonly>
                                    <option value="{{ $movie->id }}" selected >{{ $movie->name }}</option>
                                </select>
                            </div>
                            {{-- status --}}
                                <label for="status">Status:</label>
                                <input type="checkbox" name="status" id="status" {{ $movie_theater->status == 1 ? 'checked':''}} data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-off-text="Inactive">
                            <!-- Start_date -->
                            <div class="row mt-3" >
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Start Date:</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" name='start_date' id="start_date" value='{{ $movie_theater->start_date }}' >
                                            
                                        </div>
                                        @error('start_date')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    
                                    </div>
                                </div>
                            <!-- End startdate -->
                            <!-- EndDate -->
                            <div class="col-4">
                                <div class="form-group">
                                    <label>End Date:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="end_date" id="end_date" value="{{ $movie_theater->end_date }}" >
                                        
                                    </div>
                                    @error('end_date')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                
                                </div>
                            </div>
                            <!-- end enddate -->
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a href="{{ route('cinemas.show',$cinema->id) }}">
                        <button type="button" class="btn btn-primary">Back</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    

</div> 
@endsection
@push('jquery')
    <script>
        $(document).ready(function(){
            $('#movies').select2({
                placeholder:"Select Movies you want to create",
                tags:true
                
            });
            
           $("#status").bootstrapSwitch('state');
           
            $('#start_date').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#end_date').datepicker({ dateFormat: 'yy-mm-dd' });
        });
        
    </script>   
@endpush
