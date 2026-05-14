@extends('layouts.main')


@section('content')




<!--Search Popup-->

<div id="search-popup" class="search-popup">

    <div class="close-search theme-btn"><span class="flaticon-targeting-cross"></span></div>

    <div class="popup-inner">

        <div class="overlay-layer"></div>

        <div class="search-form">

            <form method="post" action="https://st.ourhtmldemo.com/new/City.Govt/index.html">

                <div class="form-group">

                    <fieldset>

                        <input type="search" class="form-control" name="search-input" value="" placeholder="Search Here" required>

                        <input type="submit" value="Search Now!" class="theme-btn">

                    </fieldset>

                </div>

            </form>



            <br>

            <h3>Recent Search Keywords</h3>

            <ul class="recent-searches">

                <li><a href="#">Finance</a></li>

                <li><a href="#">Idea</a></li>

                <li><a href="#">Service</a></li>

                <li><a href="#">Growth</a></li>

                <li><a href="#">Plan</a></li>

            </ul>



        </div>



    </div>

</div>



<section class="event-banner">

    <div class="image-layer" style="background-image:url('{{ asset('storage/' . $project->image) }}')"></div>





    <div class="banner-inner">

        <div class="auto-container">

            <div class="inner-container clearfix">

                <!-- <div class="cat-info clearfix">

                    <a href="#">Fun & Play</a>

                </div> -->

                <h1>{{$project->title}}</h1>

            </div>

        </div>

    </div>

</section>



<!--Events Section-->

