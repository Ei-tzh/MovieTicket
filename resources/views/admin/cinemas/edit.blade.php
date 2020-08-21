@extends('layouts.master')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Update Cinema</h3>
                        </div>
                        <form action="{{ route('cinemas.update',$cinema->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                            <div class="card-body" id="app-2">
                                <!-- cinema -->
                                <div class="form-group">
                                    <label for="name">Cinema:</label>
                                    <input type="text" class="form-control" id="name" name='name' placeholder="Enter cinema's name" value="{{ $cinema->name }}">
                                    @error('name')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea name="address" id="address" class='form-control' cols="10" rows="5">{{ $cinema->address }}</textarea>
                                    @error('address')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- ph.no -->
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group" >
                                            <label for="ph_no">Ph.no:</label>
                                                <phone-number   v-for="(phone,index) in phoneno"
                                                                v-bind:test="phone"
                                                                v-bind:k="index"
                                                                v-on:remove="remove_phoneno"></phone-number>
                                                <button type="button" class='btn btn-success  mt-2' v-on:click="addnew_phoneno" >Add New</button> 
                                            <!-- /.input group -->
                                            @foreach ($errors->get('ph_no.*') as $message)
                                                @foreach($message as $value)
                                                    <small id="bodyhelp" class="form-text text-danger">{{$value}}</small>
                                                @endforeach
                                            
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!-- theater -->
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="theaters">Theaters:</label>
                                                    <theater-item   v-for="(theater,index) in theaters"
                                                                    v-bind:item="theater"
                                                                    v-bind:k="index"
                                                                    v-on:remove='removetheater'></theater-item>
                                                            
                                                    <button type="button" class='btn btn-success  mt-2' id='create_theater' v-on:click='addtheater'>Add New Theater</button>
                                                @foreach ($errors->get('theaters.*') as $message)
                                                    @foreach($message as $value)
                                                        <small id="bodyhelp" class="form-text text-danger">{{$value}}</small>
                                                    @endforeach
                                                
                                                @endforeach    
                                           
                                        </div>
                                    </div>
                                    
                                </div>
                               <!-- image -->
                                <div class="form-group mt-4">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <img src="{{ $cinema->image}} " alt="" style="width:100px;height:auto;">
                                        <input type="file" id="image" name="image" value="{{ $cinema->image }}" class="image_upload">
                                    @error('image')
                                            <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mt-4">
                                    <label for="township">Township</label>
                                    <select class="form-control" id="township" name='township'>
                                        @foreach($townships as $township)
                                            <option value='{{ $township->id }}' {{ $cinema->township==$township? 'selected':''}} >{{ $township->name }}</option>
                                        @endforeach
                                    </select>
                                
                                    @error('township')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>
                            <!-- footer -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('cinemas.index')}}"><button type="button" class="btn btn-success">Back</button></a>
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
Vue.component('theater-item',{
    props:['item','k','remove'],
    template:' <div class="input-group" v-bind:id="k"><input type="text" class="form-control mt-2" id="theaters" name="theaters[]" v-model="item.name" ><div class="input-group-append mt-2"><button type="button" @click="$emit(\'remove\',k)" class="btn btn-danger" >X</button></div></div>'
    
}),
Vue.component('phone-number',{
    props:['test','k','remove'],
    template:' <div class="input-group" v-bind:id="k"><div class="input-group-prepend mt-2"><span class="input-group-text"><i class="fas fa-phone"></i></span></div><input type="tel" class="form-control mt-2" id="ph_no" name="ph_no[]"  placeholder="Enter phone number" v-bind:value="test"><button type="button" class="btn btn-danger ml-2 mt-2" v-on:click="$emit(\'remove\',k)" >X</button></div>'
     
})
    var app2= new Vue({
        el: '#app-2',
        data: {
            theaters:@json($theaters),
            phoneno:@json($phoneno)
        },
        methods:{
            addtheater:function(){
                this.theaters.push({
                    name:''
                })
            },
            removetheater:function(index){
                this.theaters.splice(index,1)
            },
            remove_phoneno:function(index){
               this.phoneno.splice(index,1)
            },
            addnew_phoneno:function(){
                this.phoneno.push('')
            }
            
        }
        
    })
}  
</script>
@endpush                       