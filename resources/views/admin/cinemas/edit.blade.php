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
                            <div class="card-body">
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
                                        <div class="form-group">
                                            <label for="ph_no">Ph.no:</label>
                                                <?php $vals=explode(',',$cinema->ph_no); ?>
                                                
                                                        <button type="button" class='btn btn-success  mt-2' id='create'>Add New</button>
                                                        
                                                
                                            <!-- /.input group -->
                                        @foreach ($errors->get('ph_no.*') as $message)
                                                @foreach($message as $value)
                                                    <small id="bodyhelp" class="form-text text-danger">{{$value}}</small>
                                                @endforeach
                                            
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div id="new_task"></div>
                                <!-- theater -->
                                <div class="row" id="app-2">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="theaters">Theaters:</label>
                                                    <theater-item   v-for="(theater,index) in theaters"
                                                                    v-bind:item="theater"
                                                                    v-bind:k="index"
                                                                    v-on:remove='removetheater'></theater-item>
                                                            
                                                    <button type="button" class='btn btn-success  mt-2' id='create_theater' v-on:click='addtheater'>Add New Theater</button>
                                                
                                            <!-- /.input group -->
                                        
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div id="new_theater"></div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
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
@push('jquery')
    <script type='text/javascript'>
        $(document).ready(function(){
            var i=0;
            var theater=0;
            var aa=@json($theaters);
            $(this).on('click','#remove',function(){
                var num=$(this).parent().attr('id');
                var text=$('#'+num+' '+'input').val();
                
                var result=confirm('Are you sure to delete this phone number '+text+' ?');
                if(result){
                    
                    $('#'+num).remove();
                }
                
            });
            $('#create').click(function(event){
                i++;
                var input='<div class="row" id="newphone'+i+'">'+'<div class="col-4">'+'<div class="form-group">'+'<div class="input-group">'+'<div class="input-group-prepend">'+'<span class="input-group-text"><i class="fas fa-phone"></i></span>'+'</div>'
                        +'<input type="tel" class="form-control" id="ph_no" name="ph_no[]" placeholder="Enter new phone number">'
                            
                                +'<button type="button" class="btn btn-success ml-1" id="clear">-</button>'
                            
                    +'</div>'+'</div>'+'</div>'+'</div>';
            $('#new_task').append(input);
            });

            $(this).on('click','#clear',function(){
               var button_id=$(this).parents('.row').attr('id'); 
               
                $('#'+button_id).remove();
            });
            $(this).on('click','#remove_theater',function(){
                var num=$(this).parents('.input-group').attr('id');
                var text=$('#'+num+' '+'input').val();
                
                var result=confirm('Are you sure to delete this phone number '+text+' ?');
                if(result){
                    
                    $('#'+num).remove();
                }
                
            });    
            $('#create_theater').click(function(event){
                theater++;
                var input='<div class="row" id="newtheater'+theater+'">'+'<div class="col-4">'+'<div class="form-group">'+'<div class="input-group">'
                        +'<input type="text" class="form-control" id="theaters" name="theaters[]" placeholder="Enter New Theater">'
                        +'<div class="input-group-append">'
                            +'<button type="button" class="btn btn-success" id="clear_theater">-</button>'
                        +'</div>'    
                   +'</div>'+'</div>'+'</div>'+'</div>';
            $('#new_theater').append(input);
            });
            $(this).on('click','#clear_theater',function(){
               var button_id=$(this).parents('.row').attr('id'); 
               
                $('#'+button_id).remove();
                
            });
        });
        
    </script>
@endpush 
@push('vue')
<script>

window.onload = function () {
Vue.component('theater-item',{
    props:['item','k','remove'],
    template:' <div class="input-group" v-bind:id="k"><input type="text" class="form-control mt-2" id="theaters" name="theaters[]" v-model="item.name" ><div class="input-group-append mt-2"><button type="button" @click="$emit(\'remove\',k)" class="btn btn-danger" >X</button></div></div>'
    
})
    var app2= new Vue({
        el: '#app-2',
        data: {
            theaters:@json($theaters)
        },
        methods:{
            addtheater:function(){
                this.theaters.push({
                    name:''
                })
            },
            removetheater:function(index){
                this.theaters.splice(index,1)
            }
            
        }
        
    })
}  
</script>
@endpush                       