<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
@yield('metadata')


<!-- meta viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- favicon -->
    <link rel="icon" href="{{asset('user/favicon.html')}}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset('user/favicon.html')}}" type="image/x-icon" />

    <!-- bootstrap 3 stylesheets -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/bs3/css/bootstrap.css')}}" media="all" />


    <link rel="stylesheet" href="{{asset('user/css/flexslider.css')}}" type="text/css" media="screen" />
    <!-- template stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/css/styles.css')}}" media="all" />
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/js/rs-plugin/css/settings.css')}}" media="all" />
    <!-- responsive stylesheet -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/css/responsive.css')}}" media="all" />

    <!-- color scheme -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/css/colors/color1.css')}}" title="color1" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('user/css/colors/color2.css')}}" title="color2" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('user/css/colors/color3.css')}}" title="color3" />
    <link rel="alternate stylesheet" type="text/css" href="{{asset('user/css/colors/color4.css')}}" title="color4" />


    {{-- select 2--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


    <!-- Load Fonts via Google Fonts API -->

    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Karla:400,700,400italic,700italic" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('user/css/jquery.bxslider.css') }}" media="all" />

    {{--
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    --}}

    {{--
        <link href="{{ asset('user/css/date-picker.css') }}" rel="stylesheet">
    --}}

    <link rel="stylesheet" href="{{ asset('intl/build/css/intlTelInput.css') }}">

    {{------------------------------ANIMATION--------------------------------------------------}}
    <link rel="stylesheet" href="{{ asset('user/animation/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('user/animation/css/extralayers.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('user/animation/css/settings.css') }}">--}}

    {{------------------------------ANIMATION--------------------------------------------------}}




    <style>
        input::-webkit-calendar-picker-indicator {
            display: none;
        }
        div.vertical-line{
            width: 1px;
            background-color: black;
            height: 100%;
            float: left;
        }
    </style>

    <style>
        .item {
            position: relative;
            margin: 2%;
        }
        .item img {
            -moz-transition: all 0.3s;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
        }
        .item:hover img {
            -moz-transform: scale(1.1);
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }
    </style>
    <style>
        #contact label{
            display: inline-block;
            width: 100px;
            text-align: right;
        }
        #contact_submit{
            padding-left: 100px;
        }
        #contact div{
            margin-top: 1em;
        }
        textarea{
            vertical-align: top;
            height: 5em;
        }

        .error{
            display: none;
            margin-left: 10px;
        }

        .error_show{
            color: red;
            margin-left: 10px;
        }

        input.invalid, textarea.invalid{
            border: 2px solid red;
        }

        input.valid, textarea.valid{
            border: 2px solid green;
        }
    </style>


</head>
<body>

<!-- START header -->
<header>
    <!-- START #top-header -->
    <div id="top-header" style="background:url('../user/img/leaf1.png') ">
        <div class="container">
            <div class="row top-row">
                <div class="col-md-6 col-sm-8 col-xs-6">
                    <div class="left-part alignleft">
                        <a style="color: white;font-size: 18px;" href="mailto:info@gotripaz.com" target="_blank">  <span style="color: white" class="contact-email small">info@gotripaz.com</span></a>

                        <a style="color: white;font-size: 18px;" href="tel:+919846444455"><span   style="color: white" class="contact-phone small">  +91 9846444455 </span></a>



                    </div><br>
                </div>
                <div class="col-md-6 col-sm-4 col-xs-6" >
                    <div class="right-part alignright">
                        <ul class="social-media footer-social" style="float: right">
                            <li style="padding: 2px;"><a style="color:white;font-size: 18px;" class="sm" href="https://www.youtube.com/channel/UCztAe7m9T87dvXoN8hzQqPw"><i class="fa fa-youtube"></i><span>Youtube</span></a></li>
                            <li style="padding: 2px;"><a style="color:white;font-size: 18px;" class="sm" href="https://twitter.com/z_tripa"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>

                            <li style="padding: 2px;"><a style="color:white;font-size: 18px;" class="sm" href="https://in.pinterest.com/gotripaz/"><i class="fa fa-pinterest"></i><span>Pinterest</span></a></li>
                            <li style="padding: 2px;"><a style="color:white;font-size: 18px;" class="sm" href="https://www.facebook.com/GoTripaZ.co/"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
 <li style="padding: 2px;"><a style="color:white;font-size: 18px;" class="sm" href="https://www.instagram.com/gotripaz/?hl=en"><i class="fa fa-instagram"></i><span>Facebook</span></a></li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END #top-header -->

    <!-- START #main-header -->
    <div id="main-header" style="background:#e6e7e8;height: 68px;">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-3">
                    <a id="site-logo" href="{{ route('viewMainCategory') }}">
                        <img src="{{ asset('user/img/gotripaz.png') }}" alt="Gotripz" />
                    </a>
                </div>
                <div class="col-md-10 col-sm-9">
                    <nav class="main-nav">
                        <span><i class="fa fa-bars" aria-hidden="true"></i></span>
                        <ul id="main-menu">
                            <li><a href="{{ route('viewMainCategory') }}" title="">HOME</a></li>
                            <li><a href="{{route('destinations.show')}}" title="">DESTINATIONS</a></li>
                            {{--
                                                        <li><a href="{{ route('how.it.works') }}" title="">HOW IT WORKS</a></li>
                            --}}
                            <li><a title="" href="{{ route('trip.request') }}">CUSTOM TRIP</a> </li>
                            <li><a href="{{ route('show.all.packages') }}">PACKAGES</a></li>
                            <li><a href="{{ route('show.all.hotels') }}">HOTELS</a></li>


                            <li><a href="{{route('blogs.show')}}" title="">BLOGS</a></li>
                            <li><a title="" href="{{route('contactus')}}">CONTACT US</a> </li>


                        </ul>
                        @if (Route::has('login'))
                            @auth
                                <li style="display: none"><a href="{{ url('/home') }}" title=""></a></li>
                            @else
                                <li style="display: none"><a href="{{ route('login') }}" title=""></a></li>
                            @endauth
                        @endif

                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- END #main-header -->
</header>
<!-- title -->
<title>Home | Gotripaz</title>

<style>
    .js div#preloader { position: fixed;
        left: 0;
        top: 0;
        z-index: 999;
        width: 100%;
        height: 100%;
        overflow: visible;
        background: #ffff url('{{ asset('storage/image/category/ajax-loader.gif') }}') no-repeat center center; }


</style>
<style>
    .myStyle
    {
        /*  background: none repeat scroll 0 0 #b3a8a8;*/
        background: none repeat scroll 0 0 #d2d3d4;
        float: left;
        padding-left: 24px;
        position: relative;
        width: 100%;
        margin-bottom: 50px;
        min-height: 60px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -ms-border-radius: 5px;
        -o-border-radius: 5px;
        border-radius: 5px;
        margin-left: -1px;
    }

    .intl-tel-input.allow-dropdown .flag-container, .intl-tel-input.separate-dial-code .flag-container {
        left: -5px;
    }
    .search_con{
        float:right;
        padding-right: 15px;
    }
    .fa-search{
        float: left;
        padding: 10px;
        padding-top: 3px;
        font-size: 20px;
    }
    .search_div{
        float: left;

        color: #0a0a0a;
        border: 0;
        height: 30px;
        padding: 5px 10px;
        border-bottom: 1px solid #D6D6D6;
    }


