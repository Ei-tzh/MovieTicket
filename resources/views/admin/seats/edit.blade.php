@extends('layouts.master')
@section('style')
    <style>
    i{
        font-size:12px;
    }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h2>Edit for seat.no ({{ $seat->seat_no }}) </h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}">Cinemas</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cinemas.show',$seat->theater->cinema->id)}}">{{ $seat->theater->name }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('seats.index',["cinema_id"=>$seat->theater->cinema->id,'theater_id'=>$seat->theater_id])}}">Seats</a></li>
                        <li class="breadcrumb-item active">{{ $seat->id }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $seat->theater->name}}</h3>
                                <p>{{' - ' .$seat->theater->cinema->name }}</p>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('seats.update',['cinema_id'=>$seat->theater->cinema->id,'theater_id'=>$seat->theater->id,'seat'=>$seat->id])}}" method="POST" >
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="row seats">
                                                    <div class="col-6">
                                                        <label for="seats">Seat.No:</label><i class="text-secondary"> *A1</i>
                                                        <input type="text" class="form-control" id="seats" name="seat_no" placeholder="*(Eg-A3)" value="{{ $seat->seat_no }}" >
                                                        @error('seat_no')
                                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="prices">Price:</label><i class="text-secondary">*1000</i>
                                                        <input type="text" class="form-control" id="prices" name="price" placeholder="*(Eg-5000)" value="{{ $seat->price }}">
                                                        @error('price')
                                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                                        @enderror    
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('seats.index',['cinema_id'=>$seat->theater->cinema->id,'theater_id'=>$seat->theater->id])}}"><button type="button" class="btn btn-danger">Back</button></a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection
@push('vue')
<script>

window.onload = function () {
    var app2= new Vue({
        el: '#create-seats',
        data: {
            seats:[
                {
                    seat_no:'',
                    price:''
                }
            ]
        },
        methods:{
            addseat:function(){
                this.seats.push({
                    seat_no:'',
                    price:''
                })
            },
            removeseat:function(index){
                this.seats.splice(index, 1)
            }
        }
    })
}
</script>
@endpush