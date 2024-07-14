@extends('layout.default')

@section('content')
    <section class="bannercontainer bannerinner">
      <img src="{{ url('/')}}/images/about-banner.jpg" alt="" />
      <div class="bannersearchouter">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="binnerouter">
                <div class="row">
                  <div class="col-12 wow fadeInDown">
                    <h1>Your digital guru for buy/ sell</h1>
                    <p>Buy / Sell anywhere anytime, at your own comfort</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="aboutinnercontainer thankwrap">
      <!-- {{ $msg }} -->
      <div class="container">
      	<!-- <div style="text-align: center;">
          	<img src="http://wgi-aws-php-1241812835.ap-south-1.elb.amazonaws.com/p2/venkatesh/public/images/nodata.png" alt="" />
          </div> -->
      <div class="thank_box text-center">
          <!--<i class="fa fa-times"></i>-->
          
          <h2>Page Not Found</h2> 
          <div class="thline"></div>         
          <p>Sorry, the page you are looking for could not be found.</p>
          <a href="{{ url('/')}}" class="goback"><i class="icon icon-arrow-thin-left"></i> <span>Go to Home Page</span></a>
        </div>
      </div>
    </section>
	@endsection