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
                                    <label for="name">Cinema's Name:</label>
                                    <input type="text" class="form-control" id="name" name='name' placeholder="Enter cinema's name" value="{{ old('name') }}">
                                    @error('name')
                                        <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Address -->
                                <div class="form-group">
                                    <label for="address">Address:</label>
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
                                    <label for="township">Township:</label>
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

@push('jquery')
    <script>
        $(document).ready(function(){
            var i=1;
            var theater=1;
            $("#new_task").click(function(event){
                event.preventDefault();
                event.stopPropagation();
                addRow();
            });
            // $("#new_theater").click(function(event){
            //     event.preventDefault();
            //     event.stopPropagation();
            //     addTheater();
            // });
            function addRow(){
                i++;
                var row='<div class="row" id="newphone'+i+'">'+'<div class="col-4">'+'<div class="form-group">'+'<div class="input-group">'+'<div class="input-group-prepend">'+'<span class="input-group-text"><i class="fas fa-phone"></i></span>'+'</div>'
                            +'<input type="tel" class="form-control" id="ph_no" name="ph_no[]" placeholder="09" >'
                                +'<div id="clear">'
                                    +'<button type="button" class="btn btn-danger ml-1">-</button>'
                                +'</div>'
                        +'</div>'+'</div>'+'</div>'+'</div>';
                $('#phone').append(row);
            }
            $(this).on('click','#clear',function(){
                var button_id=$(this).parents('.row').attr('id'); 
                $('#'+button_id).remove();
            });
            // function addTheater(){
            //     theater++;
            //     var row='<div class="row" id="newtheater'+theater+'">'+'<div class="col-4">'+'<div class="form-group">'+'<div class="input-group">'
            //                 +'<input type="tel" class="form-control" id="theaters" name="theaters[]" placeholder="Enter A Theater\'s Name" >'
            //                     +'<div id="remove_theater">'
            //                         +'<button type="button" class="btn btn-danger ml-1">-</button>'
            //                     +'</div>'
            //             +'</div>'+'</div>'+'</div>'+'</div>';
            //     $('#theater').append(row);
            // }  
            // $(this).on('click','#remove_theater',function(){
            //     var button_id=$(this).parents('.row').attr('id'); 
            //     $('#'+button_id).remove();
            // });
        });
    </script>
@endpush