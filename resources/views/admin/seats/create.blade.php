@extends('layouts.master')
@section('style')
    <style>
    .seats{
        position:relative;
    }
    .new-button{
        position:absolute;
        top:30px;
        right:0px;
    }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="">Admin</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cinemas.index')}}">Cinemas</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('seats.index',[$cinematheater->cinema->id,$cinematheater->id])}}">Seats</a></li>
                        <li class="breadcrumb-item active">Create Seats</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">{{ $cinematheater->name }}</h3>
                                <p>{{' - ' .$cinematheater->cinema->name }}</p>
                            </div>
                            <!-- /.card-header -->
                            <form action="{{ route('seats.store',[$cinematheater->cinema->id,$cinematheater->id])}}" method="POST" >
                            @csrf
                            <div class="card-body">
                                <div class="row" id="create-seats">
                                    <div class="col-6">
                                        <div class="form-group" v-for="(i,k) in seats" :key="k">
                                            <div class="row seats">
                                                    <div class="col-6">
                                                        <label for="seats">Seat.No:</label>
                                                        <input type="text" class="form-control" id="seats" name="seats[]" v-model="i.seat_no" placeholder="*(Eg-A3)" autofocus>
                                                        @foreach ($errors->get('seats.*') as $message)
                                                            @foreach($message as $value)
                                                                <small id="bodyhelp" class="form-text text-danger">{{$value}}</small>
                                                            @endforeach
                                                        @endforeach 
                                                    </div>
                                                    <div class="col-5">
                                                        <label for="prices">Price:</label>
                                                        <input type="text" class="form-control" id="prices" name="prices[]" v-model="i.price" placeholder="*(Eg-5000)">
                                                        @foreach ($errors->get('prices.*') as $message)
                                                            @foreach($message as $value)
                                                                <small id="bodyhelp" class="form-text text-danger">{{$value}}</small>
                                                            @endforeach
                                                        @endforeach 
                                                    </div>
                                                    <div class="col-1 new-button">
                                                        <button type="button" class='btn btn-danger' v-on:click="removeseat(k)"  v-show="k!=0">x</button>
                                                        <button type="button" class='btn btn-success' v-on:click="addseat" v-show="k==0">+</button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{ route('seats.index',[$cinematheater->cinema->id,$cinematheater->id])}}"><button type="button" class="btn btn-danger">Back</button></a>
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