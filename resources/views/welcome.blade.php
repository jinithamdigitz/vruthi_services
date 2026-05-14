
 @include('includes.header')

<?php
 $news = App\Http\Controllers\HomeController::getnews();
$servername= request()->getHttpHost();
$whatsapp_number = App\Http\Controllers\HomeController::getwhatsappnumber();
$call_number = App\Http\Controllers\HomeController::getcallnumber();
$call= 'http://'.$servername.'/public/uploads/dock-phone-pictures-26.png';
 $phone1 = App\Http\Controllers\HomeController::getphone1();
//print_r($bestseller);exit;
?>
<div class="th-hero-wrapper hero-2" id="hero">
        <div class="hero-slider-2 th-carousel" id="heroSlide2" data-slide-show="1" data-md-slide-show="1" data-fade="true">
            <div class="th-hero-slide">
                <div class="th-hero-bg"><div class="top-block__overlay"></div><div class="top-block__video-bg"><video autoplay="" muted="" loop="" id="customBg" playsinline="" controlslist="nodownload nofullscreen" disablepictureinpicture="" data-autoplay=""> <source src="public/uploads/bannervideo.mp4" type="video/mp4"> Your browser doesn't support HTML5 video tag.</video></div></div>
                
                <div class="container th-container">
                    <div class="hero-style2">
                        <h1 class="hero-title text-white" data-ani="slideindown" data-ani-delay="0.1s">   Innovative Technology for <span class="text-theme">secure</span> banking Solutions  </h1>
                        <p class="hero-text" data-ani="slideinup" data-ani-delay="0.1s">Apex International Trading Company was established in 2006 and is one of the leading distributors of card personalization machines, EMV cards, banking and financial equipment, high security documents and other banking supplies in Kuwait</p>
                        <div class="btn-group" data-ani="slideinup" data-ani-delay="0.5s"><a href="services.html" class="th-btn style3">Our Services<i class="fas fa-long-arrow-right ms-2"></i></a> </div>
                    </div>
                </div>
            </div>
           
        </div>
        
    </div>


    <div class="space  wow fadeInLeft" data-wow-delay="0.3s " id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-xl-6 ">
                    <div class="img-box9"><img src="public/uploads/{{ $abouts->image}}" alt="About">
                        <div class="shape"><img src="public/uploads/about_shape_1.jpg" alt="shape"></div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-6 ps-3 ps-xl-5 ">
                    <div class="title-area mb-30"><span class="sub-title6">ABOUT US <span class="shape right"><span class="dots"></span></span>
                        </span>
						
                        <h2 class="sec-title">{{ $abouts->title}}</h2></div>
                    <p class="mt-n2 mb-4">{{ $abouts->description}}.
                    </p>
                  
                   
                    <div class="about-bg-shape">
                        <div class="shape"><img src="public/uploads/bg_pattern_4.png" alt="bg"></div>
                        <div class="arrow-list-wrap">
                           
                            <div class="arrow-list two">
                                <ul>
                                    <li> Payment Cards Solutions
                                    <ul>
                                      <li><a href="pvc-payment-cards.html">IDEMIA PVC Payment Card</a></li>
                                      <li><a href="greenpay.html">IDEMIA Greenpay-Recycled Plastic Payment Card</a></li>
                                      <li><a href="advanced-payment-cards.html">IDEMIA Advanced Payment Cards</a></li>
                                      <li><a href="dual-chip-payment.html">Dual Chip Payment Cards</a></li>
                                      <li><a href="metal.html">IDEMIA Metal Cards</a></li>
                                    </ul>
                                  </li>
                                    <li> Secure Transactions
                                      <ul>
                                        <li><a href="idemia-card-connect.html">IDEMIA Card Connect</a></li>
                                        <li><a href="smart-issuance.html">Smart Issuance</a></li>
                                      </ul>
                                      </li>
                                    <li> Card Personalization Solutions 
                                      <ul>
                                        <li><a href="cps-solutions.html">CPS Solution</a></li>
                                        <li><a href="smartone-solutions.html">SmartOne Solution</a></li>
                                        <li><a href="card-personalization-mechines.html">Card Personalization Machines</a></li>
                                      </ul>
                                    
                                    </li>
                                </ul>
                            </div>
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="space overflow-hidden" id="service" style=" background: #fff9ee;">
        <div class="container">
            <div class="title-area text-center"><span class="sub-title6 justify-content-center"><span class="shape left"><span class="dots"></span></span> Our Services <span class="shape right"><span class="dots"></span></span>
                </span>
                <h2 class="sec-title">Who We Are</h2></div>
            <div class="row gx-0">
			 @foreach($services as $value)   
			<div class="col-md-6 col-lg-4 service-list-wrap">
                    <div class="service-list">
                        <div class="service-list_icon"><img src="public/uploads/{{ $value->image}}" alt="Icon"></div>
                        <div class="service-list_content">
                            <h3 class="service-list_title box-title" data-bs-toggle="modal" data-bs-target="#serviceModal">{{$value->title}}</h3>
                            <p class="service-list_text"> {{$value->description}}</p></div>
                    </div>
                </div>	
				
                 @endforeach
			
			
            </div>
            <div class="text-center mt-5"><a href="{{route('home.services')}}" class="th-btn style-new">VIEW ALL SERVICES</a></div>
        </div>
    </section>

    <section class="project-sec overflow-hidden" data-pos-space=".process-sec" data-sec-space="margin-top" data-margin-top="0">
        <div class="container th-container4 bg-smoke space" data-bg-src="assets/img/update1/bg/bg_pattern_6.png">
            <div class="container">
                <div class="project-card2-wrap">
                    <div class="row justify-content-lg-between align-items-end">
                        <div class="col-lg-7 mb-n2 mb-lg-0">
                            <div class="title-area"><span class="sub-title6">Our Products<span class="shape right"><span class="dots"></span></span>
                                </span>
                                <h2 class="sec-title">What We Do</h2></div>
                        </div>
                        <div class="col-auto">
                            <div class="sec-btn"><a href="idemia-card-connect.html" class="th-btn">VIEW ALL Products<i class="fas fa-arrow-right ms-2"></i></a></div>
                        </div>
                    </div>
                    <div class="row slider-shadow th-carousel" id="projectSlide1" data-slide-show="3" data-md-slide-show="2" data-sm-slide-show="1">
                      
                    	 @foreach($product as $value)   
			
				 <div class="col-md-6 col-lg-4">
                            <div class="project-card2">
                                <div class="project-img"><img src="public/uploads/{{ $value->image2}}" alt="project image"></div>
                                <div class="project-content">
                                    <h3 class="project-title"><a href="">{{$value->title}}</a></h3><a href="" class="project-icon"><i class="far fa-plus"></i></a></div>
                            </div>
                        </div>
				
                 @endforeach
					 
                    </div>
                    <div class="icon-box">
                        <button data-slick-prev="#projectSlide1" class="slick-arrow default"><i class="far fa-arrow-left"></i></button>
                        <button data-slick-next="#projectSlide1" class="slick-arrow default"><i class="far fa-arrow-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
   
    
    
