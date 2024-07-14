@if(count($allAdsList) > 0)
          <div class="topfilterpanel">            
            <div class="paginate">@lang('all_ads.showing')  {{ $allAdsList->firstItem() }} – {{ $allAdsList->lastItem() }} @lang('all_ads.results_of') {{ $allAdsList->total() }} ( {{ $allAdsList->lastPage() }} @lang('all_ads.pages'))</div>
            <a class="FilterBtn categorieslink" href="javascript:void(0);"><i class="fa fa-filter"></i>@lang('all_ads.filter')</a>
            <div class="filterboxright">
              <div class="sorttext">@lang('all_ads.sort_by') : </div>
              <div class="filterselect">
                <select class="form-control" onchange="filter_sortby(this);">  
                  <option value="sort=title&order=ASC" >@lang('all_ads.default')</option>                
                  <option value="sort=title&order=DESC" @if($sort_by == 'title&DESC') selected @endif>@lang('all_ads.name_z_a')</option>
                  <option value="sort=title&order=ASC" @if($sort_by == 'title&ASC') selected @endif>@lang('all_ads.name_a_z')</option>                  
                  <option value="sort=amount&order=ASC" @if($sort_by == 'amount&ASC') selected @endif>@lang('all_ads.price_low')</option>
                  <option value="sort=amount&order=DESC" @if($sort_by == 'amount&DESC') selected @endif>@lang('all_ads.price_high')</option>                 
                </select>
              </div>
              <div class="tabbox">
                <a href="javascript:void(0);" class="grid-view"  onclick="grid('grid-view');"><i class="fa fa-th" aria-hidden="true"></i></a>
                <a href="javascript:void(0);" class="list-view" onclick="list_view('list_view');"><i class="fa fa-list" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
          <div class="probxsec">
            <div class="row">
              @if($allAdsList)
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
                              <p>{{ \Illuminate\Support\Str::limit($ads->short_description, 66, $end=' ') }} <a href="{{ url(app()->getLocale().'/adsdetails')}}/{{$ads->getPageslug->slug}}">[...]</a></p>
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
                    <div class="ndtext">@lang('home.nodata')  <span>@lang('home.found')</span></div>
                </div>              
              </div>
            </div>
          </div>
          @endif