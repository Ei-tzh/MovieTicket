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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Users</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                        
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Password</th>
                                        <th>Role<th>
                                        <th>Modify</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->password }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td></td>
                                                <td>
                                                    <a href="" title="view" class="btn btn-success">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="" title="Edit" class="btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- can't delete --}}
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