</style>
<style>
    .iti-flag {background-image: url({{ asset('intl/build/img/flags.png') }});}

    @media only screen and (-webkit-min-device-pixel-ratio: 2), only screen and (min--moz-device-pixel-ratio: 2), only screen and (-o-min-device-pixel-ratio: 2 / 1), only screen and (min-device-pixel-ratio: 2), only screen and (min-resolution: 192dpi), only screen and (min-resolution: 2dppx) {
        .iti-flag {background-image: url({{ asset('intl/build/img/flags@2x.png') }});}
    }

</style>
<style>
    ::placeholder {
        color:black;
        opacity: 1; /* Firefox */
    }

    :-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: black;
    }

    ::-ms-input-placeholder { /* Microsoft Edge */
        color: black;
    }
</style>



<!-- START #wrapper -->
<div id="wrapper">

    <div id="main-slider">
        <div id="content-slider" class="sliderClass">
            <ul>
                <li data-transition="fade" class="wobble"  data-slotamount="5" data-masterspeed="700">
                    <img class="mySlides" src="{{ asset('user/img/slider13.jpg') }}"
                         style="overflow: visible;visibility: visible;position: relative" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" />
                    <div class="caption caption-yellow sft stt headline text-upper anim"
                         data-x="20"
                         data-y="150"
                         data-speed="600"
                         data-start="2000"
                         data-easing="Power3.easeOut"
                         data-endspeed="400"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
                         style="z-index: 0;overflow: visible;visibility: visible">
                        {{--DISCOVER EVERYTHING...--}}
                    </div>
                </li>
                <li data-transition="fade" class="slideInRight" data-slotamount="5" data-masterspeed="700">
                    <img class="mySlides" src="{{ asset('user/img/slide-image-4.jpg') }}" style="overflow: visible;visibility: visible;position: relative" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" />
                    <div class="caption caption-yellow sft stt headline text-upper anim"
                         data-x="20"
                         data-y="150"
                         data-speed="600"
                         data-start="2000"
                         data-easing="Power3.easeOut"
                         data-endspeed="400"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
                         style="z-index: 0;overflow: visible;visibility: visible">
                        {{--TRAVEL BEYOND THE MAP...--}}
                    </div>
                </li>
                <li data-transition="fade" data-slotamount="5" data-masterspeed="700">
                    <img class="mySlides" src="{{ asset('user/img/slider15.jpg') }}" style="overflow: visible;visibility: visible;position: relative" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" />
                    <div class="caption caption-yellow sft stt headline text-upper anim"
                         data-x="20"
                         data-y="150"
                         data-speed="600"
                         data-start="2000"
                         data-easing="Power3.easeOut"
                         data-endspeed="400"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
                         style="z-index: 0;overflow: visible;visibility: visible">
                        {{--EXPLORE THE UNSEEN DESTINATIONS...--}}
                    </div>
                </li>
                <li data-transition="fade" data-slotamount="5" data-masterspeed="700">
                    <img class="mySlides" src="{{ asset('user/img/slider3.jpg') }}" style="overflow: visible;visibility: visible;position: relative" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" />
                    <div class="caption caption-yellow sft stt headline text-upper anim"
                         data-x="20"
                         data-y="150"
                         data-speed="600"
                         data-start="2000"
                         data-easing="Power3.easeOut"
                         data-endspeed="400"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
                         style="z-index: 0;overflow: visible;visibility: visible">
                        {{--ENJOY THE MOMENTS...--}}
                    </div>
                </li>
                <li data-transition="fade" data-slotamount="5" data-masterspeed="700">
                    <img class="mySlides" src="{{ asset('user/img/slider4.jpg') }}" style="overflow: visible;visibility: visible;position: relative" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" />
                    <div class="caption caption-yellow sft stt headline text-upper anim"
                         data-x="20"
                         data-y="150"
                         data-speed="600"
                         data-start="2000"
                         data-easing="Power3.easeOut"
                         data-endspeed="400"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
                         style="z-index: 0;overflow: visible;visibility: visible">
                        {{--CREATE YOUR MEMORIES...--}}
                    </div>
                </li>
                <li data-transition="fade" data-slotamount="5" data-masterspeed="700">
                    <img class="mySlides" src="{{ asset('user/img/slider16.jpg') }}" style="overflow: visible;visibility: visible;position: relative" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" />
                    <div class="caption caption-yellow sft stt headline text-upper anim"
                         data-x="20"
                         data-y="150"
                         data-speed="600"
                         data-start="2000"
                         data-easing="Power3.easeOut"
                         data-endspeed="400"
                         data-endeasing="Power4.easeIn"
                         data-captionhidden="off"
                         style="z-index: 0;overflow: visible;visibility: visible">
                        {{--TRAVEL BEYOND THE MAP...--}}
                    </div>
                </li>
            </ul>
        </div>
        <div id="slider-overlay"></div>
    </div>
    <!-- END #main-slider -->
    <div class="fixed-bg" style="background-attachment: fixed;max-height: auto;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;"></div>

    <!-- START .main-contents -->
    <div class="main-contents">

        <div class="container" id="home-page">
            <br>
            <!-- START .tour-plan -->
            <form class="myStyle" action="{{ route('user.enquiry') }}" id="myForm" method="post">
                {{csrf_field()}}
                {{--
                                                  <div class="plan-banner"><span>PLAN YOUR</span><h4>DREAM <span>TOUR</span></h4></div>
                                  --}}
                <div class="row">
                    <div class="col-md-2">
                        <div class="col-md-12 input-field">
                            <select  id="destination"
                                     class="js-example-basic-single form-control " name="destination" style="color:black" data-placeholder="Enter Destination"> </select>

                            {{--<input style="color: black"
                                    aria-required="true"
                                    id="destination"
                                    name="destination"
                                    pattern="^([- \w\d\u00c0-\u024f]+)$"
                                    required="required"
                                    size="20"
                                    spellcheck="false"
                                    title="Your name (no special characters, diacritics are okay)"
                                    type="text"
                                    value=""
                                    placeholder="Enter Destination"
                                   autocomplete="on">--}}

                        </div>
                        <span class="error">This field is required</span>
                    </div>
                    <div class="col-md-2">
                        <div class="col-md-12 input-field">
                            <input type="text" id="phone" name="number" style="width: 105%;
                                        color: #0a0a0a;border: 0;height: 30px;padding-left: 38px;
                                        border-bottom: 1px solid #D6D6D6;"   title="Your Contact Number" placeholder="Enter Your Number">
                            <input type="tel" id="phone2" name="number2" style="display: none">
                        </div>
                        <span id="Numbererror" style="color: red;display:none;">Number Required</span>

                    </div>
                    <div class="col-md-2">
                        <div class="col-md-12 input-field">
                            <input aria-required="true"
                                   id="email"
                                   name="email"
                                   pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$"
                                   size="30"
                                   spellcheck="false"
                                   title="Your email address"
                                   type="email"
                                   value=""
                                   placeholder="Enter Your Email" >
                            <span  style="color: red;display:none">This email id is already in use..!!!</span>
                        </div>
                        <span id="Emailerror" style="color: red;display:none;">Email Required</span>
                    </div>
                    <div class="col-md-2">
                        <div class="col-md-12 input-field" style="color: black">
                            <input type="text"  style="color: black"  id="start_date" name="start_date" placeholder="Start Date" />
                        </div>
                        <span id="StartDateerror" style="color: red;display:none;">Start Date Required</span>
                    </div>

                    <div class="col-md-2">
                        <div class="col-md-12 input-field" style="color: black">
                            <input type="text" style="color: black"  id="end_date" name="end_date" placeholder="End Date" />
                        </div>
                        <span id="EndDateerror" style="color: red;display:none;">End Date Required</span>
                    </div>
                    <div class="col-md-2">
                        <div class="col-md-12 submit-btn">
                            <input type="submit" name="Submit" id="submit" value="Enquiry"/>
                        </div>
                    </div>
                </div>

                {{--<div class="top-fields">
                    <div class="input-field col-md-3"></div>
                    <div class="input-field col-md-3">
                    <div class="input-field col-md-3"></div>
                    --}}{{--<div class="input-field col-md-3"><input type="text" name="where_to_go" placeholder="1. Where to go?" /></div>
                    <div class="input-field col-md-3"><input type="text" name="what_to_do" placeholder="2. What to do?" /></div>--}}{{--
                    <div class="input-field col-md-6 schedule">

                    </div>
                </div>
                <div class="submit-btn col-md-2">

                </div>--}}
                {{--<div class="bottom-fields">
                    <div class="input-field select col-md-3">
                        <label>5. With Adults</label>
                        <input type="number" min="0" value="adults" name="adults" />


                    </div>
                    <div class="input-field select col-md-3">
                        <label>6. With Kids</label>
                        <input type="number" min="0" value="kids" name="kids" />
                    </div>
TEAICLUB - Create students profile

                </div>--}}
            </form>
            {{--<h2 style="color: #3e6b61">See the world. It's more fantastic than any dream made.</h2>
            <h3 style="color: #3e6b61">You see what a tiny place you occupy in the world.</h3>
            <h3 style="color: #3e6b61">Fill your life with adventures.</h3>--}}
            {{--<div class="sliderwrap">
                 <ul class="bxslider">
                      <h2 style="color: red">TELL US TO YOUR  TRAVEL PLAN..</h2>
                    <h3 style="color: red">GET A CUSTOMISED PACKAGES FROM THE PROMINENT  TRAVEL COMPANIONS
                    </h3>
                     <h3 style="color: red">MAKE YOUR TRIP A MEMORABLE ONE AND POST YOUR REVIEW FOR WON THE PRIZES
                     </h3>
                 </ul>
             </div>--}}<br>
            <div class="row search_con">
                <i class="fa fa-search"></i>
                <input id="search" autocomplete="off" list="results" class="search_div"  type="search" value="" placeholder="Search"/>
                <datalist id="results" name="results">
                </datalist>
            </div>
            <div class="row search_con" id="resultsss">

            </div>
            {{--<form action="{{ route('user.check.email.exist') }}" method="post">
                {{ csrf_field() }}

                <input type="email" name="email" id="email">
                <button type="submit">Ok</button>
            </form>--}}
        <!-- END .tour-plan -->



            <h2 class="ft-heading">Indian Tour Packages</h2>



            <div class="col-md-12" id="INBOUNDCATEGORIES">


                {{--
                                            <div class="row">

                                                @foreach($location as $locations)
                                                    <div class="col-md-3">


                                                        <div class="ft-item" ><h4> {{$locations->location}}</h4>
                                                            <span class="ft-image" >
                                        <a href="{{route('user.about.destinations',$locations->location)}}">
                                            <img src="{{ asset ('storage/'.$locations->image) }}"  alt="No image" class="img-responsive" /></a>
                                                            </span>
                                                            <div class="ft-data">
                                                                <a class="ft-hotel text-upper" href="#">Hotel</a>
                                                                <a class="ft-plane text-upper" href="#">Travel</a>
                                                                <a class="ft-tea text-upper" href="#">Food</a>
                                                            </div>
                                                            <div class="ft-foot">
                                                                <span class="ft-offer text-upper">Starting From 4000 Rs/- </span>
                                                            </div>


                                                        </div>


                                                    </div>

                                                @endforeach

                                            </div> --}}

                <div class="row">

                    @foreach($destinations as $destination)
                        <div class="col-md-3">


                            <div class="ft-item item" ><h4> {{ ucfirst(strtolower($destination->destination))  }}</h4>
                                <span class="ft-image" >
                                              {{--  <a href="{{route('user.about.destinations',$destination->destination)}}">--}}
                                    <a href="{{route('destination.show.package',$destination->slug)}}">
                                                    <img src="{{ asset ('storage/'.$destination->image) }}"  alt="No image" class="img-responsive" /></a>
											</span>
                                <div class="ft-data">
                                    <a class="ft-hotel" href="{{ route('user.destination.hotels',$destination->slug) }}">Hotel</a>
                                    @if(!empty($destination->get_packages))
                                        <a class="ft-plane" href="{{ route('destination.show.package',$destination->destination) }}">Travel</a>
                                    @else
                                        <a class="ft-plane" href="{{ route('show.all.packages') }}">Travel</a>
                                    @endif
                                    <a class="ft-tea" href="{{ route('destination.detail',$destination->destination) }}">Food</a>
                                </div>
                                <div class="ft-foot">
                                    <span class="ft-offer" style="font-size: 12px;">
                                        @if(!empty($destination->get_packages->min('economy')))
                                            Starting From Rs  {{ $destination->get_packages->min('economy') }} /-
                                        @else
                                            Starting From Rs 4000/-
                                        @endif
                                        {{--Starting From Rs 4000/- --}}
                                    </span>
                                </div>


                            </div>


                        </div>

                    @endforeach
                    @if(!empty($package_types))
                        @foreach($package_types as $package_type)
                            <div class="col-md-3">
                                <div class="ft-item item"><h4> {{ ucfirst(strtolower($package_type->category_name)) }}</h4>
                                    <span class="ft-image" >
                                                 <a href="{{ route('user.category.packages.show',$package_type->slug) }}">
                                                    <img src="{{ asset ('storage/'.$package_type->image) }}"  alt="No image" class="img-responsive" /></a>
											</span>
                                    <div class="ft-data">
                                        <a class="ft-hotel" href="{{ route('show.all.hotels') }}">Hotel</a>
                                        <a class="ft-plane" href="{{ route('show.all.packages') }}">Travel</a>
                                        <a class="ft-tea" href="{{ route('destinations.show') }}">Food</a>
                                    </div>
                                    <div class="ft-foot">
                                        <span class="ft-offer" style="font-size: 12px;">
                                           @if(!empty($package_type->all_packages->min('economy')))
                                                Starting From Rs  {{ $package_type->all_packages->min('economy') }} /-
                                            @else
                                                Starting From Rs 4000/-
                                            @endif
                                        </span>
                                    </div>


                                </div>


                            </div>

                        @endforeach
                    @endif




                </div>
            </div><h2 class="ft-heading">International Packages</h2>



            <div class="col-md-12" id="OUTBOUNDCATEGORIES">
                <div class="row">

                    @foreach($outbound_location as $outbound_locations)
                        <div class="col-md-3">


                            <div class="ft-item item" ><h4> {{$outbound_locations->location}}</h4>
                                <span class="ft-image" >
                                            <a href="{{route('user.location.destinations.show',$outbound_locations->slug)}}"><img src="{{ asset ('storage/'.$outbound_locations->image) }}" alt="featured Scroller" /></a>
											</span>
                                <div class="ft-data">
                                    <a class="ft-hotel" href="{{ route('show.all.hotels') }}">Hotel</a>
                                    <a class="ft-plane" href="{{ route('show.all.packages') }}">Travel</a>
                                    <a class="ft-tea" href="{{ route('destinations.show') }}">Food</a>
                                </div>
                                <div class="ft-foot">
                                    <span class="ft-offer" style="font-size: 12px;">
                                        @if(!empty($outbound_locations->get_all_packages->min('economy')))
                                            Starting From Rs  {{ $outbound_locations->get_all_packages->min('economy') }} /-
                                        @else
                                            Starting from Rs 10000/-
                                        @endif


                                    </span>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    {{ $outbound_location->links() }}

                </div><br>
            </div>
            {{--@if(count($location))
                            {{ $location->links() }}
            @endif--}}

            {{--OUTBOUND CATEGORIES--}}


            {{--   <h2 class="ft-heading text-upper">INTERNATIONAL TOUR PACKAGES</h2>



               <div class="col-md-12" id="OUTBOUNDCATEGORIES">

                   <ul class="slides">
                       <li>

                           <div class="row">

                               @foreach($outbound_location as $outbound_locations)
                                   <div class="col-md-3">


                                       <div class="ft-item" ><h4> {{$outbound_locations->location}}</h4>
                                           <span class="ft-image" >
                                           <a href="{{route('user.location.destinations.show',$outbound_locations->slug)}}"><img src="{{ asset ('storage/'.$outbound_locations->image) }}" alt="featured Scroller" /></a>
                                           </span>
                                           <div class="ft-data">
                                               <a class="ft-hotel text-upper" href="#">Hotel</a>
                                               <a class="ft-plane text-upper" href="#">Travel</a>
                                               <a class="ft-tea text-upper" href="#">Break Fast</a>
                                           </div>
                                           <div class="ft-foot">

                                               <span class="ft-offer text-upper">Starting From 10000 Rs/- </span>
                                           </div>
                                       </div>
                                   </div>

                               @endforeach
                               {{ $outbound_location->links() }}
                           </div>

                       </li>
                   </ul>

               </div>--}}

        </div>
    </div>
    <!-- END .main-contents -->

    <!-- START .main-contents .bom-contents -->
    <div class="main-contents bom-contents back_div">
        <div class="container">
            <h2 class="text-center  color_div2" style="font-size: 25px">Reviews of the day</h2>
            <p class="headline text-center color_div" style="font-size: 20px">Selected reviews from thousands of our satisfied customers.</p><br><br>
            <div class="col-md-12">
                <div class="col-md-4 color_div align_div"><h4 class="color_div2" style="font-size: 15px ;text-transform: uppercase"> {{ $package_reviews[0]->get_package['package_name']  }} </h4>
                    " {{ $package_reviews[0]->review }} "
                    <br>
                    <span class="color_div2" style="margin-right: 102px"></span> -by {{ $package_reviews[0]->user_name }}

                </div>

                <div class="col-md-4 color_div align_div"><h4 class="color_div2" style="font-size: 15px ;text-transform: uppercase">{{ $hotel_reviews[0]->get_hotel['hotel_name']  }}</h4>
                    " {{ $hotel_reviews[0]->review }} "
                    <br>
                    <span class="color_div2" style="margin-right: 102px"></span> -by {{ $hotel_reviews[0]->user_name }}
                </div>


                <div class="col-md-4 color_div align_div"><h4 style="font-size: 15px ;text-transform: uppercase" class="color_div2">{{ $destination_reviews[0]->get_destination['destination'] }} </h4>
                    " {{ $destination_reviews[0]->review }} "
                    <br>
                    <span class="color_div2" style="margin-right: 102px"></span> -by {{ $destination_reviews[0]->user_name }}
                </div>
                {{-- <div class="">
                     <ul class="slides">

                         @if(!empty($package_reviews))
                         @foreach($package_reviews as $package_review)

                             <li onclick="{{route('userpackage.show',$package_review->get_package['slug'])}}">
                             --}}{{-- <a href="{{route('user.location.destinations.show',$locations->location)}}">
                                     <img class="img-rounded" style="width: 100px;height:100px;" src="{{ asset('storage/'.$locations->image) }}" alt="No image" />{{ $locations->location }}
                                 </a>--}}{{--

                                     <img src="{{ asset('storage/'.$package_review->get_package['image']) }}" alt="Featured Destination" />

                                 <a href="{{route('userpackage.show',$package_review->get_package['slug'])}}"><h4 class="text-center" style="color: black">{{ $package_review->get_package['package_name']  }}( package )</h4></a>
                                 <h5 class="text-center">@if($package_review->user_name){{ $package_review->user_name  }} @else User @endif</h5>
                                     <p class="text-center">@if($package_review->review) {{ $package_review->review }} @else No reviews @endif</p>
                                     <p class="text-center"><i class="fa fa-star"></i>  @for ($i=1; $i <= $package_review->rating ; $i++)

                                         <span class="fa fa-star fa-fw{{ ($i <= $package_review->rating) ? '' : '-empty'}}"></span>
                                     @endfor
                                     </p>

                             </li>

                         @endforeach
                         @endif

                       @if(!empty($hotel_reviews))

                         @foreach($hotel_reviews as $hotel_review)

                             <li>
                                 --}}{{--<a href="{{route('user.location.destinations.show',$locations->location)}}">
                                     <img class="img-rounded" style="width: 100px;height:100px;" src="{{ asset('storage/'.$locations->image) }}" alt="No image" />{{ $locations->location }}
                                 </a>--}}{{--
                                 <a href="{{ route('hotels.list',$hotel_review->get_hotel['slug']) }}">
                                 <img    src="{{ asset('storage/'.$hotel_review->get_hotel['image']) }}" alt="Featured Destination" /></a>
                                 <a href="{{ route('hotels.list',$hotel_review->get_hotel['slug']) }}">
                                     <h4 class="text-center" style="color: black">{{ $hotel_review->get_hotel['hotel_name']  }}( hotel )</h4></a>
                                     <h5 class="text-center">@if($hotel_review->user_name){{ $hotel_review->user_name  }} @else User @endif</h5>
                                     <p class="text-center">@if($hotel_review->review) {{ $hotel_review->review }} @else No reviews @endif</p>
                                     <p class="text-center"><i class="fa fa-star"></i>  @for ($i=1; $i <= $hotel_review->rating ; $i++)

                                         <span class="fa fa-star fa-fw{{ ($i <= $hotel_review->rating) ? '' : '-empty'}}"></span>
                                     @endfor
                                     </p>

                             </li>
                         @endforeach
                         @endif

                             @if(!empty($destination_reviews))

                           @foreach($destination_reviews as $destination_review)

                             <li>

                                 <a href="{{ route('destination.detail',$destination_review->get_destination->slug) }}">
                                 <img src="{{ asset('storage/'.$destination_review->get_destination->image) }}" alt="no destination" /></a>
                                 <a href="{{ route('destination.detail',$destination_review->get_destination['slug']) }}">
                                     <h4 class="text-center" style="color: black">{{ $destination_review->get_destination['destination']  }}( destination )</h4></a>
                                     <h5 class="text-center">@if($destination_review->user_name){{ $destination_review->user_name  }} @else User @endif</h5>
                                     <p class="text-center">@if($destination_review->review) {{ $destination_review->review }} @else No reviews @endif</p>
                                     <p class="text-center"><i class="fa fa-star"></i>  @for ($i=1; $i <= $destination_review->rating ; $i++)

                                         <span class="fa fa-star fa-fw{{ ($i <= $destination_review->rating) ? '' : '-empty'}}"></span>
                                     @endfor
                                     </p>

                             </li>

                         @endforeach
                         @endif
                     </ul>
                 </div>--}}
            </div>
            {{--  <div class="col-md-12">
                      <div  class="">
                          <ul class="slides">

                              @if(!empty($package_reviews))

                              @foreach($package_reviews as $package_review)

                                  <li onclick="{{route('userpackage.show',$package_review->get_package['slug'])}}">
                                          <img src="{{ asset('storage/'.$package_review->get_package['image']) }}" alt="Featured Destination" />
                                      <a href="{{route('userpackage.show',$package_review->get_package['slug'])}}"><h4 class="text-center" style="color: black">{{ $package_review->get_package['package_name']  }} </h4></a>
                                      <h5 class="text-center">@if($package_review->user_name){{ $package_review->user_name  }} @else User @endif</h5>
                                          <p class="text-center">@if($package_review->review) {{ $package_review->review }} @else No reviews @endif</p>
                                          <p class="text-center"><i class="fa fa-star"></i>  @for ($i=1; $i <= $package_review->rating ; $i++)

                                              <span class="fa fa-star fa-fw{{ ($i <= $package_review->rating) ? '' : '-empty'}}"></span>
                                          @endfor
                                          </p>

                                  </li>

                              @endforeach
                              @endif
                          </ul>
                      </div>
                  </div>--}}

        </div>
        {{-- <div class="container">
             <h2 class="text-center text-upper">Reviews of the day</h2>
             <p class="headline text-center">A piece of heaven in the summer of 2018 brought ten small art houses enlivn the street scene in Tracy Arm FJord</p>

             <div class="row">
                 <!-- START featured destination 1 -->
               <div id="carousel" class="flexslider">
                   <ul class="slides">
                    <section class="col-md-3 fd-column">
                        <div class="featured-dest">
                             <span class="fd-image">
                                 <img class="img-circle" src="user/img/featured-image-1.jpg" alt="Featured Destination" />
                             </span>
                         <h3 class="text-center text-upper">Beach</h3>
                         <p class="text-center">The beach is not only known as a place to relax ,but as a place of beauty. Many of times you see artist portraying the beach with their paintings, or by singing about its magnificence and its splendor.</p>
                     </div>
                 </section>
                 <!-- END featured destination 1 -->

                 <!-- START featured destination 2 -->
                 <section class="col-md-3 fd-column">
                     <div class="featured-dest">
                             <span class="fd-image">
                                 <img class="img-circle" src="user/img/featured-image-2.jpg" alt="Featured Destination" />
                             </span>
                         <h3 class="text-center text-upper">Romantic</h3>
                         <p class="text-center">If you say that someone has a romantic view or idea of something, you are critical of them because their view of it is unrealistic and they think that thing is better or more exciting than it really is..</p>
                         --}}{{--
                                                 <span class="btn-center"><a class="btn btn-primary text-upper" href="#" title="Search">Search</a></span>
                         --}}{{--
                     </div>
                 </section>
                 <!-- END featured destination 2 -->

                 <!-- START featured destination 3 -->
                 <section class="col-md-3 fd-column">
                     <div class="featured-dest">
                             <span class="fd-image">
                                 <img class="img-circle" src="user/img/featured-image-3.jpg" alt="Featured Destination" />
                             </span>
                         <h3 class="text-center text-upper">Amazing</h3>
                         <p class="text-center"> As Minute Earth rightly points out, we could avoid a lot of flesh wounds by having thicker armored skin like a pangolin.  The most ardent lover of curiosities doesn't know everything about our world </p>
                         --}}{{--
                                                 <span class="btn-center"><a class="btn btn-primary text-upper" href="#" title="Search">Search</a></span>
                         --}}{{--
                     </div>
                 </section>
                 <!-- END featured destination 3 -->

                 <!-- START featured destination 4 -->
                 <section class="col-md-3 fd-column">
                     <div class="featured-dest">
                             <span class="fd-image">
                                 <img class="img-circle" src="user/img/featured-image-4.jpg" alt="Featured Destination" />
                             </span>
                         <h3 class="text-center text-upper">Fun</h3>
                         <p class="text-center">How to Have a Fun Life. Everyone wants to enjoy life more, and oftentimes the key to enjoyment is fun. Having a fun life is about more than doing fun things and having adventures.</p>
                         --}}{{--
                                                 <span class="btn-center"><a class="btn btn-primary text-upper" href="#" title="Search">Search</a></span>
                         --}}{{--
                     </div>
                 </section><section class="col-md-3 fd-column">
                     <div class="featured-dest">
                             <span class="fd-image">
                                 <img class="img-circle" src="user/img/featured-image-4.jpg" alt="Featured Destination" />
                             </span>
                         <h3 class="text-center text-upper">Fun</h3>
                         <p class="text-center">How to Have a Fun Life. Everyone wants to enjoy life more, and oftentimes the key to enjoyment is fun. Having a fun life is about more than doing fun things and having adventures.</p>
                         --}}{{--
                                                 <span class="btn-center"><a class="btn btn-primary text-upper" href="#" title="Search">Search</a></span>
                         --}}{{--
                     </div>
                 </section>
                 <!-- END featured destination 4 -->
                   </ul>
                 </div>
             </div>
         </div>--}}
    </div>

