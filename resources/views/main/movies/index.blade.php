@extends('layouts.app');

@section('content')
<div class="content">
    <section class="section section-lg page-section" id="now-showing">
        <div class="container">
            <div class="section-caption text-left">
                <h1>Now Showing</h1>
                <p>You can view movies in day by day.</p>
                <date-picker v-model='selectedDate' />
            </div>
        </div>
        
    </section>
</div>
@endsection
@push('vue')
    <script>
       
        window.onload = function () {
            
            var app= new Vue({
                el: '#now-showing',
                data:{
                        selectedDate:''
                    }
            })
        }
    </script>
@endpush