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
                    <h3 class="card-title">Update Cinema</h3>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <!-- cinema -->
                        <div class="form-group">
                            <label for="name">Cinema:</label>
                            <input type="text" class="form-control" id="name" name='name' placeholder="Enter cinema's name" value="{{ $cinema->name }}">
                            @error('name')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class='form-control' cols="10" rows="5">{{ $cinema->address }}</textarea>
                            @error('address')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- ph.no -->
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ph_no">Ph.no:</label>
                                        <?php $vals=explode(',',$cinema->ph_no); ?>
                                        @foreach($vals as $value)
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="tel" class="form-control mt-2" id="ph_no" name="ph_no[]" placeholder="09(Enter your default number)" value='{{ $value }}' >
                                                @if ($loop->last)
                                                    <div id="new_task">
                                                        <button type="button" class='btn btn-success ml-1'>+</button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                        
                                        
                                    <!-- /.input group -->
                                   @foreach ($errors->get('ph_no.*') as $message)
                                        @foreach($message as $value)
                                            <small id="bodyhelp" class="form-text text-danger">{{$value}}</small>
                                        @endforeach
                                       
                                    @endforeach
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
</div>
@endsection
                        