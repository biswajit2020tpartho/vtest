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
    {!! html_entity_decode($pagedetails->resource->description[app()->getLocale()] ) !!}
    <!-- @if($page_id == "1")
    <section class="aboutinnercontainer">
      <div class="container">
        <div class="row mb-2">
          <div class="col-12 mb-5 wow fadeInDown">
            <h2>About us</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-5 col-md-5 col-sm-12 col-12">
            <div class="abimgbx wow fadeInDown">
              <div class="abimgbxinner">
                <img src="{{ url('/')}}/images/img22.jpg" alt="" />
              </div>
            </div>
          </div>
          <div class="col-xl-7 col-md-7 col-sm-12 col-12 align-self-center wow fadeInDown">
            <div class="amimgcontent">
              <h3>Lorem Ipsum is a dummy text</h3>
              <h5>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="abmiddlecontainer">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-md-3 col-sm-6 col-12 wow fadeInDown">
            <div class="ablist">
              <h3>LOREM IPSUM</h3>
              <ul>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy text.</a></li>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy text of the printing.</a></li>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy.</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-6 col-12 wow fadeInDown">
            <div class="ablist">
              <h3>LOREM IPSUM DUMMY</h3>
              <ul>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy text.</a></li>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy text of the printing.</a></li>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy.</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-6 col-12 wow fadeInDown">
            <div class="ablist">
              <h3>LOREM IPSUM</h3>
              <ul>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy text.</a></li>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy text of the printing.</a></li>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy.</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xl-3 col-md-3 col-sm-6 col-12 wow fadeInDown">
            <div class="ablist">
              <h3>LOREM IPSUM DUMMY</h3>
              <ul>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy text.</a></li>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy text of the printing.</a></li>
                <li><a href="javascript:void(0);">Lorem Ipsum is simply dummy.</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="aboutinnercontainer aboutinse">
      <div class="container">
        <div class="row">
          <div class="col-xl-7 col-md-7 col-sm-12 col-12 align-self-center wow fadeInDown">
            <div class="amimgcontent">
              <h3>Lorem Ipsum is a dummy text</h3>
              <h5>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</h5>
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
          </div>
          <div class="col-xl-5 col-md-5 col-sm-12 col-12 wow fadeInDown">
            <div class="abimgbx">
              <div class="abimgbxinner">
                <img src="{{ url('/')}}/images/img23.jpg" alt="" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    @else
    <h2>Coming Soon..........<h2>
    @endif -->

    @endsection