@extends('layout.default')

@section('content')
<section class="logincontainer">
  <div class="logininner">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-md-6 col-sm-12 col-12 pl-0 pr-0">
          <div class="lblright loginleft">
            <div class="lblrightinner">
              @if(Session::has('error_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-danger alert-dismissible') }}">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
              @if(Session::has('success_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-success alert-dismissible') }}">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
              <div class="innerbox">
                <div class="lgheading">@lang('login.welcome_Back')</div>
                <p>@lang('login.welcome_text')</p>
                <div class="lform">
                  <form method="post" id="login_form" action="{!! url('en/login-validate') !!}">
                @csrf
                  <div class="form-group">
                    <div class="formgroupinner">
                      <i class="fa fa-envelope-o"></i>
                      <input type="text" name="email_id_log" id="email_id_log" class="form-control" placeholder="@lang('login.email')" autocomplete="off">
                      @if($errors->has('email_id_log'))
                            <div class="error">{{ $errors->first('email_id_log') }}</div>
                      @endif    
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="formgroupinner">
                      <i class="icon icon-password"></i>
                      <span class="p-view"><i class="icon icon-eye-slash"></i></span>
                      <input type="password" name="password_log" id="password_log" class="form-control" placeholder="@lang('login.password')" name="">
                      @if($errors->has('password_log'))
                            <div class="error">{{ $errors->first('password_log') }}</div>
                      @endif 
                    </div>
                  </div>
                  <div class="forgot">
                    <a href="javascript:void(0);" id="forgot_pwd">@lang('login.forgot_your_password')</a>
                  </div>
                  <div class="checkbox">
                    <input type="checkbox" id="keepme" name="">
                    <label for="keepme">@lang('login.keep_me_signed_in')</label>
                  </div>
                  <button class="lgbtn" type="submit">@lang('login.login')</button>
                   </form>
                   <form method="post" id="forgot_password_form" action="{!! url('en/forgot-password') !!}" style="display:none;">

            @csrf
            <div class="form-group">
              <input type="text" class="form-control" name="email_id_forgot" id="email_id_forgot" value="" placeholder="@lang('login.email')" autocomplete="off" />
              <small id="email_id_forgot_err" class="errmsg hidemsg"></small>
            </div>
           
            <a class="forgot" href="javascript:void(0);" id="sign_in">@lang('login.sign_in')?</a>
            <button class="lgbtn" type="submit">@lang('login.submit_txt')</button>
                   </form>
                  <div class="facebookwr">
                    <span>@lang('login.login_with_face')</span><a class="facebook" href="javascript:void(0);" onlogin="checkLoginState();"><i class="fa fa-facebook"></i></a>
                  </div>
                </div>
              </div>
           
            
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12 col-12 pl-0 pr-0">
          <div class="lblright">
            <div class="lblrightinner">
              <div class="innerbox">
                <div class="lgheading">@lang('login.create_an_account')</div>
                <p>@lang('login.reg_txt')</p>
                <div class="lform">
                  @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
                  <form id="registration_form" action="{{ url(app()->getLocale().'/customer-insert')}}" method="post">
                 @csrf
                  <div class="row ml-n2 mr-n2">
                    <div class="col-xl-6 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="icon icon-user"></i>
                          <input type="text" class="form-control" placeholder="@lang('login.user_name')" name="user_name" id="user_name">
                        </div>  
                        <!-- @if($errors->has('user_name'))
                            <div class="error">{{ $errors->first('user_name') }}</div>
                        @endif     -->                  
                      </div>
                    </div>
                    <div class="col-xl-6 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="icon icon-phone"></i>
                          <input type="text" class="form-control" placeholder="@lang('login.phone_number')" name="phone_number" id="phone_number">
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="fa fa-envelope-o"></i>
                          <input type="email" class="form-control" placeholder="@lang('login.email')" name="email" id="email">
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="icon icon-password"></i>
                          <span class="p-view"><i class="icon icon-eye-slash"></i></span>
                          <input type="password" class="form-control" placeholder="@lang('login.password')" name="user_password" id="user_password">
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="icon icon-edit"></i>
                          <textarea class="form-control" placeholder="@lang('login.description')" name="description" id="descriptions"></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <div class="checkbox">
                        <input type="checkbox" id="agree" name="agree">
                        <label for="agree">@lang('login.i_agree') <a href="{{ url(app()->getLocale().'/page/terms-and-conditions')}}" target="_blank">@lang('login.aggre_txt')</a></label>
                      </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <button class="lgbtn signupbtn" type="submit">@lang('login.signup')</button>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--0<fb:login-button  scope="public_profile,email" onlogin="checkLoginState();" data-show-faces="false" login_text="login with facebook" data-width="400" data-size="large" data-button-type="login_with" data-auto-logout-link="false" data-use-continue-as="false" >
   </fb:login-button>-->
@endsection