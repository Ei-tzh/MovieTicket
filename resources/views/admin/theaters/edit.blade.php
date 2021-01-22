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
                        <li class="breadcrumb-item active">edit</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $cinema->name }}</h3>
                        </div>
                        <form action="{{ route('theaters.update',['id'=>$cinema->id,'theater'=>$theater->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Theater's Name:</label>
                                    <input type="text" class="form-control" id="name" name='name' placeholder="Enter theater's name" value="{{ $theater->name }}">
                                    @error('name')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="location">Location:</label>
                                    <input type="text" class="form-control" id="location" name='location' placeholder="Enter location" value="{{ $theater->location }}">
                                    @error('location')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- image -->
                                <div class="form-group">
                                    <label for="image">Image:</label>
                                    <div class="input-group">
                                        <img src="{{ $theater->image}} " alt="" style="width:100px;height:auto;">
                                        <input type="file" id="image" name="image" class='image_upload' value='{{ old('image')}}'>
                                    </div>
                                    @error('image')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <a href="{{ route('theaters.index',$cinema->id)}}"><button type="button" class="btn btn-danger">Back</button></a>
                            </div>
                        </form>
                    <div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection


        