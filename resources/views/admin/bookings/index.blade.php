@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @if ($message = Session::get('status'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            <br>
        @endif
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href='{{ route('bookings.create')}}' class="float-left">
                            <button class='btn btn-info'><i class="fas fa-plus"></i> Add New Booking</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Bookings</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Bookings table</h3>
                        </div>
                    
                    <div class="card-body">
                        <table class="table table-striped table-bordered" id="bookings">
                            <thead>                  
                                <tr>
                                   <th>ID</th>
                                   <th>Booking.No</th>
                                   <th class="text-primary">User</th>
                                   <th>Date && Time</th>
                                   <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach($bookings as $booking)
                                   <tr>
                                        <td>{{ $booking->id }}</td>
                                        <td>{{ $booking->booking_no }}</td>
                                        <td class="text-primary text-bold">{{ $booking->user->name }}</td>
                                        <td>{{ $booking->date.'/ '.$booking->time }}</td>
                                        <td>
                                        <a href="{{ route('bookings.show',$booking->id)}}" title="view">
                                            <i class="fas fa-file-alt green" style="font-size:16px;"></i>
                                        </a> /
                                        <a href="{{ route('bookings.edit',$booking->id)}}" title="Edit">
                                            <i class="fas fa-edit blue"></i>
                                        </a> /
                                        @method('DELETE')
                                        <a href="" title="Delete">
                                            <i class="fas fa-trash red"></i>
                                        </a>
                                    </td>
                                   </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
              <!-- /.card-body -->
              
            </div>
        </section>
    </div>
@endsection
@push('jquery')
    <script>
         $(document).ready(function(){
            $('#bookings').DataTable({
                "lengthMenu":[ 5,10, 25, 50, 75, 100 ]
            });
        });
    </script>  
@endpush