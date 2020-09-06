@extends('layouts.master')

@section('content')
<div class="content-wrapper">
   <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $theater->name }}</h3>
                </div>
                <form action="{{ route('theaters.store',['cinema_id'=>$cinema->id,'theater_id'=>$theater->id ]) }}" method="POST" >
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-4">
                                <label for="movies">Movies:</label>
                                <select class="form-control" id='movies' name='movies[]' style="width: 100%;" multiple="multiple">
                                    @foreach($movies as $key=>$movie)
                                        <option value="{{ $movie->id }}" @foreach($theater->movies as $theater_movie)
                                                                {{ $theater_movie->name == $movie->name? 'disabled':'' }}
                                                                 @endforeach>{{ $movie->name }}</option>
                                    
                                    @endforeach
                                </select>
                                @error('movies')
                                    <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            {{-- status --}}
                                <label for="status">Status:</label>
                                <input type="checkbox" name="status" id="status" data-bootstrap-switch data-off-color="danger" data-on-color="success" data-on-text="Active" data-off-text="Inactive">
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
                                            <input type="text" class="form-control float-right" name='start_date' id="start_date" value='{{ old("start_date") }}' placeholder="Choose start date">
                                            
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
                                        <input type="text" class="form-control float-right" name="end_date" id="end_date" value="{{ old('end_date') }}" placeholder="Choose end date">
                                        
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
                    <button type="submit" class="btn btn-primary">Save</button>
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
            
           $("#status").bootstrapSwitch('state',true);
           
            $('#start_date').datepicker({ dateFormat: 'yy-mm-dd' });
            $('#end_date').datepicker({ dateFormat: 'yy-mm-dd' });
        });
        
    </script>   
@endpush

        