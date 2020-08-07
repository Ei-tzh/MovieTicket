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
                <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="card-body">
                        <!-- cinema -->
                        <div class="form-group">
                            <label for="name">Cinema:</label>
                            <input type="text" class="form-control" id="name" name='name' placeholder="Enter cinema's name">
                            @error('name')
                                <small id="bodyhelp" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea name="address" id="address" class='form-control' cols="10" rows="5"></textarea>
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
                                                <input type="tel" class="form-control" id="ph_no" name="ph_no" placeholder="09" >
                                                <div id="new_task">
                                                    <button type="button" class='btn btn-success ml-1'>+</button>
                                                </div>
                                        </div>
                                   
                                    <!-- /.input group -->
                                </div>
                            </div>
                            
                        </div>
                        <div id="phone"></div>
                        <!-- image -->
                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="input-group">
                                <input type="file" id="image" name="image" class='form-control form-control-lg'>
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
                        </div>

                    </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
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
            $("#new_task").click(function(event){
            event.preventDefault();
            event.stopPropagation();
            
            var row = $("<div/>", {id: "row"});
            var col= $("<div/>", {class:"col-4"});
            row.append(col);

            var formgroup = $("<div/>", {class: "form-group"});
            var input_group=$("<div/>", {class: "input-group"});
            var input=$('<input/>',{type:'tel',class:"form-control",id:"ph_no",name:"ph_no[]",placeholder:"09" })

            var group_prepend=$("<div/>", {class: "input-group-prepend"});
            var span=$('<span/>',{class:'input-group-text'});
            span.append($('<i/>',{class:'fas fa-phone'}));
             
            // button
            var remove= $("<div/>", {id: "remove_task"});
            var button=$('<button/>',{type:"button",class:'btn btn-success ml-1'});
            button.html('-');
            remove.append(button);

            group_prepend.append(span);
            input_group.append(group_prepend,input,remove);
           
            

            formgroup.append(input_group);
            col.append(formgroup);
            $('#phone').append(row);
            });
            $('#remove_task').click(function(event){
                event.preventDefault();
                $(this).parents().remove();
            });
});
    </script>
@endpush