<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="theme-color" content="#fff" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="lang" content="{{ str_replace('_', '-', app()->getLocale()) }}">
<link rel="icon" type="image/ico" sizes="32x32" href="{{URL::to('/')}}/images/favicon.ico">
<title>G9X :: Your digital guru for buy and sell</title>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
<!-- flag -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
<!-- Bootstrap CSS -->
{!! Html::style( asset('css/bootstrap.min.css')) !!}
<!-- FontAwesome -->

{!! Html::style( asset('fonts/font-awesome/css/font-awesome.min.css')) !!}

<!-- Owl Carousel -->
{!! Html::style( asset('css/owl.carousel.min.css')) !!}
{!! Html::style( asset('css/owl.theme.default.min.css')) !!}
{!! Html::style( asset('css/animations.css')) !!}

{!! Html::style( asset('css/price-range.css')) !!}
{!! Html::style( asset('css/jquery.mCustomScrollbar.min.css')) !!}
{!! Html::style( asset('css/lightslider.min.css')) !!}
<!-- CustomCss -->
{!! Html::style( asset('css/style.css')) !!}
{!! Html::style( asset('css/media.css')) !!}
{!! Html::style( asset('alertifyjs/css/themes/alertify.core.css')) !!}
{!! Html::style( asset('alertifyjs/css/themes/alertify.default.css')) !!}
{!! Html::style( asset('css/dataTables.bootstrap.min.css')) !!}
{!! Html::style( asset('css/select2.min.css')) !!}
