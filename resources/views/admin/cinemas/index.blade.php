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
                        <a href='{{ route('cinemas.create')}}' class="float-left">
                            <button class='btn btn-primary'><i class="fas fa-plus"></i> Add New Cinema</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Admin</a></li>
                        <li class="breadcrumb-item active">Cinemas</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cinemas Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered" id="cinemas">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th style="width: 150px">Ph.no</th>
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
                                            <td><pre>{{ $cinema->ph_no }}</pre></td>
                                            <td>
                                                <a href="{{route('theaters.index',['id'=>$cinema->id] )}}" title="View Theaters">
                                                    <button type="button" class="btn btn-success">View Theaters<span class="badge badge-light">{{ count($cinema->theaters)}}</button>
                                                </a>
                                            </td>
                                            <td><img src="{{ $cinema->image }}" alt="image" style="width:80px;height:auto;"></td>
                                            <td>{{ $cinema->township->name }}</td>
                                            <td>
                                                <a href="{{route('cinemas.edit',$cinema->id)}}" title="Edit">
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
            $('#cinemas').DataTable({
                "lengthMenu":[ 5,10, 25, 50, 75, 100 ]
            });
        });
    </script>
@endpush
