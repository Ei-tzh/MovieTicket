@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    
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
                    <a href='{{ route('movieCategories.create')}}' class="float-left">
                        <button class='btn btn-success'><i class="fas fa-plus"></i> Add New Category</button>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">MovieCategories</li>
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
                        <h3 class="card-title">Movie Categories</h3>
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
                            <tr class="bg-success text-white">
                                <th style="width: 10px">ID</th>
                                <th>Name</th>
                                <th style="width: 20px">Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name}}</td>
                                <td>
                                    <a href="{{route('movieCategories.edit',$category->id)}}" title="Edit">
                                        <i class="fas fa-edit blue"></i>
                                    </a> /
                                    @method('DELETE')
                                    <a href="{{route('movieCategories.destroy',$category->id)}}" title="Delete">
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