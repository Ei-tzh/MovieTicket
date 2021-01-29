@extends('layouts.master')
@section('style')
    <style>
       span>i{
            font-size:12px;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                       
                        <div class="card card-info" id="edit">
                            <div class="card-header">
                                <h3 class="card-title">Edit Booking</h3>
                            </div>
                            <form action="{{ route('bookings.update',$booking->id)}}" method="post">
                            @csrf
                            @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="booking_no">Booking.No:</label>
                                        <input id="booking_no" type="text" class="form-control " name="booking_no" value="{{ $booking->booking_no }}" disabled>

                                        <span class='text-muted pl-2' role="alert">
                                            <i>You can't change this booking.no!</i>
                                        </span>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="user">User:</label>
                                        <select class="form-control col-md-6 select2" id='user' name='user' style="width: 100%;" >
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" 
                                                {{ $user->id == $booking->user_id?'selected':''}}>
                                                {{ $user->name }}
                                                </option>
                                            @endforeach
                                        <select>
                                        @error('user')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Date:</label>
                                                <div class="input-group date" id="datepicker" data-target-input="nearest">
                                                    <div class="input-group-prepend" data-target="#datepicker" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                    <input type="text" class="form-control datetimepicker-input" name="date" data-target="#datepicker" data-toggle="datetimepicker" value="{{ $booking->date }}"/>
                                                </div>
                                                @error('date')
                                                    <small id="bodyhelp" class="form-text text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>Show Time:</label>
                                                <div class="input-group date" id="timepicker" data-target-input="nearest">
                                                    <div class="input-group-prepend" data-target="#timepicker" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                    </div>
                                                    <input type="text" class="form-control datetimepicker-input" name="time" data-target="#timepicker" data-toggle="datetimepicker" value="{{ $booking->time }}"/>
                                                </div>
                                                @error('time')
                                                    <small id="bodyhelp" class="form-text text-danger">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="checkbox">
                                            <div class="form-check">
                                                <input class="form-check-input" id="current_datetime" type="checkbox"  name="current_datetime">
                                                <label class="form-check-label" for="current_datetime" ><u>Current Date and Time</u></label>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('bookings.index') }}"><button type="button" class="btn btn-danger">Cancel</button></a>
                                </div>
                            </form>
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
         
         $('#user').select2({
             theme: 'bootstrap4',
             placeholder:"Please Select Movies You Want To Book",
             tags:true
         });
         $('#datepicker').datetimepicker({
                    format: 'YYYY-MM-DD'
                });
        $('#timepicker').datetimepicker({format: 'HH:mm:ss'});
        $('#current_datetime').click(function(){
            if(this.checked){
                $("#datepicker input").attr("readonly", true);
                $("#timepicker input").attr("readonly", true);
            }else{
                $("#datepicker input").removeAttr("readonly");
                $("#timepicker input").removeAttr("readonly");
            }
        });
     });
    </script>
@endpush