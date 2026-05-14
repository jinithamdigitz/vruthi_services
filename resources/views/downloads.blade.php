 @extends('layouts.main')


@section('content') 

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
                                        <li><a href="{{route('home.gallery')}}">gallery</a></li>
                                        <li><a href="{{route('home.downloads')}}" class="active">downloads</a></li>
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
                <h1>DOWNLOADS</h1>
                <ul>
                    <li>HOME / <a href="">DOWNLOADS</a></li>
                </ul>
            </div>
            </div>
       
        </div>
    </header>
	   <!--DOWNLOAD SECTION HERE-->
<section data-scrollreveal="enter top over 3s after 0.5s">
    <div class="custome-fluid downloads">


        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                <div id="accordion">
                    <div class="card">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Forms
                          </button>
                        </h5>
                      </div>
                  @foreach($documents as $value)
                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          <a href="{{ asset('uploads/' . $value->image) }}" target="blank"><img src="images/arrow.png" alt="">{{$value->title}}<img src="images/download.png" alt=""></a>
                        </div>
                      </div>
					@endforeach  
                     
                  </div>
               </div>
               
              

                <div class="down-sect">
                  <span>In case of PPS You can send manually filled forms to <a href="mailto:ho@mscub.com">ho@mscub.com</a> </span>
                  </div>
               </div>
       

    </section>