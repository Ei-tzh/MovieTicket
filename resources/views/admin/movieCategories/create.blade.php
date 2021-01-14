@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <form action="{{ route('movieCategories.store') }}" method="POST" >
                        @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control" id="name" name='name' placeholder="Eg-Drama,Horror,Romance" value="{{ old('name') }}">
                                    @error('name')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <a href="{{ route('movieCategories.index')}}"><button type="button" class="btn btn-danger">Back</button></a>
                            </div>
                        </form>
                    <div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection