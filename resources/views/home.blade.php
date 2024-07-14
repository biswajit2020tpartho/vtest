    @extends('layout.default')

    @section('content')
    <section class="bannercontainer">
        <div id="HomeBanner" class="owl-carousel owl-theme">
            @foreach($getBanner as $banner)
            <div class="item">
            <img class="owl-lazy" data-src="{{ url('/') }}/{{ $banner->image }}" alt="{{ $banner->title }}" />
            </div>
            @endforeach
            

        </div>

        <div class="bannersearchouter">
            <div class="container">
            <div class="row">
                <div class="col-12">
                <div class="binnerouter">
                    <div class="row">
                    <div class="col-12 wow fadeInDown">
                        <h1>@lang('home.banner_txt_1')</h1>
                        <p>@lang('home.banner_txt_2')</p>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-12">
                        <div class="bannersearchbx wow fadeInUp">
                        <form name="add_post" id="search" method="get" action="{{ url(app()->getLocale().'/search-result')}}" enctype="multipart/form-data">
                        
                        <div class="row ml-n1 mr-n1">
                            <div class="searchcolumn">
                            <div class="form-group">
                                <select class="form-control" name="cat_id">
                                <option value="">@lang('home.ads_cat_txt')</option>
                                @foreach($categorie as $cat)
                                <option value="{{ $cat->id}}">{{ $cat->name}}</option>
                                @endforeach                                
                                </select>
                            </div>
                            </div>
                            <div class="searchcolumn">
                            <div class="form-group">
                                <i class="fa fa-map-marker"></i>
                                <input type="text" class="form-control" placeholder="@lang('home.loc_txt')" name="location">
                            </div>
                            </div>
                            <div class="searchcolumn">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="@lang('home.key_txt')" name="keyword">
                            </div>
                            </div>
                            <div class="searchcolumn">
                            <div class="form-group">
                                <select class="form-control" name="serch_price">
                                <option selected="" hidden="" value="">@lang('home.price_txt')</option>
                                <option value="1000"><i class="fa fa-euro"></i>1000</option>
                                <option value="1500"><i class="fa fa-euro"></i>1500</option>
                                <option value="2000"><i class="fa fa-euro"></i>2000</option>
                                </select>
                            </div>
                            </div>
                            <div class="searchbtncolumn">
                            <button class="searchbtn"><i class="fa fa-search"></i><span>@lang('home.search_txt')</span></button>
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
    <section class="featuredcatcontainer">
    <div class="container">
        <div class="row">
        <div class="col-12 wow fadeInDown">
            <h2>@lang('home.feature_cat_txt')</h2>
        </div>
        </div>
        <div class="row">
        <div class="col-12">
            <div id="FeaturedCategories" class="owl-carousel owl-theme">
            @foreach($featureCategory as $category)
             <a href="{{ url(app()->getLocale().'/all-ads')}}/{{$category->getPageslug->slug}}"><div class="item wow fadeInDown">
                <div class="fcatebox">
                <div class="fcateboxouter">
                    <div class="fcateboxinner">
                    <div class="fcateicon"><img src="{{ url('/') }}/{{ $category->image }}" alt="" /></div>
                   <div class="fcatetext">{{ $category->name}}</div>
                    </div>
                </div>
                </div>
            </div></a>
            @endforeach
            </div>
        </div>
        </div>
    </div>
    </section>

    <section class="topadcontainer">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-xl-5 col-md-5 col-sm-12 col-12 mb-3 wow fadeInDown">
            <div class="topadbox">
            <a href="javascript:void(0);"><img src="images/ad1.jpg" alt="" /></a>
            </div>
        </div>
        <div class="col-xl-5 col-md-5 col-sm-12 col-12 mb-3 wow fadeInDown">
            <div class="topadbox">
            <a href="javascript:void(0);"><img src="images/ad2.jpg" alt="" /></a>
            </div>
        </div>
        </div>
    </div>
    </section>

    <section class="featuredadcontainer">
    <div class="container">
        <div class="row">
        <div class="col-12 wow fadeInDown">
            <h2>@lang('home.feature_ads_txt')</h2>
        </div>
        </div>
        <div class="row ml-n2 mr-n2">
        @foreach($advertisement as $ads)
        <div class="col-xl-3 col-md-4 col-sm-6 col-12 pl-2 pr-2 mb-4 wow fadeInDown">
            <div class="featuredadbox">
            <div class="featuredadimg">
                <img src="{{ url('/') }}/{{ $ads->images }}" alt="" />
                <span class="featuredtag">Featured</span>
                <div class="featuredovarlay">
                <div class="ratinginner">
                    <div class="starrating">
                    @for ($i = 0; $i < 5; $i++)
                        @if($ads->rating > $i)
                          <i class="fa fa-star"></i>
                        @else
                          <i class="fa fa-star-o"></i>
                        @endif
                    @endfor
                    </div>
                    <div class="heartbx" id="heartbx_{{$ads->id}}">                        
                        @if(count($ads->getAdvtwishlist)>0)
                        <a href="javascript:void(0);" onclick="wishlist.add('{{$ads->id}}');"><i class="fa fa-heart"></i></a>                    
                        @else
                        <a href="javascript:void(0);" onclick="wishlist.add('{{$ads->id}}');"><i class="fa fa-heart-o"></i></a>                 
                        @endif
                    </div>
                </div>
                </div>
            </div>
            <div class="featuredadcontent">
                <div class="catename">{{$ads->getAdvtCategory->name}}</div>
                <div class="catecontent">
                <h3><a href="{{ url(app()->getLocale().'/adsdetails')}}/{{$ads->getPageslug->slug}}">{{ $ads->title}}</a></h3>
                <div class="location">
                    <i class="fa fa-map-marker"></i>
                    {{ $ads->getAdvtStates->state_name}}, {{ $ads->getAdvtCountry->country_name}}
                </div>
                <div class="pricebx">
                    <div class="price"><i class="fa fa-euro"></i>{{ $ads->amount }}</div>
                    <div class="posteddate">Posted: {{ date('d-m-Y',strtotime($ads->created_at)) }}</div>
                </div>
                </div>
            </div>
            </div>
        </div>
        @endforeach
        </div>
        <div class="row">
        <div class="col-12 text-center wow fadeInDown">
            <a href="{{ url('/')}}/all-ads" class="viewallbtn"><span>@lang('home.view_all')</span><i class="icon icon-arrow-thin-right"></i></a>
        </div>
        </div>
    </div>
    </section>

    <section class="topad2container">
    <div class="container">
        <div class="row justify-content-center">
        <div class="col-xl-6 col-md-6 col-sm-12 col-12 mb-3 wow fadeInDown">
            <div class="topadbox">
            <a href="javascript:void(0);"><img src="images/ad3.jpg" alt="" /></a>
            </div>
        </div>
        <div class="col-xl-6 col-md-6 col-sm-12 col-12 mb-3 align-self-end wow fadeInDown">
            <div class="topadbox">
            <a href="javascript:void(0);"><img src="images/ad4.jpg" alt="" /></a>
            </div>
        </div>
        </div>
    </div>
    </section>

    <section class="howitcontainer">
    <div class="howitcontainerinner">
        <div class="container">
        <div class="row">
            <div class="col-12 zindex2 wow fadeInDown">
            <h2>@lang('home.how_it_work')</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-md-12 col-sm-12 col-12 zindex2">
            <div class="row justify-content-center">
                @foreach($howit_works as $val)
                <div class="col-xl-3 col-md-3 col-sm-6 col-12 howitcolumn text-center wow fadeInDown">
                    <div class="howitbox">
                        <div class="howitboxouter">
                        <div class="howitboxinner">
                            <div class="howiticon"><img src="{{ url('/') }}/{{ $val->image }}" alt="{{$val->name[app()->getLocale()]}}" /></div>
                            <div class="howittext">{{$val->name[app()->getLocale()]}}</div>
                        </div>
                        </div>
                    </div>
                </div>
                @endforeach
               
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>

    <section class="explorelocationcontainer">
    <div class="container">
        <div class="row">
        <div class="col-12 wow fadeInDown">
            <h2>@lang('home.exp_loaction')</h2>
        </div>
        </div>
        <div class="row ml-n2 mr-n2">
        @if(count($explore_location) > 0)
        @foreach($explore_location as $loaction)         
            <div class="col-xl-3 col-md-4 col-sm-6 col-12 pl-2 pr-2 mb-4 wow fadeInDown">
                <a href="{{ url(app()->getLocale().'/all-ads')}}/{{$loaction->getPageslug->slug}}">
                <div class="explorelocationbox">
                <div class="explorelocationimg">
                    <img src="{{ url('/') }}/{{ $loaction->image }}" alt="{{ $loaction->state_name }}" />
                    <div class="exploreheading">{{ $loaction->state_name }}</div>
                </div>
                </div>
                </a>
            </div>
        @endforeach
        @endif        
        </div>
    </div>
    </section>

    <section class="aboutcontainer">
    <div class="aboutcontainerinner">
        <div class="container">
        <div class="row justify-content-end">
            <div class="col-xl-5 col-md-7 col-sm-12 col-12 wow fadeInDown">
            <div class="aboutcontent">
                <h2>@lang('home.about_title')</h2>
                <h5>@lang('home.banner_txt_1')</h5>
                <p>{!! html_entity_decode($about->short_description[app()->getLocale()] ) !!}</p>
                
                <a href="{{ url(app()->getLocale().'/page/about-us')}}" class="viewallbtn"><span>@lang('home.view_all')</span><i class="icon icon-arrow-thin-right"></i></a>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>


    <section class="downloadappcontainer">
    <div class="container">
        <div class="row">
        <div class="col-xl-6 col-md-6 col-sm-6 col-12 align-self-center wow fadeInDown">
            <div class="mobileappbx">
            <h2>@lang('home.download_txt')</h2>
            <h5>Consectetur adipiscing elit, sed do eiu</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiu smod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo.</p>
            <a href="{{ $settings->app_store}}" target="_blank" class="appbtn"><img src="images/apple-store.png" alt="Apple Store"></a>
            <a href="{{ $settings->google_store}}" target="_blank" class="appbtn"><img src="images/android-store.png" alt="Android Store"></a>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 col-sm-6 col-12 align-self-end wow fadeInUp">
            <div class="mobileappimg">
            <span><img src="images/mobile-app-img.png" alt="" /></span>
            </div>
        </div>

        </div>
    </div>
    </section>
    @endsection


    