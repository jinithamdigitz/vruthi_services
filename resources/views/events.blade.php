@extends('layouts.main')

@section('title', 'Events')

 @php
    $banner = App\Http\Controllers\HomeController::getpbanner();
    @endphp

@section('content')

<section class="page-banner">

            <div class="image-layer" style="background-image:url({{ asset( $banner) }});"></div>


    <div class="banner-inner">

        <div class="auto-container">

            <div class="inner-container clearfix">

                <h1>Events List View</h1>

                <div class="page-nav">

                    <ul class="bread-crumb clearfix">

                        <li><a href="index.html">Home</a></li>

                        <li class="active">Events</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</section>
<div class="sidebar-page-container">

    <div class="auto-container">

        <div class="row clearfix">



            <!--Content Side-->

            <div class="content-side col-lg-12 col-md-12 col-sm-12">

                <div class="content-inner">

                    <div class="event-filters-box">

                        <!-- <form method="post" action="events-list.html"> -->

                        <!-- <div class="outer clearfix"> -->

                        <!-- <div class="form-group category">

                                            <div class="field-inner">

                                                <select name="subject" class="custom-select-box" id="ui-id-1" style="display: none;">

                                                <option>All Categories</option>

                                                <option>Celebrations</option>

                                                <option>Conference</option>

                                                <option>Tourist Guide</option>

                                            </select><span tabindex="0" id="ui-id-1-button" role="combobox" aria-expanded="false" aria-autocomplete="list" aria-owns="ui-id-1-menu" aria-haspopup="true" class="ui-selectmenu-button ui-selectmenu-button-closed ui-corner-all ui-button ui-widget"><span class="ui-selectmenu-icon ui-icon ui-icon-triangle-1-s"></span><span class="ui-selectmenu-text">All Categories</span></span>

                                            </div>

                                        </div> -->

                        <!-- <div class="form-group location">

                                            <div class="field-inner">

                                                <select name="subject" class="custom-select-box" id="ui-id-2" style="display: none;">

                                                <option>All Locations</option>

                                                <option>USA</option>

                                                <option>Canada</option>

                                                <option>China</option>

                                            </select><span tabindex="0" id="ui-id-2-button" role="combobox" aria-expanded="false" aria-autocomplete="list" aria-owns="ui-id-2-menu" aria-haspopup="true" class="ui-selectmenu-button ui-selectmenu-button-closed ui-corner-all ui-button ui-widget"><span class="ui-selectmenu-icon ui-icon ui-icon-triangle-1-s"></span><span class="ui-selectmenu-text">All Locations</span></span>

                                            </div>

                                        </div> -->

                        <!-- <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Explore <span class="icon flaticon-search"></span></span></button> -->

                        <!-- </div> -->

                        <!-- </form> -->

                    </div>

                    <div class="events-list">

                        <!--Event Block-->
                        @foreach($events as $event)
                        <div class="event-block">
                            <div class="inner-box">
                                <div class="content-box">


                                    <div class="date-box">
                                        <div class="date">
                                            <span class="day">{{ \Carbon\Carbon::parse($event->created_date)->format('d') }}</span>
                                            <span class="month">{{ \Carbon\Carbon::parse($event->created_date)->format('F') }}</span>
                                        </div>
                                    </div>


                                    <div class="content">


                                        <div class="cat-info">
                                            <a href="#">{{ $event->name }}</a>
                                        </div>


                                        <h3>
                                            <a href="event-details.html">{{ $event->name }}</a>
                                        </h3>


                                        <div class="location">
                                            {{ $event->description }}
                                        </div>


                                        <div class="event-image" style="margin-top: 10px;">
                                            <img src="{{ asset('images/f2.jpg') }}" alt="Event Image"
                                                style="width: 100%; max-width: 300px; height: auto; border-radius: 8px;">
                                        </div>


                                        <div class="read-more" style="margin-top: 10px;">
                                            <a href="{{ route('events.details', ['id' => $event->id]) }}">Read More</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <br><br>
                        <!--Pagination-->

                        <div class="pagination-box text-right">

                            <ul class="styled-pagination">

                                <li class="prev"><a href="#"><span class="icon flaticon-arrows-1"></span> Prev</a></li>

                                <li><a href="#" class="active">1</a></li>

                                <li><a href="#">2</a></li>

                                <li class="next"><a href="#">Next <span class="icon flaticon-right-2"></span></a></li>

                            </ul>

                        </div>

                    </div>

                </div>



                <!--Sidebar Side-->



            </div>

        </div>

    </div>
    @endsection