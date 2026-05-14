 
   @extends('layouts.main')


@section('content')
   <!--HEADER SECTION HERE-->
   
 





    <header>
        <div class="container-fluid no-padding" data-scrollreveal="enter top over 3s after 0.5s">


            <div class="banner-menu">
                <div class="row">
                    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-2">
                                <a href="index.html" class="hvr-grow"><img src="{{ asset('uploads/' . $logo->image) }}" alt="mscbank-mattanchery"></a>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 logo">
                                <h1>THE Mattancherry<br>
                                    SARVAJANIK CO-OPERATIVE BANK LTD</h1>
                                <h2>(RBI licensed Urban Bank) </h2>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 logo">
                                <a href="https://www.dicgc.org.in/" target="_blank" class="hvr-grow"><img src="images/digg.png" alt="DICGC approved urban bank kerala"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 call-to">

                        <div class="row">
                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                <a href="https://mscub.com/ppsform/"><b>POSITIVE PAY SYSTEM (PPS)</b></a>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
                                <h3>Email:</h3> 
                                <a href="mailto:{{$email->title}}?subject=Mail from MSC Site">{{$email->title}}</a>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <h3>Phone:</h3> <a href="tel:{{$phone->phone1}}">{{$phone->phone1}}</a>, <a
                                    href="tel:{{$phone->phone2}}">{{$phone->phone2}}</a>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                <nav class="mobile-menu">
                                    <label for="show-menu" class="show-menu"><span>Menu</span>
                                        <div class="lines"></div>
                                    </label>
                                    <input type="checkbox" id="show-menu">
                                    <ul id="menu">
                                        <li><a href="{{route('home.index')}}" >Home</a></li>
                                        <li><a href="{{route('home.about')}}">About</a></li>
                                        <li><a href="{{route('home.management')}}">Management</a></li>
                                        <li><a href="{{route('home.facilities')}}">facilities</a></li>
                                        <li><a href="{{route('home.gallery')}}" class="active">gallery</a></li>
                                        <li><a href="{{route('home.downloads')}}">downloads</a></li>
                                        <li><a href="{{route('home.contact')}}">contact</a></li>
                                    </ul>
                                </nav>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            <div class="inner-banner" data-scrollreveal="enter top over 3s after 0.5s">
                <img src="images/inner-banner.jpg" alt="mattanchery sarvajanik">
                <div class="inner-banner-hea">
                <h1>MANAGEMENT
</h1>
                <ul>
                    <li>HOME / <a href="">MANAGEMENT
</a></li>
                </ul>
            </div>
            </div>
       
        </div>
    </header>
    <!--SECTION HERE-->
    <section>
    <div class="custome-fluid management-wrap">
        <div class="row">
        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12" data-scrollreveal="enter top over 3s after 0.5s">
    <h1>from the<br> <span>chairman's</span> desk</h1>
    <h2>{{ $chairman->title }}</h2>
</div>

<div class="col-xl-2 col-lg-12 col-md-12 col-sm-12" data-scrollreveal="enter top over 3s after 0.5s">
    <img src="{{ asset('uploads/' . $chairman->image) }}" alt="">
</div>

<div class="col-xl-7 col-lg-12 col-md-12 col-sm-12" data-scrollreveal="enter top over 3s after 0.5s">
    {!! $chairmansdesk->description !!}
</div>
</div>

  <!-- Team section -->
  <div class="management-wrap" data-scrollreveal="enter top over 3s after 0.5s">
  <ul class="projects-base nav nav-tabs md-tabs" id="myTabEx" role="tablist">
    <li class="nav-item">
        <a class="nav-link active show" id="home-tab-ex" data-toggle="tab" href="#home-ex" role="tab" aria-controls="home-ex" aria-selected="true"> <i class="fas fa-arrow-circle-o-right"></i>Board of Directors</a>
    </li>
   <li class="nav-item">
        <a class="nav-link" id="profile-tab-ex" data-toggle="tab" href="#profile-ex" role="tab" aria-controls="profile-ex" aria-selected="false">Board of Management</a>
    </li>
 </ul>
<div class="tab-content pt-5 tm" id="myTabContentEx">

    <div class="tab-pane fade active show" id="home-ex" role="tabpanel" aria-labelledby="home-tab-ex">
        <div class="projects-list">
            <div class="row">
     
            @foreach ($boardofdirectors as $key => $item)
                <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 ">
                    <div class="box17">
                        <img src="{{ asset('uploads/' . $item->image) }}" alt="logo" />
                    </div>
                    <div class="projects-list-stripe">
                        <h6>{{ $item->title }}</h6>
                        <h5>{{ $item->job_title }}</h5>
                    </div>
                </div>
                @endforeach      
                
                


            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="profile-ex" role="tabpanel" aria-labelledby="profile-tab-ex">
        <div class="projects-list">
            <div class="row">


            @foreach ($boardofmanagement as $key => $item)
                <div class="col-sm-6 col-md-6 col-lg-2 col-xl-2 ">
                    <div class="box17">
                        <img src="{{ asset('uploads/' . $item->image) }}" alt="logo" />
                    </div>
                    <div class="projects-list-stripe">
                        <h6>{{ $item->title }}</h6>
                        <h5>{{ $item->job_title }}</h5>
                    </div>
                </div>
                @endforeach    

                


            </div>

        </div>
    </div>

</div>
</div>

</section>
    <!--MANAGEMENT SECTION HERE-->
 
@endsection