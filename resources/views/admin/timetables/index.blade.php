@extends('layouts.master')
@section('style')
<style>
.action {
    float:right;
    margin-right:10px;
}
.button{
    border-radius:3px;
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
                        <a href="{{ route('timetables.create') }}" class="float-left">
                            <button class='btn btn-success'><i class="fas fa-plus"></i> Add New Timetable</button>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Timetables</li>
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
                            <h3 class="card-title">Timetables Table</h3>
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
                        <table class="table ">
                            <thead class="bg-success text-white">  
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Dates & Times</th>
                                    <th>Cinemas & Theaters<th>
                                    <th>Movies</th>
                                    <th>Modify<th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($timetables as $timetable)
                                    <tr>
                                    
                                        <td>{{ $timetable->id }}</td>
                                        <td>{{ $timetable->show_date }}<span class="border rounded p-1 ml-3 border-success">{{ ' '.$timetable->show_time}}</span></td>
                                        
                                        {{-- getting cinemas and theater --}}
                                        <td>
                                            <table class="table">
                                                    @foreach($timetable->movie_theaters as $movie_theater)
                                                        @foreach($theaters as $theater)
                                                            @if($movie_theater->theater_id == $theater->id)
                                                                <tr class="table-success">
                                                                    <td>{{ $theater->cinema->name }}<br>{{ $theater->name }}</td>
                                                                    {{-- <td>{{ $movie_theater->id }}</td> --}}
                                                                </tr>
                                                            @endif 
                                                        @endforeach
                                                    @endforeach 
                                            </table>
                                        </td>
                                        {{-- ??? --}}
                                        <td></td>
                                        {{-- getting movie name --}}
                                        <td>
                                            <table class="table ">
                                                @foreach($timetable->movie_theaters as $movie_theater)
                                                    @foreach($movies as $movie)
                                                        @if($movie_theater->movie_id == $movie->id)
                                                            <tr class="table-success">
                                                                <td class="p-4">{{ $movie->name }}</td>
                                                                <td class="p-4 action">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a href="{{ route('timetables.remove',['id'=>$timetable->id,'movietheater_id'=>$movie_theater->id ]) }}" title="Delete">
                                                                        <i class="fas fa-trash red"></i>
                                                                    </a>
                                                                    
                                                                </td>
                                                            </tr>
                                                        @endif 
                                                    @endforeach
                                                @endforeach 
                                            </table>
                                        </td>
                                        <td>
                                            <a href="{{ route('timetables.add',$timetable->id)}}" title="Add Movies">
                                                <i class="fas fa-plus green"></i>
                                            </a> /
                                            <a href="{{ route('timetables.edit',$timetable->id )}}" title="Edit">
                                                <i class="fas fa-edit blue"></i>
                                            </a> /
                                            {{-- can't delete --}}
                                            @method('DELETE')                         
                                            <a href="{{ route('timetables.destroy',$timetable->id)}}" title="Delete"> {{-- class="btn btn-default" data-toggle="modal" data-target="#delete_timetable"  data-target-id="{{ $timetable->id }}"> --}}
                                                <i class="fas fa-trash red"></i>
                                            </a>
                                        </td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="modal fade" id="delete_timetable">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete Timetable</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="note">
                                        </div>
                                        <form action="{{ route('timetables.delete')}}" method="post">
                                            @method('DELETE')
                                            {{ csrf_field() }}
                                            <input type="hidden" name="id" id="pass_id">
                                            
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        
                                    </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                                <!-- /.modal-dialog -->
                        </div> --}}
                            <!-- /.modal -->
                    </div>
              <!-- /.card-body -->
            </div>
        </section>
    </div>
@endsection
@push('jquery')
<script>
    $(document).ready(function(){
        $('#delete_timetable').on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('target-id');
            $('#pass_id').val(id);

            var modal = $(this)
            modal.find('.modal-body #note').html('Are you sure you want to delete id:' +id+' from this table?<br>It also deletes all movies that you created at this date and time!<br>')
            });
    })
</script>
@endpush