</div>

</div>
<footer>
    <div id="ft-footer" style="color: white;">
        <div class="footer-overlay">
            <div class="container">
                <div class="row">
                    <nav class="col-md-12">
                        <ul class="footer-menu">
                            <li><a style="color: white;" href="{{  route('faq') }}">Faq</a></li>
                            <li><a  style="color: white;" href="{{  route('terms') }}">Terms of Service</a></li>
                            <li><a  style="color: white;" href="{{  route('howitworks') }}">How it works</a></li>
                            <li class="last-item"><a  style="color: white;" href="{{  route('privacy') }}">Privacy Policy</a></li>
                        </ul>
                    </nav>

                    <div class="foot-boxs">
                        <div class="foot-box col-md-4 text-right">
                            <span>Stay Connected</span>
                            <ul class="social-media footer-social">
                                <li><a  style="color: white;" class="sm" href="https://www.youtube.com/channel/UCztAe7m9T87dvXoN8hzQqPw"><i class="fa fa-youtube"></i><span>Youtube</span></a></li>
                                <li><a  style="color: white;" class="sm" href="https://twitter.com/z_tripa"><i class="fa fa-twitter"></i><span>Twitter</span></a></li>
                                <li><a  style="color: white;" class="sm" href="https://in.pinterest.com/gotripaz/"><i class="fa fa-pinterest"></i><span>Pinterest</span></a></li>
                                <li><a  style="color: white;" class="sm" href="https://www.facebook.com/GoTripaZ.co/"><i class="fa fa-facebook"></i><span>Facebook</span></a></li>
