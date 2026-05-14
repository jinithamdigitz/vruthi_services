 @include('includes.header')

	<div class="breadcumb-wrapper background-image" style="background-image: url(public/uploads/{{ $banner->image}});">
        <div class="container">
            <div class="breadcumb-content">
                <h1 class="breadcumb-title">Clients</h1>
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
                <h2 class="sec-title">{{ $clientsdesc->title}}</h2>

                <p> {{ $clientsdesc->description}}</p>
            </div>
            <div class="client-area-6">
                <div class="row gy-4 justify-content-center">
				
				 @foreach($clients as $value) 
                    <div class="col-lg-auto text-center"><a href="#" class="client-thumb style2"><img
                                src="public/uploads/{{ $value->image}}" alt="img"></a></div>

                  @endforeach
            </div>
        </div>
    </section>
 @include('includes.footer')  