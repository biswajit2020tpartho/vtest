<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layout.head')  
</head>
<body>
<div class="bodywrapper">
<header class="headercontainer">
  @include('layout.header')  

  @include('layout.nav')  
</header>

  @yield('content')


@include('layout.footer') 

<a id="SlideUp" class="scrollup" href="javascript:void(0);"><i class="icon icon-arrow-thin-up"></i></a>
</div>
<div class="pageloader"></div>
{{Html::script('js/jquery-3.2.1.min.js')}}
{{Html::script('js/validate.js')}}
{{Html::script('js/jquery.validate.min.js')}}
{{Html::script('js/additional-methods.min.js')}}
{{Html::script('js/popper.min.js')}}
{{Html::script('js/common.js')}}
{{Html::script('js/bootstrap.min.js')}}
{{Html::script('js/owl.carousel.min.js')}}
{{Html::script('js/wow.min.js')}}
{{Html::script('js/price-range.js')}}
{{Html::script('js/jquery.mCustomScrollbar.concat.min.js')}}
{{Html::script('js/custom.js')}}
{{Html::script('js/lightslider.min.js')}}
{{Html::script('alertifyjs/alertify.min.js')}}
{{Html::script('js/jquery.dataTables.min.js')}}
{{Html::script('js/dataTables.bootstrap.min.js')}}
{{Html::script('js/bootstrap-filestyle.min.js')}}
{{Html::script('js/select2.min.js')}}
{{Html::script('js/form.js')}}
<script src="//cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
<!-- 19032020 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('description');
    
</script>
<script>
  wow = new WOW(
 {
   animateClass: 'animated',
   offset:       100,
   callback:     function(box) {
     console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
   }
 }
 );
  wow.init();
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        $('#SlideUp').fadeIn();
      } else {
        $('#SlideUp').fadeOut();
      }
    });
    $('#SlideUp').click(function () {
      $("html, body").animate({
        scrollTop: 0
      }, 600);
      return false;
    });
  });
</script>
<!-- 03042020 -->
<script type="text/javascript">
 window.fbAsyncInit = function() {
    FB.init({
      appId      : '445827592896105',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.5'
    });
    FB.AppEvents.logPageView(); 
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
  
  function checkLoginState() {
       FB.getLoginStatus(function(response) {
            FB.api('/me?fields=id,email,birthday,location,locale,picture,age_range,currency,first_name,last_name,name_format,gender&access_token='+response.authResponse.accessToken, function(response) {
                    
              var member = new Object();
              member.id = response.id;
              member.firstName = response.first_name;
              member.lastName = response.last_name;
              member.emailAddress = response.email;
              member.pictureUrl = response.picture.data.url;
              social_media_name = "facebook";
              
                
            });
      });
  }
</script>
<script type="text/javascript">
  $('#image-gallery').lightSlider({
    gallery:true,
    item:1,
    thumbItem:5,
    slideMargin: 0,
    speed:500,
    auto:true,
    loop:true,
    keyPress:true,
    controls:true,
    pager:true,
    slideEndAnimation:true,
    galleryMargin:10,
    thumbMargin:10,
    onSliderLoad: function() {
        $('#image-gallery').removeClass('cS-hidden');
    }  
  }); 

  $(window).on('load', function(){
    $('.pageloader').hide();
    $('.bodywrapper').addClass('showcontent');
  });
</script>
</body>
</html>