<li style="padding: 2px;"><a style="color:white;" class="sm" href="https://www.instagram.com/gotripaz/?hl=en"><i class="fa fa-instagram"></i><span>Facebook</span></a></li>


                                {{--
                                <li><a class="sm-yahoo" href="#"><span>Yahoo</span></a></li>
--}}
                                {{--<li><a class="sm-rss" href="#"><span>RSS</span></a></li>
                                <li><a class="sm-flickr" href="#"><span>Flicker</span></a></li>
                                <li><a class="sm-windows" href="#"><span>Windows</span></a></li>
                                <li><a class="sm-stumble" href="#"><span>Stumbleupon</span></a></li>--}}
                            </ul>
                        </div>
                        <div class="foot-box foot-box-md col-md-4">
                            <a style="color: white;" href="mailto:info@gotripaz.com" target="_blank"><span class="contact-email"> info@gotripaz.com</span></a>
                            <a  style="color: white;" href="tel:+919846444455"> <span class="contact-phone"> +91 9846444455</span></a>
                        </div>
                        <div class="foot-box col-md-4">
                            <span class="">&copy; 2018 Gotripaz. All Rights Reserved.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!------------------------------------------ ------------------------------------------------------------------------------>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>  <h2 class="modal-title" id="exampleModalLabel">GET IN TOUCH WITH US</h2></center>
                <center><small>For adding more fun to your journey.....!!!!</small></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" name="myForm" id="myForm">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-form-label">Full Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" pattern="^(([-\w\d]+)(\.[-\w\d]+)*@([-\w\d]+)(\.[-\w\d]+)*(\.([a-zA-Z]{2,5}|[\d]{1,3})){1,2})$" required>

                    </div>

                    <div class="form-group">
                        <label for="number" class="col-form-label">Mobile Number:</label>
                        <input type="text" class="form-control" id="number" name="number" pattern="[0-9]{1}[0-9]{9}" required>
                    </div>


                    <div class="form-group">
                        <label for="special_notes" class="col-form-label">Message:</label>
                        <textarea type="text" name="messege" class="form-control" id="special_notes" rows="6" cols="45"></textarea>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <input type="submit" class="btn btn-primary" value="Send">
                    </div>

                </form>
            </div>

        </div>
    </div>

    <!------------------------------------------ ------------------------------------------------------------------------------>
    <!------------------------------------------ ------------------------------------------------------------------------------>


    <!------------------------------------------ ------------------------------------------------------------------------------>


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('user/js/jquery.bxslider.js')}}"></script>
<script>
    var slider=   $('.slides').bxSlider({
        auto: true,
        autoControls: true,
        stopAutoOnClick: false,
        pager: true,
        speed:1000,
        slideWidth:230,
        controls:true,
        nextSelector:'.bx-next',
        prevSelector:'.bx-prev'
    });

    $('.bx-prev').click(function () {
        var current = slider.getCurrentSlide();
        slider.goToPrevSlide(current) - 1;
    });
    $('.bx-next').click(function () {
        var current = slider.getCurrentSlide();
        slider.goToNextSlide(current) + 1;
    });
