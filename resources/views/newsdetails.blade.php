
 @include('includes.header')
     <div id="smooth-content">

            <main class="main-bg">

                <!-- ==================== Start Slider ==================== -->

                <header class="blog-header section-padding pb-0">
                    <div class="container mt-80">
                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="caption">
                                   
                                    <h1 class="fz-55 mt-30">{{$news->title}}
                                    </h1>
                                </div>
                                <div class="info d-flex mt-40 align-items-center">
                                    <div class="left-info">
                                        <div class="d-flex align-items-center">
                                          
                                            <div class="date ml-50">
                                                <a href="#0">
                                                    <span class="opacity-7">Published</span>
                                                    <h6 class="fz-16">{{$news->job_title}}</h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="background bg-img mt-80" data-background="/public/uploads/{{$news->image}}"></div>
                </header>

                <!-- ==================== End Slider ==================== -->



                <!-- ==================== Start Blog ==================== -->

                <section class="blog section-padding">
                    <div class="container">
                        <div class="row xlg-marg">
                            <div class="col-lg-12">
                                <div class="main-post">
                                    <div class="item pb-60">
                                        <article>
                                            <div class="text">
                                                <p style="font-size:17px;">{{$news->description}}</p>
                                            </div>
                                           
                                          
                                           
                                        </article>

                                   
                                    </div>
                                  
                                  
                                </div>
                               
                            </div>
                            
                        </div>
                    </div>
                </section>
                </main>
 @include('includes.footer')    </div>