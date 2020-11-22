@extends('layouts.app');

@section('content')
<div class="content">
    <section class="section section-lg page-section" id="now-showing">
        <div class="container">
            <div class="section-caption text-left">
                <h1>Now Showing</h1>
                <p>You can view movies in day by day.</p>
            </div>
            <date-picker v-model='selectedDate'/>
                    {{-- Movies'section --}}
            {{-- <div class="movies-info row">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 align-self-center">
                    <h3>Now Showing</h3>
                </div>
                <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                    <p><i class="fas fa-city"></i>City:Yangon</p>
                </div>
                <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                    <p><i class="fas fa-calendar-day"></i>Date:{{' '.$current_date }}</p>
                </div>
            </div>
             --}}
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
                        selectedDate: null,
                        message:"Hello"
                    }
            })
        }
    </script>
@endpush