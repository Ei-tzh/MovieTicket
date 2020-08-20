@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
        <div class="container mt-2">
            <div class="row" id='app-2'>
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <form action=""  method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="card-body">
                            <!-- theaters -->
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                        
                                            <label for="ph_no">Ph.no:</label>
                                                <phone-number   v-for="(phone,index) in phoneno"
                                                                v-bind:item="phone"
                                                                v-bind:k="index"
                                                                v-on:remove="remove_phoneno"
                                                                ></phone-number>
                                                <button type="button" class='btn btn-success  mt-2' v-on:click="addnew_phoneno" >Add New</button>
                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- end theaters -->
                            </div>
                        </form>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                                
                        </div>
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
        el: '#app-2',
        data: {
            phoneno:@json($phone_no)
        },
        methods:{
            remove_phoneno:function(index){
               this.phoneno.splice(index,1)
            },
             addnew_phoneno:function(){
                this.phoneno.push(null)
            }
        }
        
    })
}  
</script>
@endpush



