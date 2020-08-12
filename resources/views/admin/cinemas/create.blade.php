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
                    <h3 class="card-title">Add New Cinema</h3>
                </div>
                <form action="{{ route('cinemas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <!-- cinema -->
                        <div class="form-group">
                            <label for="name">Cinema:</label>
                            <input type="text" class="form-control" id="name" name='name' placeholder="Enter cinema's name" value="{{ old('name') }}">
                            @error('name')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class='form-control' cols="10" rows="5">{{ old('address') }}</textarea>
                            @error('address')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- ph.no -->
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="ph_no">Ph.no:</label>
                                    
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                                <input type="tel" class="form-control" id="ph_no" name="ph_no[]" placeholder="09(Enter your default number)" >
                                                <div id="new_task">
                                                    <button type="button" class='btn btn-success ml-1'>+</button>
                                                </div>
                                        </div>

                                    <!-- /.input group -->
                                   @foreach ($errors->get('ph_no.*') as $message)
                                        @foreach($message as $value)
                                            <small id="bodyhelp" class="form-text text-danger">{{$value}}</small>
                                        @endforeach
                                       
                                    @endforeach
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div id="phone"></div>
                        {{-- theaters --}}
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="theaters">Select numbers of theaters which you want to create</label>
                                    <select class="form-control" id="theaters" name='theaters'>
                                        <option value='' selected disabled>(Choose at least one)</option>
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                   <div id="new_theater"></div>
                                   @error('theaters')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- image -->
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <div class="input-group">
                                <input type="file" id="image" name="image" class='form-control form-control-lg' value='{{ old('image')}}'>
                            </div>
                            @error('image')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <!-- township -->
                        <div class="form-group">
                            <label for="township">Township</label>
                            <select class="form-control" id="township" name='township'>
                                @foreach($townships as $township)
                                    <option value='{{ $township->id }}'>{{ $township->name }}</option>
                                @endforeach
                                
                            </select>
                            @error('township')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('cinemas.index')}}"><button type="button" class="btn btn-success">Back</button></a>
                    </div>
                </form>
            <div>
        </div>
    </div>
</div>
</section>
</div>
@endsection
{{-- @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
          <strong>{{ $message }}</strong>
    </div>
    <br>
    @endif --}}
@push('jquery')
    <script type='text/javascript'>
        $(document).ready(function(){
            var i=1;
            $("#new_task").click(function(event){
            event.preventDefault();
            event.stopPropagation();
            
            addRow();
            
        });
        function addRow(){
            i++;
            var row='<div class="row'+i+'">'+'<div class="col-4">'+'<div class="form-group">'+'<div class="input-group">'+'<div class="input-group-prepend">'+'<span class="input-group-text"><i class="fas fa-phone"></i></span>'+'</div>'
                        +'<input type="tel" class="form-control" id="ph_no" name="ph_no[]" placeholder="09" >'
                            +'<div id="clear">'
                                +'<button type="button" class="btn btn-success ml-1">-</button>'
                            +'</div>'
                    +'</div>'+'</div>'+'</div>'+'</div>';
            $('#phone').append(row);
        }
            $(this).on('click','#clear',function(){
                var button_id = $('#phone div').attr("class"); 
                $('.'+button_id).remove();
                //console.log(button_id);
                //$(this).parent().remove();
            });
          
        

        //for theaters
        var input=$('<input/>',{type:'text',class:"form-control mt-2",id:"theaters",name:"theaters[]",placeholder:"Enter theater's name"});
        function addDiv(){
            $('#new_theater').append(input.clone());
        }
        $('#theaters').change(function () {
            $( "#new_theater" ).empty();
            
            var str=$(this).children("option:selected").val();
            for(var i=1;i<=str;i++){
             addDiv();
             
            }
        });
         
        });
    </script>
@endpush