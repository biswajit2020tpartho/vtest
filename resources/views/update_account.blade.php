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
	          <h3>@lang('dashboard.dashboard_txt') / @lang('dashboard.updat_account_txt')</h3>
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
               
	          	<form name="" method="post" action="{{ url('en/user-update')}}" enctype="multipart/form-data">
	          	@csrf
	          	<input type="hidden" name="user_id" value="{{ $userDetails->id }}">
	            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
	              <fieldset class="userviewsec">
	                <legend>User Name</legend>
	                <p><i class="icon icon-user"></i>{{ $userDetails->name }}</p>
	              </fieldset>
	              <div class="row ml-n2 mr-n2">
	                <div class="col-xl-6 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-user"></i>
	                      <input type="text" class="form-control" placeholder="User Name" name="user_name" value="{{ $userDetails->name }}">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-6 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-phone"></i>
	                      <input type="text" class="form-control" placeholder="Mobile Number" name="phone_number" value="{{ $userDetails->phone_number }}">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="fa fa-envelope-o"></i>
	                      <input type="email" class="form-control" name="email" value="{{ $userDetails->email }}" readonly="">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-password"></i>
	                      <input type="password" class="form-control" placeholder="Password" name="user_password" id="user_password">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-edit"></i>
	                      <textarea class="form-control" placeholder="Description" id="description" name="description">{{ $userDetails->description }}</textarea>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group inputfile">
	                    <div class="formgroupinner">
	                      <input type="file" class="form-control" name="user_image" id="user_image">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
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