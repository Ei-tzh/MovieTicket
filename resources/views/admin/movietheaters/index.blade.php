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
        {{-- alert block --}}
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
                        <li class="breadcrumb-item"><a href="{{ route('theaters.index',['id'=>$cinema->id,'theater'=>$cinematheater->id])}}">Theaters</a></li>
                        <li class="breadcrumb-item active">{{ $cinema->id }}</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-secondary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">{{ $cinematheater->name }}</h3>
                                <div class="new-theater float-right">
                                    <a href="{{ route('movietheaters.create',[$cinema->id,$cinematheater->id])}}">
                                        <button type="button" class="btn btn-info"><i class="fas fa-plus"></i>Add New Movie</button>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered" id="movietheaters">
                                    <thead class="bg-secondary">
                                        <tr>
                                            <th style="width: 10px">ID</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Schedules</th>
                                            <th style="width: 20px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($cinematheater->movies as $movietheater)
                                           <tr>
                                               <td>{{ ++$loop->index }}</td>
                                               <td>{{ $movietheater->name }}</td>
                                               <td><span class="badge {{ $movietheater->pivot->status==1?'badge-success':'badge-danger'}}">{{ $movietheater->pivot->status }}</span></td>
                                                   {{-- @foreach ($startdates as $startdate)
                                                       @if ($movietheater->pivot->id == $startdate->pivot->movietheater_id)
                                                            <td>{{ $startdate->show_date }}</td>
                                                       @endif
                                                   @endforeach
                                                    @foreach ($enddates as $enddate)
                                                        @if ($movietheater->pivot->id == $enddate->pivot->movietheater_id)
                                                            <td>{{ $enddate->show_date }}</td>
                                                        @endif
                                                    @endforeach --}}
                                               
                                               <td>
                                                    <a href="" title="View">
                                                        View Schedules
                                                    </a> 
                                               </td>
                                               <td>
                                                <a href="{{ route('movietheaters.edit',['id'=>$cinema->id,'theater'=>$cinematheater->id,'movietheater'=>$movietheater->pivot->id])}}" title="Edit">
                                                    <i class="fas fa-edit blue"></i>
                                                </a> /
                                                @method('DELETE')
                                                <a href="{{ route('movietheaters.destroy',['id'=>$cinema->id,'theater'=>$cinematheater->id,'movietheater'=>$movietheater->id])}}" title="Delete">
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
            $('#movietheaters').DataTable({
                "lengthMenu":[ 5,10, 25, 50, 75, 100 ]
            });
        });
</script>
@endpush