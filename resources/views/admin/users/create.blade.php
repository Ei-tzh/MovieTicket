@extends('layouts.master')
@section('style')
    <style>
    
    </style>
@endsection
@section('content')
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content">
        <div class="container mt-2">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Admin</h3>
                        </div>
                        <!-- form start -->
                        <form action="{{ route('users.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="card-body">
                                <div class="text-center mb-3">
                                        <img class="profile-user-img img-fluid img-circle" src="{{ asset('/images/admin/admin.png') }}" alt="User profile picture">
                                </div>
                                {{-- name --}}
                                <div class="form-group row">
                                    <label for="name" class="col-4 float-right">Name:</label>
                                    <div class="input-group col-6">
                                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter your name" value="{{ old('name')}}">
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-6">
                                        @error('name')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- email --}}
                                <div class="form-group row">
                                    <label for="email" class="col-4 float-right">Email Address:</label>
                                    <div class="input-group col-6">
                                        <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" value="{{ old('email')}}">
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-6">
                                        @error('email')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                {{-- phone number --}}
                                {{-- <div class="form-group row">
                                    <label for="ph_no" class="col-4 float-right">Phone number:</label>
                                    <div class="input-group col-6">
                                        <input type="text" id="ph_no" name="ph_no" class="form-control @error('ph_no') is-invalid @enderror" placeholder="Enter your ph.no" value="{{ old('ph_no')}}">
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-6">
                                        @error('ph_no')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div> --}}

                                {{-- image --}}
                                <div class="form-group row">
                                    <label for="image" class="col-4 float-right">Image:</label>
                                        <div class="input-group col-6">
                                            <input type="file" id="image" name="image" class="form-control form-control-lg @error('image') is-invalid @enderror" value="{{ old('image')}}">
                                        </div>
                                        <div class="col-4">
                                        </div>
                                        <div class="col-6">
                                            @error('image')
                                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                </div>
                               
                                {{-- role --}}
                                <div class="form-group row">
                                    <label for="role" class="col-4 float-right">Role:</label>
                                    <div class="input-group col-6">
                                        <select class="form-control" id='role' name="role">
                                            
                                            <option value="admin">admin<option>
                                            <option value="user">user<option>
                                        </select>
                                    </div>
                                    
                                </div>

                                {{-- password --}}
                                <div class="form-group row">
                                    <label for="pwd1" class="col-4 float-right">Password:</label>
                                    <div class="input-group col-6">
                                        <input type="password" id="pwd1" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                                    </div>
                                        <div class="col-4">
                                        </div>
                                        <div class="col-6">
                                            @error('password')
                                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    
                                </div>

                                {{-- confirm password --}}
                                <div class="form-group row">
                                    <label for="pwd2" class="col-4 float-right">Confirm Password:</label>
                                    <div class="input-group col-6">
                                        <input type="password" id="pwd2" name="password_confirmation" class='form-control' placeholder="Enter your password again">
                                    </div>
                                    <div class="col-4">
                                    </div>
                                    <div class="col-6">
                                        @error('password_confirmation')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('users.index')}}">
                                    <button type="button" class="btn btn-danger">Back</button>
                                </a>
                            </div>
                        </form>
                         <!-- form end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('jquery')
 <script>
    $(document).ready(function(){
        $('#role').select2()
    });
    </script>
@endpush