@include('includes.header')
<style>
    .work-sticky .items .cont .sticky-item {
 text-transform:uppercase;
}
</style>
 <div id="smooth-content">

            <main class="main-bg">



                <!-- ==================== Start Header ==================== -->

                <header class="page-header bg-img section-padding" data-background="public/uploads/{{ $offerbanner->image}}"
                    data-overlay-dark="2">
                    <div class="container pt-100">
                        <div class="text-center">
                            <h1 class="fz-100 text-u">Our Offers</h1>
                            <div class="mt-15">
                                <a href="#">Home</a>
                                <span class="padding-rl-20">|</span>
                                <span class="main-color">Our Offers</span>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- ==================== End Header ==================== -->



                <!-- ==================== Start Team ==================== -->

              <section class="work-sticky section-padding pt-60 sub-bg ">
                    <div class="container">
                        <div class="sec-head mb-80">
                            <h6 class="sub-title main-color mb-25">Our Offers</h6>
                            <div class="bord pt-25 bord-thin-top d-flex align-items-center">
                                <h2 class="fw-600">Meet our <span class="fw-200">Offers</span></h2>
                              
                            </div>
                        </div>
                        <div class="row">
                          <?php $i=1;?>
@foreach($offers as $value)
    @if(($i%2)==0)
        <div class="col-lg-5 items">
            <div class="img">
                <img src="public/uploads/{{$value->image}}" alt="">
            </div>
        </div>
        <div class="col-lg-7 items">
            <div class="cont">
                <div class="sticky-item">
                    <h5 class="mb-15">{{$value->title}}</h5>
                    <p>{{$value->description}}</p>
                </div>
            </div>
        </div>
    @else
        <div class="col-lg-7 items">
            <div class="cont">
                <div class="sticky-item">
                    <h5 class="mb-15">{{$value->title}}</h5>
                   <p> {{$value->description}}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-5 items">
            <div class="img">
                <img src="public/uploads/{{$value->image}}" alt="">
            </div>
        </div>
    @endif
    <?php $i++; ?>
@endforeach

                          
                        </div>
                    </div>
                </section>


                <!-- ==================== End Team ==================== -->



            </main>



    @include('includes.footer')
    </div>