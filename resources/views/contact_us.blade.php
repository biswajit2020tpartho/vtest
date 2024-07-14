@extends('layout.default')
    @section('content')
    <section class="bannercontainer bannerinner">
      @if(count($getBanner) > 0)
      <img src="{{ url('/')}}/{{ $getBanner[0]->image }}" alt="" />
      @else
      <img src="{{ url('/')}}/images/about-banner.jpg" alt="" />
      @endif
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
    <div class="static_container">
      <div class="container">
          <h2 class="page_heading">Contact us</h2>
          <div class="contact_top">
            <div class="row">
              <div class="col-sm-6 contact_left">
                <div class="contactform">
                  @if(Session::has('error_message'))
                  <div class="alert {{ Session::get('alert-class', 'alert-danger alert-dismissible') }}">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                  @endif 
                  <p class="frmtext">Please fill up the form bellow.</p>
                  <form name="contact_form" id="contact_form" method="post" action="{{ url('en/contact-submit')}}">
                     @csrf
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group required">                 
                              <label class="control-label"><span>*</span> First Name </label>
                              <input type="text" name="first_name" id="first_name" class="form-control">
                          </div>               
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group required">                 
                              <label class="control-label"><span>*</span> Last Name </label>
                              <input type="text" name="last_name" id="last_name" class="form-control">
                          </div>               
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group required">                 
                              <label class="control-label"><span>*</span> Phone Number </label>
                              <input type="text" name="phone_nos" id="phone_nos" class="form-control">
                          </div>               
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group required">                 
                              <label class="control-label"><span>*</span> Email Address </label>
                              <input type="text" name="email" id="email" class="form-control">
                          </div>               
                        </div>
                        <div class="col-sm-12 tareablock">
                          <div class="form-group required">                 
                              <label class="control-label"><span>*</span> Message </label>
                              <textarea name="message" id="message" class="form-control tarea"></textarea>
                          </div>               
                        </div>
                        <div class="col-sm-12 cbtnblock">
                          <div class="csubmit_wrap text-right">
                          <button type="submit" class="csubmitbtn">Submit</span><i class="icon icon-arrow-thin-right"></i></a>
                          </div>
                        </div>
                    </div>
                  </form>
                </div>                  
              </div>
              <div class="col-sm-6 contact_right">
                <div class="cinfobox_wrap">
                  <div class="cininner">
                    <h4>Contact Info</h4>
                    <div class="infodesc">  
                      <p>{{ $settings->address}}</p>
                    </div>
                    <div class="inforow_wrap">
                        <div class="inforow row">
                          <div class="col-sm-6">
                              <div class="infobox">
                                <div class="infoicon">
                                  <i class="fa fa-envelope"></i>
                                </div>
                                <div class="infoboxcontent">
                                  <p><a href="mailto:{{ $settings->email}}">{{ $settings->email}}</a></p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="infobox">
                                <div class="infoicon">
                                  <i class="fa fa-phone"></i>
                                </div>
                                <div class="infoboxcontent">
                                  <p><a href="tel:{{ $settings->phone}}">{{ $settings->phone}}</a></p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-12 infoaddress">
                              <div class="infobox">
                                <div class="infoicon">
                                  <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="infoboxcontent">
                                  <p>Lorem Ipsum Lorem Ipsum Lorem IpsumLorem</p>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
   </div>

    @endsection