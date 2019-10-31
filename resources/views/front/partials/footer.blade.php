
<!-- ==== footer section start ==== -->
<footer class="footer-bg section-padding footer">
    <div class="footer-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="f-widget logo-section">
                        <a href="{{ url('/') }}">
                            <!-- Change the logo here-->
                            <h3><span>PETiD</span></h3>
                        </a><br>
                        <p>PETiD is a pet identification platform that is affordable, non invasive to the animal, and easy to use.
						Our solution is available on both iOS and Android.</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="f-widget">
                        <div class="f-widget-title">
                            <h4>Useful links</h4>
                        </div>
                        <ul class="useful-links">
                            <li>
                                <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;
                                <a href="{{ url('/return-found-pet') }}">Pet Tag Lookup</a>
                            </li>
                            <li>
                                <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;
                                <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
                            </li>
                            <li>
                                <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;
                                <a href="{{ url('/tos') }}">Terms of Service</a>
                            </li>
                            <li>
                                <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;
                                <a href="{{ url('/contact') }}">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="f-widget">
                        <img src="{{ asset('images/satisfaction-guaranteed.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="f-widget">
                        <div class="f-widget-title">
                            <h4>Newsletter</h4>
                        </div>
                        <p>Subscribe to our newsletter and stay up to date with all product updates:</p>
                        <div class="newsletter">
                            <form method="POST" action="{{ route('newsletter-subscribe') }}">
                                @csrf()

                                <div class="input-group">
                                    <input type="email" class="form-control" name="email" placeholder="Your email Address"
                                           aria-label="Search for..." autocomplete="off">
                                    <span class="input-group-btn">
								  <button type="submit" class="btn newsletter-btn">
                                      <i class="fa Example of paper-plane fa-paper-plane"></i>
                                  </button>
								</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="row text-center">
                <div class="copyright-text">
                    <p>© Copyright {{ date('Y') }}. All Rights Reserved. <a href="{{ url('/') }}">PET-ID.APP</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ==== footer section end ==== -->
    <script src="js/owl.carousel.min.js"></script>