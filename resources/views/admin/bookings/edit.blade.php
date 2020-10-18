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
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="date" id="date" value="{{ $booking->date}}">
                                                    
                                                </div>
                                                @error('date')
                                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                
                                                <div class="row">
                                                    <div class="input-group">
                                                        <div class="col-2">
                                                            <label for="hr">Hour:</label>
                                                            <?php $time=explode(':',$booking->time); ?>
                                                            <input type="number" id="hr" class='form-control' name="hr" min="1" max="24" value="{{ $time[0] }}">

                                                            @error('hr')
                                                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2">
                                                            <label for="min">Min:</label>
                                                            <input type="number" id="min" class='form-control' name="min" min="0" max="59" value="{{ $time[1] }}">

                                                            @error('min')
                                                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2">
                                                            <label for="sec">Min:</label>
                                                            <input type="number" id="sec" class='form-control' name="sec" min="0" max="59" value="{{ $time[2] }}">

                                                            @error('sec')
                                                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
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
         $('#date').datepicker({ dateFormat: 'yy-mm-dd' });
        $('#current_datetime').click(function(){
            if(this.checked){
                $("#date").attr("readonly", true);
                $("#hr").attr("readonly", true);
                $("#min").attr("readonly", true);
                $("#sec").attr("readonly", true);
            }else{
                $("#date").removeAttr("readonly");
                $("#hr").removeAttr("readonly");
                $("#min").removeAttr("readonly");
                $("#sec").removeAttr("readonly");
            }
            
        });
     });
    </script>
@endpush