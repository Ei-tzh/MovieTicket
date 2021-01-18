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
                                <div id="old_phoneno">
                                    <label for="ph_no">Ph.no:</label>
                                    <button id="add_new" class="btn btn-success mb-2">Add New phone.no</button>
                                    @foreach ($phoneno as $key=>$phone)
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="tel" class="form-control" id="ph_no{{$key}}" name="ph_no[]" value="{{ $phone }}">
                                                            <div id="remove">
                                                                <button type="button" class='btn btn-danger ml-1'>x</button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @foreach ($errors->get('ph_no.*') as $message)
                                    @foreach($message as $value)
                                        <small id="bodyhelp" class="form-text text-danger">{{$value}}</small>
                                    @endforeach
                                @endforeach
                                <div id="new_phoneno"></div>
                               <!-- image -->
                                <div class="form-group mt-4">
                                    <label for="image">Image</label>
                                    <div class="input-group">
                                        <img src="{{ $cinema->image}} " alt="" style="width:100px;height:auto;">
                                        <input type="file" id="image" name="image" class="image_upload">
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
@push('jquery')
    <script>
        $(document).ready(function(){
            var i=0;
            $("#add_new").click(function(event){
                event.preventDefault();
                event.stopPropagation();
                addRow();
            });
            $(this).on('click','#remove',function(){
                if(confirm('Are you sure you want to delete this phone number?')){         
                    var button_id=$(this).siblings().attr('id'); 
                    //alert(button_id);
                    $('#'+button_id).remove();
                    $(this).remove();
                }
            });
            function addRow(){
                i++;
                var row='<div class="row" id="newphone'+i+'">'+'<div class="col-4">'+'<div class="form-group">'+'<div class="input-group">'
                            +'<input type="tel" class="form-control" id="ph_no" name="ph_no[]" placeholder="09" >'
                                +'<div id="clear">'
                                    +'<button type="button" class="btn btn-danger ml-1">-</button>'
                                +'</div>'
                        +'</div>'+'</div>'+'</div>'+'</div>';
                $('#new_phoneno').append(row);
            }
            $(this).on('click','#clear',function(){
                var button_id=$(this).parents('.row').attr('id'); 
                $('#'+button_id).remove();
            });
           
        });
    </script>
@endpush

