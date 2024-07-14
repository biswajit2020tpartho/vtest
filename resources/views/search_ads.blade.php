@extends('layout.default')

@section('content')
<section class="bannercontainer">
  <img src="{{ url('/')}}/images/banner-inner.jpg" alt="" />
  <div class="bannerinnercontent">
    @if($categoryDetails->resource->name)
    <h1>{{ $categoryDetails->resource->name}}</h1>
    @else
    <h1>@lang('all_ads.search_result')</h1>
    @endif
  </div>
</section>


<section class="listingcontainer">
  <div class="container">
    <div class="row">
      <div class="col-xl-3 col-md-4 col-sm-12 col-12 filtermobilepanel">
        <div class="projectfilterbox">
          <div class="projectfilterbxinner">
            <div class="filterheading">
              <div class="filterhleft">
                 @lang('all_ads.filter_by')
              </div>
              <div class="filterhright">
                <a href="javascript:void(0);" onClick="location = location;">@lang('all_ads.clear_filter')</a>
              </div>
            </div>
            <div class="panel-group filterboxouter" id="" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default filterbox">
                <div class="panel-heading filterbxheading">
                  <a class="ToggleIcon" role="button" data-toggle="collapse" data-parent="" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    @lang('all_ads.categories')
                  </a>
                </div>
                <div id="collapseOne" class="panel-collapse filterbxbody collapse in show" role="tabpanel" aria-expanded="true">
                  <div class="filterbxbodyinner pt-1 pb-0">
                    <div class="FilterInner">
                      @if(count($catList) > 0)
                        @foreach($catList as $list)
                        <div class="checkbox">
                          <input type="checkbox" @if($cat_id == $list->id) checked @endif id="{{ $list->name }}" name="" class="catcls" value="{{ $list->id }}">
                          <label for="{{ $list->name }}">{{ $list->name }}<span>({{ count($list->getCategorywiseAds)}})</span></label>
                        </div>
                        @endforeach
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default filterbox">
                <div class="panel-heading filterbxheading">
                  <a class="ToggleIcon" role="button" data-toggle="collapse" data-parent="" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                     @lang('all_ads.price')
                  </a>
                </div>
                
                <div id="collapseTwo" class="panel-collapse filterbxbody collapse in show" role="tabpanel" aria-expanded="true">
                  <div class="filterbxbodyinner">
                    <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="{{ $max_price }}" data-slider-step="5" data-slider-value="[{{ $min_price }},{{ $max_price }}]" id="sl2">
                    <div class="pricerangebx">
                      <div class="input-group">
                        
                        <div class="form-control">@lang('all_ads.min'): <span class="first">{{ $min_price }}</span></div>
                        <div class="input-group-prepend">
                          <span class="input-group-text">@lang('all_ads.to')</span>
                        </div>
                        <div class="form-control">@lang('all_ads.max'): <span class="sec">{{ $max_price }}</span></div>
                        <input type="hidden" id="min_p" value="{{ $min_price }}">
                        <input type="hidden" id="max_p" value="{{ $max_price }}"> 
            <input type="hidden" id="state_id" value="test">            
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             <div class="panel panel-default filterbox">
                <div class="panel-heading filterbxheading">
                  <a class="ToggleIcon" role="button" data-toggle="collapse" data-parent="" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                    @lang('all_ads.location')
                  </a>
                </div>
                <div id="collapseThree" class="filterbxbody collapse in show" role="tabpanel" aria-expanded="true">
                  <div class="filterbxbodyinner pt-1 pb-0">
                    <div class="searchbxfilter">
                      <input type="text" class="form-control" placeholder="Search State" name="search_state" id="search_state">
                    </div>
                    <div class="FilterInner shopprice">
                      <ul id="myid">
                        @if(count($state_list) > 0)
                          @foreach($state_list as $slist)
                          <li id="{{ $slist->id }}" value="{{ $slist->state_name }}"><a href="javascript:void(0);">{{ $slist->state_name }}</a></li>
                          @endforeach
                        @endif
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="panel panel-default filterbox">
                <div class="panel-heading filterbxheading">
                  <a class="ToggleIcon" role="button" data-toggle="collapse" data-parent="" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                     @lang('all_ads.customer_rating')
                  </a>
                </div>
                <div id="collapseFour" class="filterbxbody collapse in show" role="tabpanel" aria-expanded="true">
                  <div class="filterbxbodyinner pt-1 pb-0">
                    <div class="FilterInner shopprice">
                      <div class="checkbox">
                        <input type="checkbox" id="4above" value="4" class="rating_filter">
                        <label for="4above">4 <i class="fa fa-star"></i> & @lang('all_ads.above')</label>
                      </div>
                      <div class="checkbox">
                        <input type="checkbox" id="3above" value="3" class="rating_filter">
                        <label for="3above">3 <i class="fa fa-star"></i> & @lang('all_ads.above')</label>
                      </div>
                      <div class="checkbox">
                        <input type="checkbox" id="2above" value="2" class="rating_filter">
                        <label for="2above">2 <i class="fa fa-star"></i> & @lang('all_ads.above')</label>
                      </div>
                      <div class="checkbox">
                        <input type="checkbox" id="1above" value="1" class="rating_filter">
                        <label for="1above">1 <i class="fa fa-star"></i> & @lang('all_ads.above')</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-9 col-md-8 col-sm-12 col-12">
        <div class="prolistouter">
          <div class="listingbreadcrumb">
            <ol class="breadcrumb">
              <li><a href="{{ url('/')}}">@lang('all_ads.home')</a></li>
              @if($categoryDetails->resource->name)
              <li class="active">{{ $categoryDetails->resource->name}}</li>
              @else
              <li class="active">@lang('all_ads.search_result')</li>
              @endif
            </ol>
          </div>
          <div id="all_ads">
          @if(count($allAdsList) > 0)
          <div class="topfilterpanel">            
            <div class="paginate">@lang('all_ads.showing')  {{ $allAdsList->firstItem() }} – {{ $allAdsList->lastItem() }} @lang('all_ads.results_of') {{ $allAdsList->total() }} ( {{ $allAdsList->lastPage() }} @lang('all_ads.pages'))</div>
            <a class="FilterBtn categorieslink" href="javascript:void(0);"><i class="fa fa-filter"></i>@lang('all_ads.filter')</a>
            <div class="filterboxright">
              <div class="sorttext">@lang('all_ads.sort_by') :</div>
              <div class="filterselect">
                <select class="form-control" onchange="filter_sortby(this);">  
                  <option value="sort=title&order=ASC">@lang('all_ads.default')</option>                
                  <option value="sort=title&order=DESC">@lang('all_ads.name_z_a')</option>
                  <option value="sort=title&order=ASC">@lang('all_ads.name_a_z')</option>                  
                  <option value="sort=amount&order=ASC">@lang('all_ads.price_low')</option>
                  <option value="sort=amount&order=DESC">@lang('all_ads.price_high')</option>                 
                </select>
              </div>
              <div class="tabbox">
                <a href="javascript:void(0);" id="grid-view"><i class="fa fa-th" aria-hidden="true"></i></a>
                <a class="active" href="javascript:void(0);" id="list-view"><i class="fa fa-list" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
          <div class="probxsec">
            <div class="row">
              @if(count($allAdsList) > 0 )
                @foreach($allAdsList as $ads)
                <div class="product-list col-xl-12 col-md-12 col-sm-12 col-12 colproject">
                  <div class="projectlistbx">
                    <div class="prorow">
                      <div class="proimgleft">
                        <img src="{{ url('/')}}/{{  $ads->images }}" alt="" />
                      </div>
                      <div class="procontetleft">
                        <div class="procontentinner">
                          <div class="ptro">
                            <div class="ptroleft">
                              <h3><a href="{{ url(app()->getLocale().'/adsdetails')}}/{{$ads->getPageslug->slug}}">{{ $ads->title}}</a></h3>
                              <div class="loaction"><i class="fa fa-map-marker"></i>{{ $ads->getAdvtStates->state_name}}, {{ $ads->getAdvtCountry->country_name}}</div>
                              <p>{{ \Illuminate\Support\Str::limit($ads->short_description, 66, $end=' ') }} <a href="javascript:void(0);">[...]</a></p>
                              <!-- {!! html_entity_decode($ads->short_description) !!} -->
                            </div>
                            <div class="ptroright">
                              <div class="date"><i class="fa fa-calendar"></i>Posted: {{ date('d-m-Y',strtotime($ads->created_at)) }}</div>
                              <div class="pricebx">
                                <div class="pricebxinner">
                                  &euro;{{ $ads->amount }}
                                </div>
                              </div>
                              <div class="areabx">
                                <div class="rating">
                                  @for ($i = 0; $i < 5; $i++)
                                      @if($ads->rating > $i)
                                        <i class="fa fa-star"></i>
                                      @else
                                        <i class="fa fa-star-o"></i>
                                      @endif
                                  @endfor
                                </div>
                                <!--<div class="areabxbtm">
                                  <span class="areatop">5000</span>
                                  <span class="areabottom">Area in sq ft</span>
                                </div>-->
                              </div>
                            </div>
                          </div>
                         @if(count($ads->getAdvtamenities) >0)
                          <div class="amentiesbox">
                            @php $i=1 @endphp
                            @if($ads->getAdvtamenities)
                              @foreach($ads->getAdvtamenities as $amenities)
                              <div class="amentiestx">
                                <div class="amentiestxinner">
                                  <i class="icon {{$amenities->getAmenties->image}}"></i>
                                  <span>
{{ \Illuminate\Support\Str::limit($amenities->getAmenties->name, 10, $end='..') }}
                                  </span>
                                </div>
                              </div>
                              @if($i == 4)
                              @php break @endphp
                              @endif

                              @php $i++ @endphp
                              @endforeach
                            @endif
                            @if($ads->getAdvtamenities)
                            <div class="amentiestx">
                              <div class="amentiestxinner">
                                <a id="AmentiesDrop" href="javascript:void(0);"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <div id="AmentiesDropBox" class="amentiesnav">
                                  <ul>
                                      @foreach($ads->getAdvtamenities as $amenities)
                                    <li><a href="javascript:void(0);"><i class="icon {{$amenities->getAmenties->image}}"></i>{{$amenities->getAmenties->name}}</a></li>
                                    @endforeach
                                    
                                  </ul>
                                </div>
                              </div>
                            </div>
                            @endif
                          </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              @endif            
              
                <div class="col-12">
                  <div class="spinnerbx">
                    {{ $allAdsList->links() }}
                  </div>
                </div>
            </div>
          </div>
          @else
          <div class="probxsec">
            <div class="row">
              <div class="col-xl-12 col-md-12 col-sm-12 col-12 colproject">
                <div class="noproduct">
                    <span class="noimgdata">
                      <img src="http://wgi-aws-php-1241812835.ap-south-1.elb.amazonaws.com/p2/venkatesh/public/images/nodata.png" alt="" />
                    </span>
                    <div class="ndtext">@lang('home.nodata') <span>@lang('home.found')</span></div>
                </div>              
              </div>
            </div>
          </div>
          @endif
        </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection