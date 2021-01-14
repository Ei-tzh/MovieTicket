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
                    <h3 class="card-title">Add New Movie</h3>
                </div>
                <form action="{{ route('movies.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <!-- Moviename -->
                        <div class="form-group">
                            <label for="name">Movie Name</label>
                            <input type="text" class="form-control" id="name" name='name' placeholder="Enter movie name" value="{{ old('name')}}">
                            @error('name')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Director -->
                        <div class="form-group">
                            <label for="director">Director</label>
                            <input type="text" class="form-control" id="director" name='director' placeholder="Enter director's name" value="{{ old('director')}}">
                            @error('director')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Duration -->
                        <div class="form-group">
                            <label>Duration</label>
                            <div class="row">
                                <div class="input-group">
                                        <div class="col-2">
                                            <label for="hr">Hour:</label>
                                            
                                            <input type="number" id="hr" class='form-control' name="hr" min="1" max="3" value="{{ old('hr') }}">
                                            @error('hr')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-2">
                                            <label for="min">Min:</label>
                                            <input type="number" id="min" class='form-control' name="min" min="0" max="59" value="{{ old('min') }}">
                                            @error('min')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                </div>
                            </div>
                        </div>
                        <!-- Poster -->
                        <div class="form-group">
                            <label for="poster">Poster</label>
                            <div class="input-group">
                                <input type="file" id="poster" name="poster" class='form-control form-control-lg'>
                            </div>
                            @error('poster')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class='form-control' placeholder="Enter description">{{ old('description') }}</textarea>
                            @error('description')
                                    <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- casts -->
                        <div class="form-group">
                            <label for="casts">Casts</label>
                            <textarea name="casts" id="casts" cols="30" rows="3" class='form-control' placeholder="Enter casts">{{ old('casts') }}</textarea>
                            @error('casts')
                                    <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for='Categories'>Categories:</label>
                            <select class="form-control" id='categories' name='categories[]' style="width: 100%;" multiple="multiple">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('categories')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- type -->
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name='type'>
                                <option value='2D'>2D</option>
                                <option value='3D'>3D</option>
                            </select>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
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