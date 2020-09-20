@extends('layouts.master')
@section('style')
<style>
    .card-body .btn{
        width:35px;
        height:35px;
    }
   .card-body .btn i{
       font-size:13px;
       margin:auto;
   }
</style>
@endsection
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
                        <a href="{{ route('users.create') }}" class="float-left">
                            <button class='btn btn-primary'><i class="fas fa-user"></i> Add Admin</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">User Table</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="user_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone number</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($users as $user)
                                           <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td class="text-primary text-bold">{{ $user->email }}</td>
                                                <td>{{ $user->ph_no }}</td>
                                                <td class="{{ $user->role =='admin'?'text-danger':''}}">{{ $user->role }}</td>
                                                <td>
                                                   
                                                    <a href="{{ route('users.edit',$user->id)}}" title="Edit" class="btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- can't delete --}}
                                                    @method('DELETE')                         
                                                    <a href="{{ route('users.destroy',$user->id)}}" title="Delete" class="btn btn-danger"> 
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                           </tr>
                                       @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone number</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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
            $('#user_table').DataTable();
        });
</script>
@endpush