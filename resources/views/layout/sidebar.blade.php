@php $slug = end(explode("/", $_SERVER['REQUEST_URI']));
@endphp

<ul class="sf-menu">
  <li @if($slug =="dashboard") class="active" @endif><a href="{{ url('/dashboard')}}"><i class="icon icon-dashboard"></i>@lang('dashboard.dashboard_txt')</a></li>
  <li @if($slug =="update-account") class="active" @endif><a href="{{ url('/update-account')}}"><i class="icon icon-user-pencil"></i>@lang('dashboard.updat_account_txt')</a></li>
  <li @if($slug =="purchase-packages") class="active" @endif><a href="{{ url('/purchase-packages')}}" ><i class="icon icon-shopping-basket"></i>@lang('dashboard.purchase_package_txt')</a></li>
  <li @if($slug =="wallet") class="active" @endif><a href="{{ url('/wallet')}}"><i class="icon icon-wallet"></i>@lang('dashboard.wallets_txt')</a></li>
  <li @if($slug =="wish-list") class="active" @endif><a href="{{ url('/wish-list')}}"><i class="fa fa-heart-o"></i>@lang('dashboard.wishlist_txt')</a></li>
  
  @if($data['userDetails']['id_cms_privileges'] == 3)
    <li>
      <a href="javascript:void(0);"><i class="icon icon-comment"></i>@lang('dashboard.send_msg_txt')</a>
      <ul>
        <li><a href="{{ url('/compose-mail')}}">@lang('dashboard.site_admin_txt')</a></li>
        <li><a href="{{ url('/other-members')}}">@lang('dashboard.others_mail_txt')</a></li>
      </ul>
    </li>
    <li @if($slug =="post-add") class="active" @endif><a href="{{ url('/post-add')}}"><i class="icon icon-speaker"></i>@lang('dashboard.post_add_txt')</a></li>
    <li @if($slug =="view-and-manage-ads") class="active" @endif><a href="{{ url('/view-and-manage-ads')}}"><i class="icon icon-digital-marketing"></i>@lang('dashboard.view_manage_txt')</a></li>
    <li @if($slug =="view-inquiries") class="active" @endif><a href="{{ url('/view-inquiries')}}"><i class="icon icon-search"></i>@lang('dashboard.view_inq_txt')</a></li>
  @endif;
  
  <li><a href="{{('logout')}}"><i class="icon icon-power-off"></i>@lang('dashboard.logout_txt')</a></li>
</ul>