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
		          <h3>@lang('dashboard.dashboard_txt') / @lang('dashboard.purchase_package_txt')</h3>
		          <div class="purchagepagebox">
		          	 @if(Session::has('error_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-danger alert-dismissible') }}">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
              @if(Session::has('success_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-success alert-dismissible') }}">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
			        <div class="row ml-n1 mr-n1">
			        	@if($packagedetails)
				        	@foreach($packagedetails as $package)
			                <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 pl-1 pr-1 mb-3">
			                  <div class="membershipbox @if($currentPackage==$package->id) active @endif">
			                    <div class="mtopheading">{{$package->title[app()->getLocale()]}}</div>
			                    <div class="mprice"><i class="fa fa-euro"></i>{{$package->price}}<span>/ {{$package->expires_in_months}} Month</span></div>
			                    <div class="mtopheading">Credit Points : {{$package->credit_point}}</div>
			                    {!! html_entity_decode($package->description[app()->getLocale()]) !!}
			                    <button class="selectbtn packageDetails" type="button" id="{{ $package->id }}">Select</button>
			                  </div>
			                </div>	
			                @endforeach
		                @else
		                	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 pl-1 pr-1 mb-3">No Package Found!</div>
		                @endif     

	              	</div>
	              	<div class="col-12">
	                  <div class="spinnerbx">
	                    {{ $packagedetails->render() }}
	                  </div>
	                </div>
	            </div>
		        </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<!-----------------------Modal Package------------------------>
	<div class="modal fade exviewdetailsmodal" id="packageModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Package Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="POST" action="{{ url('en/create-payment') }}">
            @csrf
            <input type="hidden" name="amount" value="" id="amount">
            <input type="hidden" name="item_id" value="" id="item_id">
	      <div class="modal-body">	      	
	      	<div class="purchagepagebox">
			    <div class="row ml-n1 mr-n1">			       	
	              <div class="membershipbox">
	                <div class="mtopheading" id="pck_name"></div>
	                <div class="mprice" id="pck_price"></div>
	                <div class="mtopheading" id="pck_crept"></div>
	                <div id="pck_description"></div>	         
	              </div>		            
            	</div>
            </div>         
	      </div>
	      <div class="modal-footer">
	        <button class="btn btn-secondary" type="submit" id="{{ $package->id }}">Buy Now</button>
	      </div>
	    </form>
	    </div>
	  </div>
	</div>

    @endsection