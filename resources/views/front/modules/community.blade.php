@extends('front.layouts.app')

@section('title', 'Community')

@section('content')

    <!--== About Section Start ==-->
    <section class="section-padding-tb">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
              <div class="single-team">
                  <div class="team-img">
                      <!--== Change Image here ==-->
                      <img src="image/team/dummy-image.jpg" alt="" class="img-responsive">
                  </div>
                  <div class="team-content">
                      <div class="team-info">
                          <h3>John Doe</h3>
                          <p>Founder</p>
                      </div>
                      <div class="team-social">
                          <ul>
                              <li>
                                <a href="#" title="facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                                <a href="#" title="twitter"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                <a href="#" title="instagran"><i class="fab fa-instagram" aria-hidden="true"></i></a>           
                              </li>
                          </ul>
                      </div>
                      <div class="read-profile">
                          <a href="#">View Profile</a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-md-7 col-md-offset-1">
            <div class="single-team-title">
               <h4>About <span>Me</span></h4> 
            </div>
            <div class="single-team-text">
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
               tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
               quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
               consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
               cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
               proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
               tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
               quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
               consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
               cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
               proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
               Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
               tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
               quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
               consequat.
               Lorem ipsum dolor sit amet, consectetur adipisicing elit
             </p>
            </div>
          </div>
        </div>
      </div>
    </section>
	<br><br><br><br>
    <!--== About Section End ==-->
@endsection
