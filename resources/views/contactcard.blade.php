
 @include('includes.header')
  <style>
  @media only screen and (max-width: 600px){
iframe {
    width: 290px !important;
}
}
  .icon_a{	color:#fff !important;}
  .icon_font{	font-size: 35px;}
  .social_icon_contact{	color:var(--secondary-color) !important;}
  
  .social_icon_contact:hover{	color:#fff !important;}
  .branches
  {
	  color:#fff !important;
  }
  @media only screen and (max-width: 600px) {
iframe
{	
	width: 290px !important;
}
}
  </style>
  <main class="main__content_wrapper">          
  <!-- Start breadcrumb section -->      
  <section class="breadcrumb__section breadcrumb__bg" style="background: url(public/uploads/{{$contactcardbanner->image}});background-repeat: no-repeat;background-size: cover;"> 
  <div class="container">               
  <div class="row row-cols-1">                    
  <div class="col">                        
  <div class="breadcrumb__content text-center">                           
  <h1 class="breadcrumb__content--title text-white mb-25">Contact Card</h1>                            
  <ul class="breadcrumb__content--menu d-flex justify-content-center">                               
  <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a></li>
  <li class="breadcrumb__content--menu__items"><span class="text-white">Contact Us</span></li>   
  </ul>                       
  </div>                    
  </div>                
  </div>           
  </div>        
  </section>        <!-- End breadcrumb section -->  
  <!-- Start contact section -->       
  <section class="contact__section section--padding">            
  <div class="container">               
  <div class="section__heading text-center mb-40">                  
  <h2 class="section__heading--maintitle">Get In Touch</h2>                
  </div>                
  <div class="main__contact--area position__relative">                                        
  <div class="contact__form">                       
  <h3 class="contact__form--title mb-40">Contact Me</h3>  
  
<?php echo $cardmapaddress->title; ?>
 </div>  
  <div class="contact__info border-radius-5">		
    
  @php
  $count=1;
  @endphp
  @foreach($contactcard as $value)                       
   <div class="contact__info--items">  
   <h3 class="contact__info--content__title text-white mb-15">{{$value->title}}</h3>  
   <div class="contact__info--items__inner d-flex">                                
   <div class="contact__info--icon icon_font">                                  
   <i class="{{$value->job_title}}"></i>                                
   </div>                                
   
   <div class="contact__info--content">                                    
   <p class="contact__info--content__desc text-white">
   <a href="tel:{{$value->feature1}}" class="icon_a">@if($count==1)Phone:@endif {{$value->feature1}}</a><br> 
   <a href="tel:{{$value->feature2}}" class="icon_a">@if($count==1)Whatsapp:@endif {{$value->feature2}}</a>  
   </p>                              
   </div>                           
   </div>                        
   </div>             
   @php 
   $count++; 
   @endphp    
   @endforeach                        
   <div class="contact__info--items">                            
   <h3 class="contact__info--content__title text-white mb-15">Follow Us</h3> 
   <ul class="contact__info--social d-flex">	
   @foreach($cardsocialicons as $value)		
   <li class="contact__info--social__list">                   
   <a class="contact__info--social__icon" target="_blank" href="{{$value->title}}"> 
   <i class="social_icon_contact {{$value->job_title}}"></i>                        
   <span class="visually-hidden">Facebook</span>                                
   </a>                                
   </li>                           
   @endforeach                          
   </ul>                        
   </div>  
 <div class="contact__info--items">                            
   <h3 class="contact__info--content__title text-white mb-15"><a class="branches" target="blank" href="{{route('home.branches')}}"><u>Click Branches</u></a></h3> 
                        
   </div>    
   </div>                
   </div>            
   </div>        
   </section>        <!-- End contact section -->    
   <!-- Start contact map area -->       
   <div class="contact__map--area section--padding pt-0">                 
   </div>        
   <!-- End contact map area -->        
   
   </main>
 @include('includes.footer')