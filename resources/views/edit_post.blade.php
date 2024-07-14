    @extends('layout.default')

    @section('content')

    <div class="dashboard">
	  <div class="dashboardcontainer">
	    <div class="afterloginnavigation">
	      <div class="usercolumn">
	        <div class="userimg">
	        @if($userDetails->photo)
	          <img src="{{ url('/')}}/{{ $userDetails->photo }}" alt="User Image">
	        @else
	          <img src="{{ url('/')}}/images/user-noimage.jpg" alt="User Image">
	        @endif
	        </div>
	        <h3>{{ $userDetails->name }}</h3>
	        <!-- <p>Visual artist</p> -->
	      </div>
	      <div class="usernavlist">
	         @include('layout.sidebar') 
	      </div>
	    </div>
	    <div class="layoutcontainer">
	      <div class="layoutcontent">
	        <div class="layoutcontentinner">
	          <div class="afterrightbox">
	          <a class="profilebtn" href="javascript:void(0);"><i class="icon icon-user"></i><span>Profile Nav</span></a>
	          <h3>Dashboard / Edit Ads</h3>
	          @if(Session::has('error_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-danger alert-dismissible') }}">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
              @if(Session::has('success_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-success alert-dismissible') }}">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
               @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
              @endif
	          <div class="row">
	          	 
	          	<form name="edit_post" id="edit_post" method="post" action="{{ url(app()->getLocale().'/edit-post')}}" enctype="multipart/form-data">
	          	@csrf
	          	<input type="hidden" name="ads_id" value="{{ $adsDetails->id }}">
	            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
	              <div class="row ml-n2 mr-n2">
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="fa fa-audio-description"></i>
	                      <input type="text" class="form-control" placeholder="Ads Name" name="title" id="title" value="{{ $adsDetails->title}}">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                     <i class="fa fa-list-ul"></i>	                     
	                      <select class="form-control" name="category" id="category" onchange="getaminities(this);">
                            <option value="">Please select category</option>
                            @if(count($categoryList)>0)
                            @foreach($categoryList as $val)                            
                            <option value="{{ $val->id}}" @if($adsDetails->cat_id == $val->id) selected @endif >{{ $val->name}}</option>
                            @endforeach
                            @endif                 
                          </select>  
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="fa fa-money"></i>
	                      <select class="form-control" name="amenities[]" id="amenities" multiple>
                            <!-- <option value="">Please select amenities</option> -->
                            @if(count($amenities) > 0)
                            	@foreach($amenities as $list)
                            	<option value="{{ $list->id}}" @if(in_array($list->id, $advamenities)) selected @endif>{{ $list->name}}</option>
                            	@endforeach
                            @endif       
                          </select> 
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="fa fa-money"></i>
	                      <input type="text" class="form-control" placeholder="price (&euro;)" id="price" name="price" value="{{$adsDetails->amount}}">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="fa fa-globe"></i>
	                      <select class="form-control" name="country" id="country" onchange="getstate(this);">
                            <option value="">Please select country</option>
                            @if(count($country)>0)
                            @foreach($country as $val)                            
                            <option value="{{ $val->id}}" @if($adsDetails->country_id == $val->id) selected @endif>{{ $val->country_name}}</option>
                            @endforeach
                            @endif                 
                          </select>            
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="fa fa-bank"></i>
	                     <select class="form-control" name="state" id="state" onchange="getCity(this);">
                            <option value="">Please select state </option>
                            @if(count($stateList)>0)
                            @foreach($stateList as $val)                            
                            <option value="{{ $val->id}}" @if($adsDetails->state_id == $val->id) selected @endif>{{ $val->state_name}}</option>
                            @endforeach
                            @endif                            
                          </select>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="fa fa-building-o"></i>
	                      <select class="form-control" name="city" id="city">
                            <option value="">Please select city</option>                   
                            @if(count($cityList)>0)
                            @foreach($cityList as $val)                            
                            <option value="{{ $val->id}}" @if($adsDetails->city_id == $val->id) selected @endif>{{ $val->city_name}}</option>
                            @endforeach
                            @endif 
                          </select>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="fa fa-audio-description"></i>
	                      <input type="text" class="form-control" name="ads_tag" id="ads_tag" placeholder="Advertisement tag">	                     
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-location"></i>
	                      <textarea class="form-control" placeholder="Location" id="location" name="location">{{$adsDetails->location}}</textarea>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-edit"></i>
	                      <textarea class="form-control" placeholder="Short Description" id="short_description" name="short_description">{{$adsDetails->short_description}}</textarea>
	                    </div>
	                  </div>
	                </div>

	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-edit"></i>
	                      <textarea class="form-control" placeholder="Description" id="description" name="description">{{$adsDetails->description}}</textarea>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-password"></i>
	                      <input type="file" class="form-control" name="image" id="image">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-password"></i>
	                      <select class="form-control" name="status" id="status">
                            <option value="">Please select status</option>
                            <option value="1" @if($adsDetails->status == "1") selected @endif>Active</option>                   
                            <option value="0" @if($adsDetails->status == "0") selected @endif>Inactive</option>                           
                          </select>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-6 col-sm-6 col-6 pl-2 pr-2 full768">
	                  <button class="updatebtn" type="submit">Update</button>
	                </div>
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
    @endsection