</script>

<script type="text/javascript" src="{{asset('user/js/modernizr.custom.17475.js')}}"></script>

<script type="text/javascript" src="{{asset('user/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('user/bs3/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('user/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('user/js/jquery.flexslider-min.js')}}"></script>
<script src="{{asset('user/js/script.js')}}"></script>
<script src="{{asset('user/js/jquery.minimalect.min.js')}}" type="text/javascript"></script>

<script src="{{asset('user/js/styleswitcher.js')}}"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script type="text/javascript" src="{{asset('user/js/rs-plugin/js/jquery.plugins.min.js')}}"></script>
<script type="text/javascript" src="{{asset('user/js/rs-plugin/js/jquery.revolution.min.js')}}"></script>

<!--------------------------------------- INTL---------------------------------------->
<script src="{{ asset('intl/build/js/intlTelInput.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $("#phone").intlTelInput();
    $("#phone").intlTelInput("setCountry", "in");
    var countryDataInitial = $("#phone").intlTelInput("getSelectedCountryData");
    $("#phone").val('+' + countryDataInitial.dialCode);
    $("#phone").on("countrychange", function(e, countryData) {
        $("#phone").val('+' + countryData.dialCode);
    });

</script>
<!--------------------------------------- END INTL---------------------------------------->
<script>
    jQuery(document).ready(function($) {

// site preloader -- also uncomment the div in the header and the css style for #preloader
        $(window).load(function(){
            $('#preloader').fadeOut('slow',function(){$(this).remove();});
        });

    });