<section class="event-details-section">

    <div class="auto-container">

        <div class="event-details">

            <div class="row clearfix">

                <!--Content Column-->

                <div class="content-column col-lg-8 col-md-12 col-sm-12">

                    <div class="content-inner">

                        <!--Info-->

                        <div class="info-blocks">
                            <div class="row clearfix">
                                <div class="info-block col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="icon"><span class="flaticon-circular-clock"></span></div>
                                        <h4>Date & Time</h4>
                                        <ul>
                                            <li>{{ \Carbon\Carbon::parse($project->created_date)->format('F d, Y') }}</li>
                                            <li>{{ \Carbon\Carbon::parse($project->created_date)->format('l \\a\\t H:i') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="info-block col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="icon"><span class="flaticon-map"></span></div>
                                        <h4>Location</h4>
                                        <ul>
                                            <li>{{ $project->location ?? 'No location specified' }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="main-image">


                            <figure class="image">
                                <img src="{{ asset('storage/' . $project->image) }}" alt="">
                            </figure>


                        </div>




                        <div class="card-body">
                            <h2 class="card-title">{{ $project->title }}</h2>

                            <p class="card-text mb-1"><strong>Start Date:</strong> {{ $project->start_date }}</p>
                            <p class="card-text mb-1"><strong>End Date:</strong> {{ $project->end_date }}</p>
                            <div class="mb-3">
                                <strong>Description:</strong><br>{!! nl2br(e($project->description)) !!}
                            </div>
                            @if($project->video_id)
                            <div class="mb-3">
                                <strong>Video ID:</strong> {{ $project->video_id }}
                                <!-- Optional: embed video if YouTube -->
                                {{-- Example: <iframe src="https://www.youtube.com/embed/{{ $project->video_id }}" width="100%" height="315" frameborder="0" allowfullscreen></iframe> --}}
                            </div>
                            @endif
                        </div>




                        <div class="more-info-box">

                            <div class="inner-box">

                                <div class="timings">

                                    <div class="curve"></div>

                                    <div class="inner">

                                        <ul>

                                            <li>9am - 10am</li>

                                            <li>10am - 12pm</li>

                                            <li>12.30pm - 2pm</li>

                                        </ul>

                                    </div>

                                </div>

                                <div class="toggle-box">

                                    <div class="accordion-box">

                                        <!--Block-->

                                        <div class="accordion block">

                                            <div class="acc-btn">Welcome speech from mayor
                                                <div class="icon flaticon-cross"></div>
                                            </div>

                                            <div class="acc-content">

                                                <div class="content">

                                                    <div class="text">Pleasure and praising pain was born and give you a complete.</div>

                                                </div>

                                            </div>

                                        </div>



                                        <!--Block-->

                                        <div class="accordion block current">

                                            <div class="acc-btn active">Program starts from LN school ground
                                                <div class="icon flaticon-cross"></div>
                                            </div>

                                            <div class="acc-content">

                                                <div class="content">

                                                    <div class="text">Pleasure and praising pain was born and give you a complete.</div>

                                                </div>

                                            </div>

                                        </div>



                                        <!--Block-->

                                        <div class="accordion block">

                                            <div class="acc-btn">Price distribution
                                                <div class="icon flaticon-cross"></div>
                                            </div>

                                            <div class="acc-content">

                                                <div class="content">

                                                    <div class="text">Pleasure and praising pain was born and give you a complete.</div>

                                                </div>

                                            </div>

                                        </div>



                                    </div>

                                </div>

                            </div>

                        </div>



                        <div class="special-guest">

                            <h2>Special Guest</h2>



                            <div class="guest-carousel owl-theme owl-carousel">

                                <!--Guest-->

                                <div class="guest-block">

                                    <div class="inner-box">

                                        <div class="inner">

                                            <figure class="image"><img src="images/resource/guest-image-1.jpg" alt=""></figure>

                                            <h4>AK. Marian <br>Lenora</h4>

                                            <div class="designation">Mayor</div>

                                        </div>

                                    </div>

                                </div>

                                <!--Guest-->

                                <div class="guest-block">

                                    <div class="inner-box">

                                        <div class="inner">

                                            <figure class="image"><img src="images/resource/guest-image-2.jpg" alt=""></figure>

                                            <h4>VJ. Herman <br>Gordon</h4>

                                            <div class="designation">Actuary</div>

                                        </div>

                                    </div>

                                </div>

                                <!--Guest-->

                                <div class="guest-block">

                                    <div class="inner-box">

                                        <div class="inner">

                                            <figure class="image"><img src="images/resource/guest-image-1.jpg" alt=""></figure>

                                            <h4>AK. Marian <br>Lenora</h4>

                                            <div class="designation">Mayor</div>

                                        </div>

                                    </div>

                                </div>

                                <!--Guest-->

                                <div class="guest-block">

                                    <div class="inner-box">

                                        <div class="inner">

                                            <figure class="image"><img src="images/resource/guest-image-2.jpg" alt=""></figure>

                                            <h4>VJ. Herman <br>Gordon</h4>

                                            <div class="designation">Actuary</div>

                                        </div>

                                    </div>

                                </div>

                                <!--Guest-->

                                <div class="guest-block">

                                    <div class="inner-box">

                                        <div class="inner">

                                            <figure class="image"><img src="images/resource/guest-image-1.jpg" alt=""></figure>

                                            <h4>AK. Marian <br>Lenora</h4>

                                            <div class="designation">Mayor</div>

                                        </div>

                                    </div>

                                </div>

                                <!--Guest-->

                                <div class="guest-block">

                                    <div class="inner-box">

                                        <div class="inner">

                                            <figure class="image"><img src="images/resource/guest-image-2.jpg" alt=""></figure>

                                            <h4>VJ. Herman <br>Gordon</h4>

                                            <div class="designation">Actuary</div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>





                        <div class="share-post">

                            <strong>Share this post with your friends</strong>

                            <ul class="links clearfix">

                                <li class="facebook"><a href="#"><span class="icon fab fa-facebook-f"></span><span class="txt">Facebook</span></a></li>

                                <li class="twitter"><a href="#"><span class="icon fab fa-twitter"></span><span class="txt">Twiter</span></a></li>

                                <li class="linkedin"><a href="#"><span class="icon fab fa-linkedin-in"></span><span class="txt">Linkedin</span></a></li>

                                <li class="pinterest"><a href="#"><span class="icon fab fa-pinterest-p"></span><span class="txt">Pinterest</span></a></li>

                            </ul>

                        </div>



                        <div class="related-posts">

                            <h2>Related Events</h2>



                            <div class="row clearfix">

                                <!--Event Block-->

                                <div class="event-block-three col-md-6 col-sm-12">

                                    <div class="inner-box">

                                        <div class="image-box">

                                            <figure class="image">
                                                <a href="event-details.html"><img src="images/resource/featured-image-28.jpg" alt=""></a>
                                            </figure>

                                        </div>

                                        <div class="lower-box">

                                            <div class="content-box">

                                                <div class="date-box">
                                                    <div class="date"><span class="day">14</span><span class="month">Dec</span></div>
                                                </div>

                                                <div class="content">

                                                    <div class="cat-info"><a href="event-details.html">Conference</a></div>

                                                    <h4><a href="event-details.html">Dacy's parade balloon inflation</a></h4>

                                                    <div class="location">At 12th street, Central park west, UK</div>

                                                    <div class="read-more"><a href="event-details.html">Read More</a></div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!--Event Block-->

                                <div class="event-block-three col-md-6 col-sm-12">

                                    <div class="inner-box">

                                        <div class="image-box">

                                            <figure class="image">
                                                <a href="event-details.html"><img src="images/resource/featured-image-29.jpg" alt=""></a>
                                            </figure>

                                        </div>

                                        <div class="lower-box">

                                            <div class="content-box">

                                                <div class="date-box">
                                                    <div class="date"><span class="day">22</span><span class="month">Dec</span></div>
                                                </div>

                                                <div class="content">

                                                    <div class="cat-info"><a href="event-details.html">Conference</a></div>

                                                    <h4><a href="event-details.html">Mayor's christmas carol service</a></h4>

                                                    <div class="location">At 12th street, Central park west, UK</div>

                                                    <div class="read-more"><a href="event-details.html">Read More</a></div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>



                    </div>

                </div>

                <!--Info Column-->

                <div class="info-column col-lg-4 col-md-12 col-sm-12">

                    <div class="info-inner">

                        <div class="title">
                            <h4>Contact Details</h4>
                        </div>

                        <div class="content">

                            <div class="contact-box">

                                <div class="info">

                                    <ul>

                                        <li class="clearfix"><span class="ttl">Organizer:</span> <span class="dtl">Herman Gordon</span></li>

                                        <li class="clearfix"><span class="ttl">Phone:</span> <span class="dtl"><a href="tel:+4488845678">+44 888 456 78</a></span></li>

                                        <li class="clearfix"><span class="ttl">Email:</span> <span class="dtl"><a href="mailto:gordon@mygovt.com">gordon@mygovt.com</a></span></li>

                                        <li class="clearfix"><span class="ttl">Social connect:</span> <span class="dtl"><a href="#">Facebook</a> <a href="#">Twitter</a></span></li>

                                    </ul>

                                </div>

                                <div class="location-box">

                                    <!--Map Box-->

                                    <div class="map-box">

                                        <div class="map-canvas" data-zoom="7" data-lat="-37.817085" data-lng="144.955631" data-type="roadmap" data-hue="#ffc400" data-title="Melbourne" data-icon-path="images/icons/map-marker.png" data-content="Melbourne VIC 3000, Australia<br><a href='mailto:info@youremail.com'>info@youremail.com</a>">

                                        </div>

                                    </div>

                                </div>

                                <div class="default-form booking-form">

                                    <h4>Project Booking</h4>

                                    <form method="POST" id="donatefromdetail" action="{{ route('donate.store') }}">

                                        @csrf
                                        <div class="form-group">

                                            <input type="text" name="name" placeholder="Name *" required="">

                                        </div>



                                        <div class="form-group">

                                            <input type="email" name="email" placeholder="Email Address *" required="">

                                        </div>



                                        <div class="form-group">
                                            <input type="text" name="address" placeholder="Address *" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="amount" placeholder="Amount" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="phone" placeholder="Phone Number *" required>
                                        </div>


                                        <div class="form-group">

                                            <textarea name="message" placeholder="Your Comments"></textarea>

                                        </div>

                                        <div class="form-group">

                                            <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Book Now</span></button>

                                        </div>

                                    </form>


                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- WhatsApp Floating Button -->
<a href="https://wa.me/919999999999" class="whatsapp-float" target="_blank" title="Chat with us on WhatsApp">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
        alt="WhatsApp"
        class="whatsapp-icon">
</a>


@endsection