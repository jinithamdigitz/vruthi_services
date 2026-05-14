@extends('layouts.main')

@section('content')

<section class="page-banner">

    <div class="image-layer" style="background-image:url(images/background/banner-image-2.jpg);"></div>



    <div class="banner-inner">

        <div class="auto-container">

            <div class="inner-container clearfix">

                <h1>Projects</h1>

                <div class="page-nav">

                    <ul class="bread-crumb clearfix">

                        <li><a href="/">Home</a></li>


                        <li class="active">Projects</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</section>
<section class="events-section-two load-more-section" data-load-number="2">

    <div class="auto-container">



        <div class="upper-info clearfix">

            <div class="items-label"><span>16</span> Upcoming events.</div>

            <div class="sort-by">

                <div class="drop-list-one">

                    <div class="inner clearfix">

                        <div class="dropdown-outer open"><a class="btn-box dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#">Upcoming Events</a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

                                <li><a href="events-grid.html">Upcoming Events</a></li>

                                <li><a href="events-grid.html">Previous Events</a></li>

                                <li><a href="events-grid.html">Sort By Newest</a></li>

                                <li><a href="events-grid.html">Cancelled Events</a></li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="row clearfix">
            @foreach($projects as $project)


            <!--Event Block-->

            <div class="event-block-two col-md-6 col-sm-12">

                <div class="inner-box">

                    <div class="image-box">

                        <figure class="image">
                            <a href="event-details.html"><img src="{{ asset('storage/' . $project->image) }}" alt=""></a>
                        </figure>

                    </div>

                    <div class="lower-box">

                        <div class="content-box">

                            <div class="date-box">
                                <div class="date"><span class="day"><span class="day">{{ \Carbon\Carbon::parse($project->start_date)->format('d') }}</span></span><span class="month"><span class="month">{{ \Carbon\Carbon::parse($project->start_date)->format('M') }}</span></span></div>
                            </div>

                            <div class="content">

                                <!-- <div class="cat-info"><a href="event-details.html">Conference</a></div> -->

                                <h3><a href="event-details.html">{{$project->title }}</a></h3>

                                <div class="location">{{$project->description }} </div>

                                <div class="read-more"><a href="{{ route('projects.details', ['slug' => $project->slug]) }}">Read More</a></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach



        </div>



        <div class="load-more text-center">

            <a href="portfolio-grid-2.html" class="theme-btn btn-style-one load-more-btn"><span class="btn-title">Load More</span></a>

        </div>



    </div>

</section>




























@endsection