@extends('layouts.main')


@section('content')



<!--Page Banner-->

<section class="event-banner">

    <div class="image-layer" style="background-image:url('{{ asset('storage/' . $event->image) }}')"></div>





    <div class=" banner-inner">

        <div class="auto-container">

            <div class="inner-container clearfix">

                <!-- <div class="cat-info clearfix">

                    <a href="#">Fun & Play</a>

                </div> -->

                <h1>{{$event->name}}</h1>

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
                                            <li>{{ \Carbon\Carbon::parse($event->created_date)->format('F d, Y') }}</li>
                                            <li>{{ \Carbon\Carbon::parse($event->created_date)->format('l \\a\\t H:i') }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="info-block col-md-6 col-sm-12">
                                    <div class="inner-box">
                                        <div class="icon"><span class="flaticon-map"></span></div>
                                        <h4>Location</h4>
                                        <ul>
                                            <li>{{ $event->location ?? 'No location specified' }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                       @if($event->image&&$event->multipleImages && $event->multipleImages->count())

                        <div class="main-image">
                            <div id="eventCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">

                                <div class="carousel-inner event-carousel-inner">
								 <div class="carousel-item active">
                                        <img src="{{ asset('storage/' . $event->image) }}"
                                            class="d-block w-100"
                                            alt="Image {{ $event->name }}"
                                            loading="lazy">
                                    </div>
                                    @if($event->multipleImages && $event->multipleImages->count())
                                    @foreach($event->multipleImages as $index => $image)
                                    <div class="carousel-item  active ">
                                        <img src="{{ asset('storage/' . $image->name) }}"
                                            class="d-block w-100"
                                            alt="Image {{ $event->name }}"
                                            loading="lazy">
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                @if($event->multipleImages && $event->multipleImages->count() > 1)
                                <!-- Carousel controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                                @endif
                            </div>
                        </div>
 @endif



                        <div class="text-block">

                            <h2>Overview</h2>

                            <p>{{$event->description}}</p>



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

                                


                                <div class="default-form booking-form">
                                    <h4>Enquiry</h4>
                                    <form id="bookingForm" method="post" action="{{ route('book.event') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="username" placeholder="Name *" required value="{{ old('username') }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" placeholder="Email Address *" required value="{{ old('email') }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="address" placeholder="Address *" required value="{{ old('address') }}">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Your Comments">{{ old('message') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Submit</span></button>
                                        </div>
                                    </form>

                                    <!-- For displaying messages -->
                                    <div id="formMessage"></div>
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

@section('scripts')

<script>
    $(function() {
        $('#bookingForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert('Booking successfully');
                    $('#bookingForm')[0].reset();
                },
                error: function(xhr) {
                    let msg = 'An error occurred.';
                    if (xhr.status === 422 && xhr.responseJSON.errors) {
                        msg = '';
                        $.each(xhr.responseJSON.errors, function(key, val) {
                            msg += val[0] + '\n';
                        });
                    }
                    alert(msg);
                }
            });
        });
    });
</script>
@endsection