</script>
{{--<script src="{{ asset('Bxslider/jquery.js') }}"></script>
<script src="{{ asset('Bxslider/jquery.bxslider.js') }}"></script>
<script>

    $(document).ready(function () {
        $('.bxSlider').bxSlider({
            mode:'horizontal',
            speed : 2000,
            auto : 'true'
        });

    });
</script>--}}
{{--<script type="text/javascript" src="user/js/html5shiv.js"></script>--}}

<script type="text/javascript">
    $(document).ready(function() {
        // revolution slider
        revapi = $("#content-slider").revolution({
            delay: 6000,
            startwidth: 1170,
            startheight: 920,
            hideThumbs: 10,
            fullWidth: "on",
            fullScreen: "off",
            fullScreenOffsetContainer: "",
            navigationVOffset: 320
        });

        // initilize datepicker
        $(".date-picker").datepicker();
    });


    $(window).load(function(){
        $('.carousel').flexslider({
            animation: "fade",
            animationLoop: true,
            controlNav: false,
            maxItems: 4,
            pausePlay: false,
            mousewheel:true,
            start: function(slider){
                $('body').removeClass('loading');
            }
        });
    });
    var show = function(){
        /*  $('#exampleModal').modal('show');*/
        setInterval(call, 12000);
    };

    $(window).load(function(){
        var timer = window.setTimeout(show,5000);
    });
    function call()
    {
        setTimeout(wait, 8000);
    }

</script>
<script>
    $(document).ready(function(){
        $("#adults").minimalect({ theme: "bubble", placeholder: "Select" });
        $("#kids").minimalect({ theme: "bubble", placeholder: "Select" });
    });
</script><!--- SELECT BOX -->

<!-- Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-42761673-1', 'extracoding.com');
    ga('send', 'pageview');
</script>
{{--<script>
    function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    if (reg.test(emailField.value) == false)
    {
        alert('Invalid Email Address');
        return false;
    }



        return true;

    }
</script>--}}
<script>
    function addEvent(node, type, callback) {
        if (node.addEventListener) {
            node.addEventListener(
                type,
                function(e) {
                    callback(e, e.target);
                },
                false
            );
        } else if (node.attachEvent) {
            node.attachEvent("on" + type, function(e) {
                callback(e, e.srcElement);
            });
        }
    }

    //identify whether a field should be validated
    //ie. true if the field is neither readonly nor disabled,
    //and has either "pattern", "required" or "aria-invalid"
    function shouldBeValidated(field) {
        return (
            !(field.getAttribute("readonly") || field.readonly) &&
            !(field.getAttribute("disabled") || field.disabled) &&
            (field.getAttribute("pattern") || field.getAttribute("required"))
        );
    }

    //field testing and validation function
    function instantValidation(field) {
        //if the field should be validated
        if (shouldBeValidated(field)) {
            //the field is invalid if:
            //it's required but the value is empty
            //it has a pattern but the (non-empty) value doesn't pass
            var invalid =
                (field.getAttribute("required") && !field.value) ||
                (field.getAttribute("pattern") &&
                    field.value &&
                    !new RegExp(field.getAttribute("pattern")).test(field.value));

            //add or remove the attribute is indicated by
            //the invalid flag and the current attribute state
            if (!invalid && field.getAttribute("aria-invalid")) {
                field.removeAttribute("aria-invalid");
            } else if (invalid && !field.getAttribute("aria-invalid")) {
                field.setAttribute("aria-invalid", "true");
            }
        }
    }

    //now bind a delegated change event
    //== THIS FAILS IN INTERNET EXPLORER <= 8 ==//
    //addEvent(document, 'change', function(e, target)
    //{
    //  instantValidation(target);
    //});

    //now bind a change event to each applicable for field
    var fields = [
        document.getElementsByTagName("input"),
        document.getElementsByTagName("text")
    ];
    for (var a = fields.length, i = 0; i < a; i++) {
        for (var b = fields[i].length, j = 0; j < b; j++) {
            addEvent(fields[i][j], "change", function(e, target) {
                instantValidation(target);
            });
        }
    }
</script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.0/jquery-ui.js"></script>

{{--
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
--}}



