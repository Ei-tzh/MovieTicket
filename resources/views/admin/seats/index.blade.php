@extends('layouts.master')
@section('style')
    <style>
        .card-header{
            background-color: transparent;
        }
    </style>   
@endsection
@section('content')
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
                        <h2>{{ $cinematheater->cinema->name }}</h2>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Admin</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}">Cinemas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('theaters.index',$cinematheater->cinema->id)}}">Theaters</a></li>
                            <li class="breadcrumb-item active">Seats</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        {{-- Main Content --}}
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h3 class="card-title">{{ $cinematheater->name }}</h3>
                                <a href="{{ route('seats.create',[$cinematheater->cinema->id,$cinematheater->id])}}" class="float-right">
                                    <button class='btn btn-primary'><i class="fas fa-plus"></i> Add Seats</button>
                                </a>
                            </div>
                            
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="seats_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Seat.No</th>
                                            <th>Price(MMK)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($seats as $seat)
                                            <tr>
                                                <td>{{ ++$loop->index }}</td>
                                                <td>{{ $seat->seat_no }}</td>
                                                <td>{{ $seat->price }}</td>
                                                <td>
                                                    <a href="{{ route('seats.edit',[$cinematheater->cinema->id,$cinematheater->id,$seat->id])}}" title="Edit" class="btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    
                                                    @method('DELETE')                         
                                                    <a href="" title="Delete" class="btn btn-danger"> 
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
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
            $('#seats_table').DataTable();
        });
</script>
@endpush