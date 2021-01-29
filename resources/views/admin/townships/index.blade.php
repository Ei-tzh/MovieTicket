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
                    <a href='{{ route('townships.create')}}' class="float-left">
                        <button class='btn btn-info'><i class="fas fa-plus"></i> Add New Township</button>
                    </a>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active">Townships</li>
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
                        <h3 class="card-title">Cinema-Townships</h3>
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
                    <table class="table table-bordered" id="townships">
                        <thead>                  
                            <tr class="bg-info text-white">
                                <th style="width: 10px">ID</th>
                                <th>Name</th>
                                <th style="width: 30px">Modify</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($townships as $township)
                               <tr>
                                   <td>{{ $township->id }}</td>
                                   <td>{{ $township->name  }}</td>
                                   <td>
                                    <a href="{{route('townships.edit',$township->id)}}" title="Edit">
                                        <i class="fas fa-edit blue"></i>
                                    </a> /
                                    @method('DELETE')
                                    <a href="{{route('townships.destroy',$township->id)}}" title="Delete">
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
            $('#townships').DataTable({
                "lengthMenu":[ 5,10, 25, 50, 75, 100 ]
            });
        });
    </script>

@endpush