<script>
    $(document).ready(function () {

        $("#start_date").datepicker({
            dateFormat: 'dd-mm-yy',
            minDate: 0,
            onSelect: function (date) {
                var dt2 = $('#end_date');
                var startDate = $(this).datepicker('getDate');
                var minDate = $(this).datepicker('getDate');
                dt2.datepicker('setDate', minDate);
                startDate.setDate(startDate.getDate() + 30);
                //sets dt2 maxDate to the last day of 30 days window
                dt2.datepicker('option', 'maxDate', startDate);
                dt2.datepicker('option', 'minDate', minDate);
                $(this).datepicker('option', 'minDate', minDate);
            }
        });
        $('#end_date').datepicker({
            dateFormat: 'dd-mm-yy'
        });
    });
</script>











<script>
    $( document ).ready(function() {
        $( "#destination" ).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
            }
        });
    });
</script>








<script>
    $(document).ready(function() {
        $("#phone").keydown(function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A, Command+A
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Allow: home, end, left, right, down, up
                (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
                return;
            }
            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
</script>


<script>

    jQuery('#email').keyup(function () {
        var email=this.value;
        //alert(email);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'text',
            type: "POST",
            url: "{{ route('user.check.email.exist') }}",
            data: {email:email},
            success: function (res) {

                if(res)
                {
                    //$('#error').show();
                    // alert("hi");

                }
                else
                {
                    //   return true;
                    // $('#error').show();
                    //alert("hello");

                }
            }
        });
    });
</script>





<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}
        x[myIndex-1].style.display = "block";
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }



</script>
<script>
    {{--var telInput = $("#phone"),--}}
    {{--errorMsg = $("#error-msg"),--}}
    {{--validMsg = $("#valid-msg");--}}

    {{--telInput.intlTelInput({--}}
    {{--defaultCountry: "in",--}}
    {{--hiddenInput: "phone2",--}}
    {{--utilsScript: "{{asset('js/utils.js')}}"--}}
    {{--});--}}

    {{--var reset = function() {--}}
    {{--telInput.removeClass("error");--}}
    {{--errorMsg.addClass("hide");--}}
    {{--validMsg.addClass("hide");--}}
    {{--};--}}

    {{--// on blur: validate--}}
    {{--telInput.blur(function() {--}}
    {{--reset();--}}
    {{--if ($.trim(telInput.val())) {--}}
    {{--if (telInput.intlTelInput("isValidNumber")) {--}}
    {{--validMsg.removeClass("hide");--}}
    {{--} else {--}}
    {{--telInput.addClass("error");--}}
    {{--errorMsg.removeClass("hide");--}}
    {{--}--}}
    {{--}--}}
    {{--});--}}

    {{--// on keyup / change flag: reset--}}
    {{--telInput.on("keyup change", reset);--}}


</script>

<script src="{{ asset('user/js/jquery.flexslider-min.js')}}"></script>
<script type="text/javascript" src="{{ asset('user/js/rs-plugin/js/jquery.plugins.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('user/js/rs-plugin/js/jquery.revolution.min.js')}}"></script>

{{--
<script type="text/javascript">
    $(window).load(function() {
        // The slider being synced must be initialized first
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: true,
            itemWidth: 185,
            asNavFor: '#slider',
            auto : true
        });

        $('#slider').flexslider({
            animation: "fade",
            controlNav: false,
            animationLoop: false,
            slideshow: true,
            sync: "#carousel",
            auto : true
        });
    });
</script>


--}}





<script>
    $(function(){
        $('#myForm').on('submit', function(e){
            var phone_len=$('#phone').val().length;
            if($('#email').val() =='' || $('#start_date').val() =='' || $('#end_date').val()=='')
            {
                if($('#email').val() =='')
                {
                    $('#Emailerror').show();

                }
                else {
                    $('#Emailerror').hide();

                }
                if($('#start_date').val() =='')
                {
                    $('#StartDateerror').show();

                }
                else {
                    $('#StartDateerror').hide();

                }
                if($('#end_date').val()=='')
                {
                    $('#EndDateerror').show();
                }
                else {
                    $('#EndDateerror').hide();

                }
                if(phone_len <= 5)
                {
                    $('#Numbererror').show();
                }
                else
                {
                    $('#Numbererror').hide();
                }
                e.preventDefault();


            }
            else if(phone_len <= 5)
            {
                if(phone_len <= 5)
                {
                    $('#Numbererror').show();
                    e.preventDefault();
                }
                else
                {
                    $('#Numbererror').hide();
                }
                if($('#email').val() =='')
                {
                    $('#Emailerror').show();

                }
                else {
                    $('#Emailerror').hide();

                }
                if($('#start_date').val() =='')
                {
                    $('#StartDateerror').show();

                }
                else {
                    $('#StartDateerror').hide();

                }
                if($('#end_date').val()=='')
                {
                    $('#EndDateerror').show();
                }
                else {
                    $('#EndDateerror').hide();

                }



            }

            else {
                $('#Numbererror').hide();
                $('#Emailerror').hide();
                $('#StartDateerror').hide();
                $('#EndDateerror').hide();


                /*   $.ajax({
                        url: '{{ route('user.enquiry') }}',
                    type: 'POST',
                    data: $('#myForm').serialize(),
                    success: function(data){
                        if(data==true)
                        {
                            $('#exampleModal').modal('hide');
                            //$('#SuccessModal').modal('show');
                            alert("Thank You..!!! Your Message Sent Successfully..!!!! We will Contact You Soon..");

                        }

                    }
                });*/


            }

        });
    });


    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            ajax: {
                url: '{{ route('autocomplete.destination') }}',
                data: function (params) {
                    var query = {
                        destination: params.term,

                    }
                    return query;
                }
            }
        });
    });


</script>

<script>
    $('.main-nav > span').click(function() {
        $(this).next('#main-menu').slideToggle();
    });

    $('#search').on('input', function() {
        var search=$(this).val();
        //alert(search);
        $.ajax(
            {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'text',
                type: "POST",
                url: "{{ route('search.by.all') }}",
                data: {search:search},
                success: function (res) {

                    // $("#results").html(res);
                    // var obj = jQuery.parseJSON(res);
                    $('#results').empty();
                    var data=res;
                    $('#results').append(data);


                }



            });

    });

</script>

<script>
    $('.search_div').on('input', function() {

        var val = this.value;
        var xyz = $('#results option').filter(function() {
            return this.value == val;
        }).data('url');
        if(xyz!=null)
        {
            window.location.href = xyz;
        }

    });

</script>

<script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5b98a1b5c666d426648aae4c/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
</script>

<script>

    telNum = $("#phone");
    telNum.intlTelInput({
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        utilsScript: "js/utils.js",
        nationalMode: true,
        autoPlaceholder: "aggressive",
        placeholderNumberType: "MOBILE",
        customPlaceholder: function(selectedCountryPlaceholder) {
            return "Mobile Number e.g. " + selectedCountryPlaceholder;
        },
        preferredCountries: ['au', 'us', 'gb']
    });
    $("#form").validator({
        custom: {
            mobile: function($el){
                return isValidNumber("#phone");
            }
        },
        errors: {
            mobile: "Please provide a valid mobile number."
        }
    }).on('submit', function(e){
        $("#phone").val($("#phone").intlTelInput("getNumber"));
    });

    function isValidNumber(num){
        telNum = $(num);
        if(telNum.intlTelInput('isValidNumber') && telNum.intlTelInput('getNumberType') == (intlTelInputUtils.numberType.MOBILE || intlTelInputUtils.numberType.FIXED_LINE_OR_MOBILE)){
            return false;
        } else {
            return "Please provide a valid mobile number.";
        }
    }
</script>

{{--<script>--}}

