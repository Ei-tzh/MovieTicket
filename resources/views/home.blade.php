@extends('layouts.app')

@section('content')
    {{-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"  data-interval="2000">
        <ol class="carousel-indicators">
            @foreach($movies as $key => $movie)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key==0?'active':''}}"></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
        <!-- Slide One - Set the background image for this slide in the line below -->
            
                <div class="carousel-item active">
                    <img src="images/cover.jpg" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Welcome</h2>
                        <a href="">
                            <button type="button" class="btn movie-info">View Info</button>
                        </a>  
                    </div>
                </div> 
            
                
            
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div> --}}
    {{-- <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 text-center">
                    <h1 class="text-uppercase text-white font-weight-bold">Welcome To YCTC</h1>
                    <p class="lead text-light">Easy way to book movies in few minutes.</p>
                </div>
            </div>
        </div>
    </header> --}}
    <header class="masthead">
        <div class="container h-100 " >
            <div class="row h-100 align-items-center justify-content-center text-center ">
                <div class="col-lg-10 align-self-end banner-caption">
                    <h1 class="text-uppercase text-white font-weight-bold ">Welcome To YCTC</h1>
                </div>
                <div class="col-lg-8 align-self-baseline mt-2">
                    <p class="text-white font-weight-bold mb-5 banner-caption">Easy Way To Book Movies in less seconds</p>
                    <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">View Information</a>
                </div>
            </div>
        </div>
    </header>
    
{{-- page content --}}
<section class="py-5">
  <div class="container">
      <div class="row">
            <div class="col-12">
                <div class="row" id="movies">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="movies-caption">
                            <h1>Movies</h1>
                            <p>Be Sure Not To Miss These Movies Today</p>
                        </div>
                        <div class="movies-info row">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 align-self-center">
                                <h3>Now Showing</h3>
                            </div>
                            <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                                <p><i class="fas fa-city"></i>City:Yangon</p>
                            </div>
                            <div class="col-3 col-sm-3 col-md-3 col-lg-3">
                                <p><i class="fas fa-calendar-day"></i>Date:Yangon</p>
                            </div>
                        </div>
                        <div id="now-showing" class="row my-3">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                                <div class="card h-100">
                                    <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="#">Project One</a>
                                        </h4>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur eum quasi sapiente nesciunt? Voluptatibus sit, repellat sequi itaque deserunt, dolores in, nesciunt, illum tempora ex quae? Nihil, dolorem!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end .col -->
      </div>
      <!-- end .row -->
  </div>
</section>
@endsection