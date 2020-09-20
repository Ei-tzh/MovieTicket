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
                        <div class="card-header">{{ __('Edit Register for '.$user->name) }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('users.update',$user->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}"  autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email }}"  autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ph_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone.no') }}</label>

                                        <div class="col-md-6">
                                            <input id="ph_no" type="text" class="form-control @error('ph_no') is-invalid @enderror" name="ph_no" value="{{ $user->ph_no }}"  autocomplete="ph_no">

                                            @error('ph_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input" id="admin" name="role" value="admin" {{ $user->role =='admin'?'checked':''}}>
                                                <label class="form-check-label" for="admin">admin</label>
                                            </div>
                                             <div class="form-check">
                                                <input type="radio" class="form-check-input" id="admin" name="role" value="user" {{ $user->role =='user'?'checked':''}}>
                                                <label class="form-check-label" for="admin">user</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Update') }}
                                            </button>
                                            <a href="{{ route('users.index') }}">
                                                <button type="button" class="btn btn-danger">Back</button>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