{{--$(document).ready(function () {--}}

{{--$("#phone").intlTelInput({--}}
{{--autoPlaceholder: false,--}}
{{--defaultCountry: "it",--}}
{{--preferredCountries: ['it'],--}}
{{--utilsScript: "https://img.infocert.it/js/libphonenumber.js"--}}
{{--});--}}

{{--var telInput = $("#phone"),--}}
{{--errorMsg = $("#error-msg"),--}}
{{--validMsg = $("#valid-msg");--}}

{{--// on blur: validate--}}
{{--telInput.focusout(function () {--}}
{{--if ($.trim(telInput.val())) {--}}
{{--if (telInput.intlTelInput("isValidNumber")) {--}}
{{--validMsg.removeClass("hide");--}}
{{--} else {--}}
{{--telInput.addClass("error");--}}
{{--errorMsg.removeClass("hide");--}}
{{--validMsg.addClass("hide");--}}
{{--}--}}
{{--}--}}
{{--var numberType = $("#phone").intlTelInput("getNumberType");--}}
{{--if (numberType == intlTelInputUtils.numberType.MOBILE) {--}}
{{--// is a mobile number--}}
{{--$("#phone").attr('name', 'number');--}}
{{--} else {--}}
{{--$("#phone").attr('name', 'number');--}}
{{--}--}}
{{--});--}}

{{--// on keydown: reset--}}
{{--telInput.keydown(function () {--}}
{{--telInput.removeClass("error");--}}
{{--errorMsg.addClass("hide");--}}
{{--validMsg.addClass("hide");--}}
{{--});--}}
{{--$("#text_message").focusout(function () {--}}
{{--$("#00Nw00000088clXEAQ").val($("#text_message").val())--}}
{{--})--}}

{{--jQuery.validator.addMethod('validatePhone', function () {--}}
{{--if ($("#phone").intlTelInput("isValidNumber")) {--}}
{{--return true;--}}
{{--} else {--}}
{{--return false;--}}
{{--}--}}
{{--}, "Phone Number Required");--}}


{{--$("#myForm").validate({--}}
{{--errorElement: 'small',--}}
{{--errorClass: 'help-block',--}}
{{--errorPlacement: function (error, element) {--}}
{{--if (element.attr("name") == "aut_privacy") {--}}
{{--error.insertBefore(element.parent());--}}
{{--} else {--}}
{{--error.insertAfter(element);--}}
{{--}--}}
{{--},--}}
{{--rules: {--}}
{{--destination: {--}}
{{--required: true,--}}
{{--},--}}
{{--email: {--}}
{{--required: true,--}}
{{--email: true--}}
{{--},--}}
{{--start_date: {--}}
{{--required: true--}}
{{--},--}}
{{--end_date: {--}}
{{--required: true--}}
{{--},--}}
{{--phone: {--}}
{{--required: true,--}}
{{--},--}}
{{--},--}}
{{--messages: {--}}
{{--destination: {--}}
{{--required: "Destination Required",--}}
{{--},--}}
{{--email: {--}}
{{--required: "Email Required",--}}
{{--},--}}
{{--start_date: {--}}
{{--required: "Start Date Required",--}}
{{--},--}}
{{--end_date: {--}}
{{--required: "End Date Required",--}}
{{--},--}}
{{--phone: "Phone Number Required",--}}
{{--},--}}
{{--highlight: function (element) {--}}

{{--$(element).closest('.form-group').removeClass('has-success').addClass('has-error');--}}
{{--$(element).siblings().filter('.glyphicons').removeClass('ok_2').addClass('remove_2');--}}

{{--},--}}
{{--unhighlight: function (element) {--}}
{{--$(element).closest('.form-group').removeClass('has-error').addClass('has-success');--}}
{{--$(element).siblings().filter('.glyphicons').removeClass('remove_2').addClass('ok_2');--}}

{{--}--}}
{{--});--}}

{{--$('#submit').click(function () {--}}
{{--if ($("#myForm").valid() && $('#phone').val().length != 0 && $("#phone").intlTelInput("isValidNumber")) {--}}
{{--alert('$("#myForm").submit()')--}}
{{--} else {--}}
{{--alert("Please Fill out the fields");--}}
{{--return false;--}}
{{--}--}}
{{--});--}}

{{--});--}}
{{--</script>--}}
<link rel="stylesheet" href="{{ asset('user/js/my_validation.min.js') }}">

<script>
    var input = document.querySelector("input"),
        form = document.querySelector("form"),
        result = document.querySelector("#result");

    var iti = intlTelInput(input, {
        initialCountry: "us"
    });

    form.addEventListener("submit", function(e) {
        e.preventDefault();
        var num = iti.getNumber(),
            valid = iti.isValidNumber();
        result.textContent = "Number: " + num + ", valid: " + valid;
    }, false);

    input.addEventListener("focus", function() {
        result.textContent = "";
    }, false);
</script>



{{--<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\EnquiryRequest', '#myForm'); !!}--}}


<script src="{{ asset('user/animation/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{ asset('user/animation/js/jquery.themepunch.revolution.min.js')}}"></script>

<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery('.sliderClass').show().revolution({
            dottedOverlay: "none",
            delay: 9000,
            startwidth: 1700,
            startheight: 950,
            hideThumbs: 200,
            thumbWidth: 100,
            thumbHeight: 50,
            thumbAmount: 4,
            simplifyAll: "off",
            navigationType: "bullet",
            navigationArrows: "solo",
            navigationStyle: "preview4",
            touchenabled: "on",
            onHoverStop: "off",
            nextSlideOnWindowFocus: "off",
            swipe_threshold: 0.7,
            swipe_min_touches: 1,
            drag_block_vertical: false,
            keyboardNavigation: "off",
            navigationHAlign: "center",
            navigationVAlign: "bottom",
            navigationHOffset: 0,
            navigationVOffset: 20,
            soloArrowLeftHalign: "left",
            soloArrowLeftValign: "center",
            soloArrowLeftHOffset: 20,
            soloArrowLeftVOffset: 0,
            soloArrowRightHalign: "right",
            soloArrowRightValign: "center",
            soloArrowRightHOffset: 20,
            soloArrowRightVOffset: 0,
            shadow: 0,
            fullWidth: "off",
            fullScreen: "off",
            spinner: "spinner0",
            stopLoop: "off",
            stopAfterLoops: -1,
            stopAtSlide: -1,
            shuffle: "off",
            forceFullWidth: "off",
            fullScreenAlignForce: "off",
            minFullScreenHeight: "400",
            hideThumbsOnMobile: "off",
            hideNavDelayOnMobile: 1500,
            hideBulletsOnMobile: "off",
            hideArrowsOnMobile: "off",
            hideThumbsUnderResolution: 0,
            fullScreenOffsetContainer: ".header",
            fullScreenOffset: "",
            hideSliderAtLimit: 0,
            hideCaptionAtLimit: 0,
            hideAllCaptionAtLilmit: 0,
            startWithSlide: 0
        });
    });
    $('.worked-slider').bxSlider({
        mode: 'horizontal',
        slideMargin: 5,
        nextText: '',
        prevText: '',
        autoPlay: true,
        speed: 1000
    });
    $('.sliding').bxSlider({
        mode: 'horizontal',
        auto: true,
        autoPlay: true,
        speed: 2000
    });
    if ($('.animated').length) {
        var $ = jQuery;

        $('.animated').appear(function () {
            var element = $(this);
            var animation = element.data('animation');
            var animationDelay = element.data('delay');
            if (animationDelay) {
                setTimeout(function () {
                    element.addClass(animation + " in");
                    element.removeClass('out');
                }, animationDelay);
            }
            else {
                element.addClass(animation + " in");
                element.removeClass('out');
            }

        }, {accY: -150});

    } /*ready*/
</script>

</body>
</html>
