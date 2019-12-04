@extends('front.layouts.app')

@section('title', 'Easily find and return lost phones.')

@section('content')
    <section class="home">
        <!--==Main Slider Section ==-->
        <div class="main-header bg-opacity">
            <!-- main header -->
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-header-text"><br>
                            <!--<h3 class="wow fadeIn animated" data-wow-duration=".5s" data-wow-delay=".2s">Losing your
                                phone sucks.</h3>-->
                            <h1>Coming December 2019</h1>
                            <p>The American Humane Association estimates over 10 million <br>dogs and cats are lost or stolen in the U.S. every year.</p>
                            <!--<a href="{{ route('register') }}" class="active">Try It Free</a>
                            <a href="{{ route('faq') }}">Learn More</a>-->
                        </div>
							<br />
							<a href="#"><img src="{{ asset('images/app-store2-trans.png' ) }}" alt="" class="img-responsive"></a><br>
							<a href="#"><img src="{{ asset('images/google-play2-trans.png' ) }}" alt="" class="img-responsive"></a><br><br>
                    </div>
                </div>
            </div>
            <!-- /main header -->
        </div>
    </section>
    <!--== Home Section End ==-->

    <!--== Service Section Start ==-->
    <section class="service-list">
        <div class="container">
            <div class="row ">
                <!--== Single Service ==-->
                <div class="col-md-4 mb-lg-0 mb-3">
                    <div class="service-list-item" data-wow-delay="0.1s">
                        <img src="{{ asset('images/icons/Friends-Family.png' ) }}" alt="" style="max-width: 50px;">
                        <h4>Community</h4>
                        <p class="small">Peace of mind knowing that anybody can effectivley ID your pet without extra rfid equipment.</p>
                    </div>
                </div>
                <!--== Single Service ==-->
                <div class="col-md-4 mb-md-0 mb-3">
                    <div class="service-list-item wow fadeInUp" data-wow-delay="0.2s">
                        <img src="{{ asset('images/icons/Save_Money.png' ) }}" alt="" style="max-width: 50px;">
                        <h4>Save Money</h4>
                        <p class="small">PETid is very cost effective solution when compared to implanted rfid chips and gps devices.</p>
                    </div>
                </div>
                <!--== Single Service ==-->
                <div class="col-md-4">
                    <div class="service-list-item wow fadeInUp" data-wow-delay="0.3s">
                        <img src="{{ asset('images/icons/Easy-Use.png' ) }}" alt="" style="max-width: 50px;">
                        <h4>Easy to Use</h4>
                        <p class="small">Our platform is simple to use. Anybody can signup and start protecting their pets immediatly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Service Section End ==-->

    <!--== About us Section Start ==-->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <!--== About Us Left ==-->
                <div class="col-md-6">
                    <div class=" text-left">
                        <h2 class="heading">Why Choose <span>PETiD?</span></h2>
                    </div>
                    <div class="about-text">
                        <p>Everyday thousands of phones are lost or misplaced around the world. Most people have
                            experienced this for themselves and are all too familiar with the headache that comes along
                            with losing your phone. Until recently there wasn't much in the way of tools to recover you
                            lost phone. Introducing Fownd. Fownd is a simple yet breakthrough way of adding another
                            layer of protection for you and your mobile device. Fownd is the first and only service on
                            the market enabling peer to peer lost phone recovery.</p>
                    </div>
                    <div class="choose">
                        <ul>
                            <li>
                                <i class="icofont icofont-light-bulb"></i><span>LOW COST</span>
                            </li>
                            <li>
                                <i class="icofont icofont-light-bulb"></i><span>PEACE OF MIND</span>
                            </li>
                            <li>
                                <i class="icofont icofont-light-bulb"></i><span>EASY TO USE</span>
                            </li>
                            <li>
                                <i class="icofont icofont-light-bulb"></i><span>ADDED PROTECTION</span>
                            </li>

                        </ul>
                    </div>
                </div>
                <!--== About Us Right ==-->                <div class="col-md-6">                        <img src="{{ asset('images/lost-dog-web.jpg' ) }}" alt="" class="img-responsive">                </div>
            </div>
        </div>
    </section>

    <!--== About us Section end ==-->

    <!--== Team Section Start ==-->
    <section class="section-padding">
        <div class="container">
            <div class="row">
                <!--== Single Team Item ==-->
                <div class="col-md-3">
                    <div class="single-team">
                        <div class="team-img">
                            <img src="{{ asset('images/step1.jpg' ) }}" alt="" class="img-responsive">
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h3>Step 1</h3>
                                <p>Download the PETiD app.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--== Single Team Item ==-->
                <div class="col-md-3">
                    <div class="single-team">
                        <div class="team-img">
                            <img src="{{ asset('images/step2.jpg' ) }}" alt="" class="img-responsive">
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h3>Step 2</h3>
                                <p>Setup Your Recovery Preferences.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--== Single Team Item ==-->
                <div class="col-md-3">
                    <div class="single-team">
                        <div class="team-img">
                            <img src="{{ asset('images/step3.jpg' ) }}" alt="" class="img-responsive">
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h3>Step 3</h3>
                                <p>Order your pets unique ID tag.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--== Single Team Item ==-->
                <div class="col-md-3">
                    <div class="single-team">
                        <div class="team-img">
                            <img src="{{ asset('images/step4.jpg' ) }}" alt="" class="img-responsive">
                        </div>
                        <div class="team-content">
                            <div class="team-info">
                                <h3>Step 4</h3>
                                <p>Enjoy Piece Of Mind.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Team Section End ==-->

    <!-- == Testimonial Section Start == -->
    <section class="section-padding pt-0">
        <div class="container">
            <div class="row">
                <div id="client-testimonial" class="testimonial-slide owl-carousel">
                    <div class=" testimonial-item">
                        <div class="testimonial-text-clients">
                            <img src="{{ asset('images/users/Jackie_S.png' ) }}" alt="" class="img-circle">
                            <div class="testimonial-text-content">
                                <span>“</span>
                                <p>I left my phone at a resteraunt and withen minutes after we left the waiter called my
                                    husband to let us know I left my phone and that she had it.</p>
                                <span>”</span>
                                <h5 class="text-right">Jackie S. | Scottsdale, AZ</h5>
                            </div>
                        </div>
                    </div>
                    <div class=" testimonial-item">
                        <div class="testimonial-text-clients">
                            <img src="{{ asset('images/users/Brian_F.png' ) }}" alt="" class="img-circle">
                            <div class="testimonial-text-content">
                                <span>“</span>
                                <p>Fownd helped me recover my phone the day after I signed up. I wont go without it now
                                    and would recomend this to anybody with a phone.</p>
                                <span>”</span>
                                <h5 class="text-right">Brian F. | Charlotte, NC</h5>
                            </div>
                        </div>
                    </div>
                    <div class=" testimonial-item">
                        <div class="testimonial-text-clients">
                            <img src="{{ asset('images/users/Rachel_S.png' ) }}" alt="" class="img-circle">
                            <div class="testimonial-text-content">
                                <span>“</span>
                                <p>I was out with friends and lost my phone. Thankfully I had Fownd and the person that
                                    found my phone had already returned it to my parents by the time I knew it was
                                    gone.</p>
                                <span>”</span>
                                <h5 class="text-right">Rachel S. | Louisville, KY</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
    <!-- == Testimonial Section End == -->
@endsection

@include('flash::message')
