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
                       <h1>{{ $cinema->name }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}">Cinemas</a></li>
                        <li class="breadcrumb-item active">Theaters</li>
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
                                <h3 class="card-title">Theaters Table</h3>
                                <div class="new-theater float-right">
                                    <a href="{{ route('theaters.create',$cinema->id)}}">
                                        <button type="button" class="btn btn-success"><i class="fas fa-plus"></i>Add New Theater</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered" id="theaters">
                                    <thead class="bg-success">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Location</th>
                                            <th>Image</th>
                                            <th>Movies</th>
                                            <th>Seats</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($theaters as $theater)
                                           <tr>
                                               <td>{{ ++$loop->index }}</td>
                                               <td>{{ $theater->name }}</td>
                                               <td>{{ $theater->location }}</td>
                                               <td><img src="{{ $theater->image }}" alt="Theater" style="width:100px;height:auto;"></td>
                                               <td>
                                                    <a href="{{ route('movietheaters.index',['id'=>$cinema->id,'theater'=>$theater->id])}}" title="View Movies">
                                                        <button type="button" class="btn btn-secondary">View Movies <span class="badge badge-light">{{ count($theater->movies)}}</span></button>
                                                    </a> 
                                               </td>
                                               <td>
                                                    <a href="{{ route('seats.index',['id'=>$cinema->id,'theater'=>$theater->id])}}" title="Edit">
                                                        <button type="button" class="btn btn-info">View Seats <span class="badge badge-light">{{ count($theater->seats)}}</span></button>
                                                    </a> 
                                                </td>
                                               <td>
                                                <a href="{{ route('theaters.edit',['id'=>$cinema->id,'theater'=>$theater->id])}}" title="Edit">
                                                    <i class="fas fa-edit blue"></i>
                                                </a> /
                                                @method('DELETE')
                                                <a href="{{ route('theaters.destroy',['id'=>$cinema->id,'theater'=>$theater->id])}}" title="Delete">
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
            $('#theaters').DataTable({
                "lengthMenu":[ 5,10, 25, 50, 75, 100 ]
            });
        });
</script>
@endpush