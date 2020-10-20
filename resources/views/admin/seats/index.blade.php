@extends('layouts.master')

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
                        <h2>{{ $theater->name }}</h2>
                        <p>{{ $theater->cinema->name }}</p>
                        
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/home">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}">Cinemas</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cinemas.show',$theater->cinema->id)}}">{{ $theater->name }}</a></li>
                            <li class="breadcrumb-item active">Seats</li>
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
                                <h3 class="card-title">Seats</h3>
                                <a href="{{ route('seats.create',['cinema_id'=>$theater->cinema->id,'theater_id'=>$theater->id])}}" class="float-right">
                                    <button class='btn btn-outline-light'><i class="fas fa-plus"></i> Add Seats</button>
                                </a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="seat_table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Seat.No</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $num=1 @endphp
                                        @foreach($theater->seats as $seat)
                                            <tr>
                                                <td>{{ $num++ }}</td>
                                                <td>{{ $seat->seat_no }}</td>
                                                <td>{{ $seat->price }}</td>
                                                <td>
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
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Seat.No</th>
                                            <th>Price</th>
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
            $('#seat_table').DataTable();
        });
</script>
@endpush