<div class="client-area-5 background-image" style="background-size: cover; background-image: url('public/uploads/client-bg_5.png');">   
        
        <div class="container">
            <div class="row align-items-center wow fadeInLeft" data-wow-delay="0.3s">
                <div class="col-xl-6 col-md-5">
                    <div class="img-box13"><img src="public/uploads/{{$clientdesc->image}}" alt="About"></div>
                </div>
                <div class="col-xl-6 col-md-7">
                    <div class="title-area mb-30">
                        <h2 class="sec-title">Our Clients</h2></div>
                    <p class="mt-n2 mb-30">{{$clientdesc->description}}</p>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="row th-carousel client-slider5" data-slide-show="5" data-lg-slide-show="5" data-md-slide-show="5" data-sm-slide-show="2" data-xs-slide-show="2">
                     	 @foreach($clients as $value)      
						
						<div class="col-lg-auto text-center">
                            <a href="#" class="client-thumb"><img src="public/uploads/{{$value->image}}" alt="img"></a>
                        </div>
                           @endforeach
                       
                    </div>
    </div>

    <div class="space bg-top-left" data-bg-src="assets/img/update1/bg/bg_pattern_10.png" id="contact-sec">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 pe-xxl-5  wow fadeInLeft" data-wow-delay="0.3s">
                    <div class="title-area mb-30">
                        <h2 class="sec-title">{{$missionvision->title}}</h2></div>
                    <p class="mt-n2 mb-30">{{$missionvision->description}}</p>
                    <div class="row gy-3 mb-35">
                        <div class="col-md-auto col-sm-6"><img src="public/uploads/{{$missionvision->image}}" alt="image"></div>
                        <div class="col-md-auto col-sm-6"><img src="public/uploads/{{$missionvision->pdf}}" alt="image"></div>
                    </div>
                    <div class="btn-group style2"><a href="#" class="th-btn">Read More <i class="fas fa-arrow-right ms-2"></i></a>
                        
                    </div>
                </div>
                <div class="col-xl-6 mt-40 mt-xl-0  wow fadeInRight" data-wow-delay="0.3s">
                    <div class="contact-wrap3">
                        <div class="contact-form-wrap">
                            <form action="https://html.themeholy.com/konta/demo/mail.php" method="POST" class="contact-form ajax-contact">
                                <h4 class="form-title">Get in Touch</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name*"> <i class="fal fa-user"></i></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address*"> <i class="fal fa-envelope"></i></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="tel" class="form-control" name="number" id="number" placeholder="Phone Number*"> <i class="fal fa-phone"></i></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="subject" id="subject" class="single-select nice-select form-select">
                                                <option value="" disabled="disabled" selected="selected" hidden>Select Subject*</option>
                                                <option value="EMV Banking Cards">EMV Banking Cards</option>
                                                <option value="Banking Equipment">Banking Equipment</option>
                                                <option value="Security Printing">Security Printing</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="message" id="message" cols="30" rows="3" class="form-control" placeholder="Write Your Message*"></textarea> <i class="fal fa-pen"></i></div>
                                    </div>
                                    <div class="form-btn col-12">
                                        <button class="th-btn w-100">Submit<i class="fas fa-long-arrow-right ms-2"></i></button>
                                    </div>
                                </div>
                                <p class="form-messages mb-0 mt-3"></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

 @include('includes.footer')