  @include('includes.header')

	<div class="breadcumb-wrapper background-image" style="background-image: url(public/uploads/{{ $banner->image}});">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Our Technology Partners</h1>
                <ul class="breadcumb-menu">
                    <li><a href="index.html">Home</a></li>
                    <li>Clients</li>
                </ul>
            </div>
        </div>
    </div>

    <section class="space">
        <div class="container z-index-common">
            <div class="title-area text-center">
                <h2 class="sec-title">{{ $technology_partners_desc->title}}</h2>
                <p>{{ $technology_partners_desc->description}}</p>
            </div>
            <div class="client-area-6">
                <div class="row gy-4 justify-content-center">
				 @foreach($technology_partners as $value) 
                    <div class="col-lg-auto text-center"><a href="#" class="client-thumb style2"><img
                                src="public/uploads/{{ $value->image}}" alt="img"></a></div>
                 @endforeach
                      

                 
            </div>
        </div>
    </section>

 @include('includes.footer')  


 
   

  


 
   