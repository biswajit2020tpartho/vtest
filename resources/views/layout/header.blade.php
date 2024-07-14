<div class="headerinner">
    <div class="headerinnertop">
      <div class="container">
        <div class="headtoprow">
          <div class="logocontainer">            
            <div class="logoinner">
              <a href="{{ url('/') }}"><img src="{{ url('/') }}/{{ $data['settings']->store_logo }}" alt="" /></a>
            </div>
          </div>
          <div class="rightuserbox">
            @php
            $user_exist=session()->get('userexist');
            @endphp
            @if($user_exist)
             <div class="afterlogin-user">
              <a id="UserNav" class="utext" href="javascript:void(0);">@lang('dashboard.hello_txt') 
                @php
                $name = explode(" ", $data['userDetails']->name)
                @endphp
                {{$name[0] }}</a>
              <div id="UserNavBody" class="afterloginnav">
                <ul>
                  <li><a href="{{ url('/dashboard')}}"><i class="icon icon-dashboard"></i>@lang('dashboard.dashboard_txt')</a></li>
                  <li><a href="{{ url('/update-account')}}"><i class="icon icon-user-pencil"></i>@lang('dashboard.updat_account_txt')</a></li>
                  <li><a href="{{ url('/post-add')}}"><i class="icon icon-speaker"></i>@lang('dashboard.post_add_txt')</a></li>
                  <li><a href="{{ url('logout')}}"><i class="icon icon-power-off"></i>@lang('dashboard.logout_txt')</a></li>
                </ul>
              </div>
            </div>            
            @else
            <a href="{{ url(app()->getLocale().'/login') }}" class="loginbtn"><i class="fa fa-user"></i><span>@lang('home.login_txt')</span></a>
            <a href="{{ url(app()->getLocale().'/login') }}" class="sellbtn"><i class="fa fa-camera"></i><span>@lang('home.sell_txt')</span></a>
            @endif       
            <div class="lanbox dropdown">
              <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="lanspan">
                         
                @if('en' == $data['curr_lang'])
                <span class="flag-icon flag-icon-gb"></span>
                @else
                <span class="flag-icon flag-icon-us"></span>
                @endif
             
              </span></a>
             <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><a class="dropdown-item" href="{{ route('locale.switch', 'en') }}"><span class="flag-icon flag-icon-gb"> </span></a></li>

                <li><a class="dropdown-item" href="{{ route('locale.switch', 'ge') }}"><span class="flag-icon flag-icon-us"> </span></a></li>
               <!--  <li><a class="dropdown-item" href="#au"><span class="flag-icon flag-icon-au"> </span></a></li>  -->
              </ul>
             
            </div>       

            <div class="socialtop">
               @foreach($data['socialMedia'] as $category)
               <a href="{{$category->link }}" target="_blank"><i class="{{$category->icon }}"></i></a>                
               @endforeach       
            </div>
            <a href="javascript:void(0);" class="NavBar"><i class="icon icon-segment"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>