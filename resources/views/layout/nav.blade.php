@php $slug = end(explode("/", $_SERVER['REQUEST_URI']));
@endphp
<div class="navigationinner">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="navigation">
            <div class="navigationbox">
              <div class="navuser">
                <div class="userimg">
                  <img src="images/logo-icon.png" alt="Logo">
                </div>
                <h3>GX9</h3>
                <p>Your digital guru for buy / sell</p>
              </div>
              <ul class="sf-menu">
                <li @if($slug == "en" || $slug == "ge") class="active" @endif ><a href="{{ url('/') }}">@lang('home.home_txt')</a></li>
                @foreach($data['navMenu']  as $menu)
                <li @if($slug == $menu->getPageslug->slug ) class="active" @endif><a href="{{ url(app()->getLocale().'/all-ads')}}/{{$menu->getPageslug->slug}}">{{ $menu->name}}</a></li>
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>