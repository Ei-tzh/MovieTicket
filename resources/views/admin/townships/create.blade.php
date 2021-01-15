@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Add New Township</h3>
                        </div>
                        <form action="{{ route('townships.store') }}" method="POST" >
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Township:</label>
                                    <input type="text" class="form-control" id="name" name='name' placeholder="Enter Township's name" value="{{ old('name') }}">
                                    @error('name')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('townships.index')}}"><button type="button" class="btn btn-danger">Back</button></a>
                            </div>
                        </form>
                    <div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection