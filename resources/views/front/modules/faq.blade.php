@extends('front.layouts.app')

@section('title', 'Faq')

@section('content')
    <!--== FAQ Section Start ==-->
    <section class="section section-ptb">
        <div class="container">
            <div class="row">
                <div class="text-center">
                    <h2 class="heading-center"> Frequently Asked <span>Questions</span></h2>
                    <p class="heading-text col-md-10 col-md-offset-1">PETiD cares about its customers and wants to assist them in finding answers to
                        questions and to resolve their concerns promptly. If you don't find an answer to your question below please use the contact page
                        to send us an email and we will be with you as soon as possible.</p>
                </div>
            </div>
            <!--== Popular Qus ==-->
            <div class="col-md-6">
                <div class="title-text-faq">
                    <h3>POPULAR QUESTIONS</h3>
                </div>
                <div class="panel-group accordion-faq" id="accordion">
                    <!--== Single Qus ==-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true">How does PETiD Work?</a>
                        </div>

                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p>If you have lost your pet, with our service, whoever finds them, will see that there is an QR code to
                                    scan on their tag, which will go to our server, and then the finder will receive information of how to return the pet, or who to call.</p>
                            </div>
                        </div>
                    </div>
                    <!--== Single Qus ==-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                               aria-expanded="false">Will the finder of my pet be able to access my data?</a>
                        </div>

                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Absolutely not. With PETiD you can input as much or as little data as you would like. Only the detals you want to share will be visible.</p>
                            </div>
                        </div>
                    </div>
                    <!--== Single Qus ==-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsethree"
                               aria-expanded="false">How is data on my phone protected?</a>
                        </div>

                        <div id="collapsethree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>The finder of your phone will not be able to access your data, as your phone is locked. All the
                                    finder will be able to access is a code to scan which will give him or her the information to
                                    return it.</p>
                            </div>
                        </div>
                    </div>
                    <!--== Single Qus ==-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefour"
                               aria-expanded="false">I am worried about my photos. If I lose my phone, can someone access these and
                                Photoshop the photos and send them to others?</a>
                        </div>

                        <div id="collapsefour" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>No, with Fownd, the finder will only be able to access the code to scan with their phone which
                                    will give him or her the information to return it.</p>
                            </div>
                        </div>
                    </div>
                    <!--== Single Qus ==-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefive"
                               aria-expanded="false">Can my cell phone be tracked if it is turned off?</a>
                        </div>

                        <div id="collapsefive" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>When your phone is turned off, it stops communicating with cell towers that are nearby;
                                    however, it can be traced to the location it was in when powered down. Your finder will be
                                    able to get the tracking code which will tell them where to send the phone.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="title-text-faq">
                    <!--== General Qus ==-->
                    <h3>GENERAL QUESTIONS</h3>
                    <!--== Single Qus ==-->
                    <div class=" panel-body">
                        <div class="general-panel panel-body">
                            <h4 class="panel-title">Am I bound to a contract? If so, for how long?</h4>
                            <p>No, our contracts are month-to-month and can be cancelled at any time. We also offer a 30-day
                                trial.</p>
                        </div>
                    </div>
                    <!--== Single Qus ==-->
                    <div class="panel-body">
                        <div class="general-panel panel-body">
                            <h4 class="panel-title">What happens if I never need to use the PETiD app?</h4>
                            <p>It is possible that this service is not for you. But wouldn’t you rather have the peace of mind of
                                knowing your pet is protected?</p>
                        </div>
                    </div>
                    <!--== Single Qus ==-->
                    <div class="panel-body">
                        <div class="general-panel panel-body">
                            <h4 class="panel-title">If I am a frequent user of PETiD, will I be charged more?</h4>
                            <p>No, the price stays the same regardless of how many times you use it.</p>
                        </div>
                    </div>
                    <!--== Single Qus ==-->
                    <div class="panel-body">
                        <div class="general-panel panel-body">
                            <h4 class="panel-title">How long after I sign up will it take for PETiD to work?</h4>
                            <p>It works instantly completing the sign-up process. After you register your device, you need to
                                set your backup contact details and the lock screen</p>
                        </div>
                    </div>										<!--== Single Qus ==-->                    <div class="panel-body">                        <div class="general-panel panel-body">                            <h4 class="panel-title">Do I need a special app to scan the QR code?</h4>                            <p>No. All newer iPhone and Android devices can scan QR codes just by using the camera. You do not need an app for this.</p>                        </div>                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== FAQ Section End ==-->
@endsection
