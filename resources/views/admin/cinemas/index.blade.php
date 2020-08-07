@extends('layouts.master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href='{{ route('cinemas.create')}}' class="float-left">
                            <button class='btn btn-success'><i class="fas fa-plus"></i> Add New Cinema</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Cinemas</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cinemas Table</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>                  
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Ph.no</th>
                                    <th>Theaters</th>
                                    <th>Image</th>
                                    <th>Township</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cinemas as $cinema)
                                <tr>
                                    <td>{{ $cinema->id }}</td>
                                    <td>{{ $cinema->name}}</td>
                                    <td>{{ $cinema->address}}</td>
                                    <td>{{ $cinema->ph_no }}</td>
                                    <td>{{ count($cinema->theaters) }}</td>
                                    <td>{{ $cinema->image}}</td>
                                    <td>{{ $cinema->township->name }}</td>
                                    <td>
                                        <a href="" title="view">
                                            <i class="fas fa-eye green"></i>
                                        </a> /
                                        <a href="" title="Edit">
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