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
<section class="section section-lg pt-5" id="movies">
    <div class="container">
        <div class="section-caption">
            <h1>Movies</h1>
            <p>Be Sure Not To Miss These Movies Today</p>
        </div>
                {{-- Movies'section --}}
        <div class="movies-info row">
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
        <div id="now-showing" class="row @if(count($timetables)==0){{'error align-items-center justify-content-center text-center my-3'}}@endif">
            @forelse ($timetables as $timetable)
                @foreach($timetable->movie_theaters as $movie_theater)
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4 my-3">
                        <div class="card h-100">
                        @foreach($movies as $movie)
                            @foreach($theaters as $theater)
                                @if($movie->id == $movie_theater->movie_id && $theater->id == $movie_theater->theater_id)
                                    <div class="cropped-image">
                                        <a href="#"><img class="card-img-top" src="{{ $movie->poster }}" alt="" ></a>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title">
                                            <a href="#">{{ $movie->name }}</a>
                                        </h1>
                                        <div class="card-text">
                                            <ul class="fa-ul">
                                                <li><span class="fa-li"><i class="fas fa-building"></i></span>{{ $theater->cinema->name }}</li>
                                                <li><span class="fa-li"><i class="fas fa-door-closed"></i></span>{{ $theater->name }}</li>
                                                <li><span class="fa-li"><i class="fas fa-clock"></i></span>{{ $timetable->show_time }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                        </div>
                    </div>
                @endforeach
                @empty
                    <div class="col-12 align-self-center text-secondary">
                        <i class="fas fa-info-circle mr-1"></i>Sorry!There is no movies showing today!!
                    </div>
            @endforelse 
        </div>
        @if(count($timetables)!=0)
        <div class="row text-right see-more">
            <div class="col-12">
                <a href="">View All <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
        @endif
    </div>
</section>
                {{-- end Movies'section --}}
<section class="section section-lg py-5" id="cinemas">
    <div class="container">
        <div class="section-caption">
            <h1>Cinemas</h1>
            <p>All About Locations And Schedules For Each Cinemas.</p>
        </div>
        {{-- cinemas' index --}}
        <div class="row">
            @foreach($cinemas as $cinema)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div class="cinema-cropped-image">
                            <a href="#"><img class="card-img-top" src="{{ $cinema->image }}" alt=""></a>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $cinema->township->name }}</p>
                            <h4 class="card-title">
                                {{ $cinema->name }}
                            </h4>
                            <a href="" class="text-dark" title="View Info"><i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row text-right see-more">
            <div class="col-12">
                <a href="">View All <i class="fas fa-angle-double-right"></i></a>
            </div>
        </div>
    </div>
</section>
{{-- Our services --}}
<section class="section section-lg bg-gray-darker text-white" id="services">
    <div class="container">
        <div class="section-caption">
            <h1>Our Services</h1>
        </div>
        <div class="row text-left services-body">
            <div class="col-sm-10 col-md-6 col-lg-3">
                <div class="services-box">
                    <div class="services-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <p class="services-title">Perfect Information</p>
                    <hr>
                    <div class="services-text text-spacing-sm">We provide to watch informations about cinemas and movies at one place.</div>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-3">
                <div class="services-box">
                    <div class="services-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <p class="services-title">24/7 Online Support</p>
                    <hr>
                    <div class="services-text text-spacing-sm">You can easily book movies tickets at any time.(24/7 online service)</div>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-3">
                <div class="services-box">
                    <div class="services-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <p class="services-title">Up To Date Seats'plans</p>
                    <hr>
                    <div class="services-text text-spacing-sm">You can see seats' plans which are available for booking or unavailable.</div>
                </div>
            </div>
            <div class="col-sm-10 col-md-6 col-lg-3">
                <div class="services-box">
                    <div class="services-icon">
                        <i class="fas fa-money-check"></i>
                    </div>
                    <p class="services-title">Easy Payment Method</p>
                    <hr>
                    <div class="services-text text-spacing-sm">Our Customers can pay cash at Mini Store(eg.City Express,g&g and ABC) by showing order.No to counter.</div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection