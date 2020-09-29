@extends('layouts.master')

@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row" >
                    <div class="col-lg-12">
                        <div class="card card-info" id="test">
                            <div class="card-header">
                                <h3 class="card-title">Test</h3>
                            </div>
                            <form action="" method="post">
                            @csrf
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="user" class="col-md-4 col-form-label text-md-right">User:</label>

                                        <div class="col-md-6" id="user">
                                        {{-- <select2 class="form-control" :options="users" v-model='selected' name='users' id='users'>
                                            <option disabled value="0">Select one</option>
                                        </select2> --}}
                                            <select class="form-control" id='user' name='user' style="width: 100%;">
                                                <option v-for='user in users' :value="user.id">@{{user.name}}</option>
                                            </select>
                                            
                                        </div>
                                    </div>
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
    var vm = new Vue({
        el: "#test",
        //template: "#user",
        data: {
          selected:'',
          users: @json($users)
        }
      });
</script>
@endpush