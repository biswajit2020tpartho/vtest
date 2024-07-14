<footer class="footercontainer">
  <div class="container">
    <div class="row">
      <div class="col-xl-3 col-md-6 col-sm-12 col-12">
        <div class="visitboxouter">
          <div class="visitboxcolumn">
            <h3>@lang('home.nos_of_user')</h3>
            <h5>{{ $data['nos_user'] }}+</h5>
          </div>
          <div class="visitboxcolumn">
            <h3>@lang('home.nos_of_vis')</h3>
            <h5>{{ $data['visitor']}}+</h5>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-12 col-12">
        <div class="feedbackform">
          <h3>@lang('home.feedback_txt')</h3>
          <div id="feback"></div>
          <form id="form-feedback">
            {{ csrf_field() }}
          <div class="row">
            
            <div class="col-xl-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" name="name">
              </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-12 col-12">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Email ID" name="email">
              </div>
            </div>
            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="@lang('home.message')" name="message">
              </div>
            </div>
            <div class="col-xl-12 col-md-12 col-sm-12 col-12" onclick="submitInquiry();">
              <a href="javascript:void(0);" class="feedbtn"><span id="feed_form" data-loading-text="Loading..">@lang('home.sub_btn')</span><i class="icon icon-arrow-thin-right"></i></a>
            </div>        
          </div>
            </form>
        </div>
      </div>
      <div class="col-xl-3 col-md-12 col-sm-12 col-12">
        <div class="emailbox">
          <div class="emailboxinner">
            <div class="emailboxicon">
              <i class="fa fa-envelope"></i>
            </div>
            <div class="emailboxcontent">
              <h3>@lang('home.footer_email_txt')</h3>
              <p><a href="mailto:{{ $data['settings']->email}}">{{ $data['settings']->email}}</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="footernav">
          <ul>            
            @foreach( $data['footer_menu'] as $menu)
            <li><a href="{{ url(app()->getLocale().'/page')}}/{{$menu->getPageslug->slug}}">{{ $menu->page_title}}</a></li>
            @endforeach
           <!--  <li><a href="javascript:void(0);">About Us</a></li>
            <li><a href="javascript:void(0);">Customer Service</a></li>
            <li><a href="javascript:void(0);">Contact Us</a></li>
            <li><a href="javascript:void(0);">Terms and Conditions</a></li>
            <li><a href="javascript:void(0);"> Privacy Policy</a></li> -->
          </ul>
          <div class="copyright">&copy; 2020, <a href="{{ url('/')}}">G9X</a> - All rights reserved</div>
        </div>
      </div>
    </div>
  </div>
</footer>