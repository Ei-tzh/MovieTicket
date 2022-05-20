@extends('layouts.app');

@section('content')
<div class="content py-5">
    
    <section class="section section-lg page-section" id="now-showing">
        <div class="container">
            <div class="section-caption text-left">
                <h1>Movies</h1>
                <p>You can view movies in day by day.</p>
                {{-- <date-picker v-model='selectedDate' /> --}}
                
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-5">
                            <div class="sidebar-categories">
                                <div class="head">Movie Categories</div>
                                    <ul class="main-categories">
                                        @foreach ($categories as $category )
                                        <li class="main-nav-list">
                                            <a href="">
                                                <span class="lnr lnr-arrow-right"></span>{{ $category->name }}
                                            </a>
                                        </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                            </div>
                        
                        <!-- end category section -->
                        <!-- pagination -->
                        <div class="col-xl-9 col-lg-8 col-md-7">
                            
                            <!-- Start Movies-->
                            <section class="lattest-product-area pb-40 category-list">
                                <div class="row">
                                    @foreach ($movies as $movie )
                                    <div class="col-lg-6 col-md-6">
                                        <div class="single-product border "  style="margin-top: 0;">
                                            <a href="">
                                                <img class="img-fluid" src="{{ $movie->poster }}" alt="" style="height:250px;object-fit: cover;">
                                            </a>
                                            <div class="product-details p-4">
                                                <h6>{{ $movie->name }}</h6>
                                                <div class="price">
                                                    <p>Duration - {{ $movie->duration }}</p>
                                                    <h5>{{ $movie->type }}</h5>
                                                    
                                                    <p>
                                                        @foreach ($movie->categories as $moviecategory)
                                                        @if($loop->last)
                                                            {{ $moviecategory->name}}
                                                        @else
                                                             {{ $moviecategory->name.',' }}
                                                        @endif
                                                        @endforeach
                                                    </p>
                                                    
                                                </div>
                                                <div class="prd-bottom">
                                                        <a href="" class="btn btn-primary">
                                                            view more
                                                        </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                            </section>
                        </div>
                    </div>
            </div>
        </div>
        
    </section>
</div>
@endsection
@push('vue')
    {{-- <script>
       
        window.onload = function () {
            
            var app= new Vue({
                el: '#now-showing',
                data:{
                        selectedDate:''
                    }
            })
        }
    </script> --}}
@endpush