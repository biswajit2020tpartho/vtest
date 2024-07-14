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
	          @if(Session::has('success_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-success alert-dismissible') }}">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
	          <h3>@lang('dashboard.dashboard_txt')</h3>
	          <div class="row">
	            <div class="col-sm-12">
	              <!-- <fieldset class="userviewsec">
	                <legend>User Name</legend>
	                <p><i class="icon icon-user"></i>{{ $userDetails->name }}</p>
				  </fieldset> -->
				  
					<div class="dashboard_block">
						<div class="row">
							<div class="col-sm-3">
								<a href="{{ url('/update-account')}}" class="dbox">
									<div class="dboxinn">
										<i class="icon icon-user-pencil"></i>
										<h3>@lang('dashboard.updat_account_txt')</h3>
									</div>
								</a>
							</div>
							<div class="col-sm-3">
								<a href="{{ url('/purchase-packages')}}" class="dbox">
									<div class="dboxinn">
										<i class="icon icon-shopping-basket"></i>
										<h3>@lang('dashboard.purchase_package_txt')</h3>
									</div>
								</a>
							</div>
							<div class="col-sm-3">
								<a href="{{ url('/wallet')}}" class="dbox">
									<div class="dboxinn">
										<i class="icon icon-wallet"></i>
										<h3>@lang('dashboard.wallets_txt')</h3>
									</div>
								</a>
							</div>
							@if($userDetails->id_cms_privileges == 3)
							<div class="col-sm-3">
								<a href="{{ url('/post-add')}}" class="dbox">
									<div class="dboxinn">
										<i class="icon icon-speaker"></i>
										<h3>@lang('dashboard.post_add_txt')</h3>
									</div>
								</a>
							</div>
							<div class="col-sm-3">
								<a href="{{ url('/view-inquiries')}}" class="dbox">
									@if($count_inquery > 0)
									<span class="notecount">{{ $count_inquery}}</span>
									@endif
									<div class="dboxinn">										
										<i class="icon icon-speaker"></i>
										<h3>@lang('dashboard.view_inq_txt')</h3>
									</div>
								</a>
							</div>
							@endif
						</div>
					</div>














	              <!-- <div class="row ml-n2 mr-n2">
	                <div class="col-xl-6 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-phone"></i>
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
	                      <input type="password" class="form-control" placeholder="Password" name="">
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <div class="form-group">
	                    <div class="formgroupinner">
	                      <i class="icon icon-edit"></i>
	                      <textarea class="form-control" placeholder="Description">{{ $userDetails->description }}</textarea>
	                    </div>
	                  </div>
	                </div>
	                <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
	                  <button class="updatebtn" type="button">Update</button>
	                </div>
	              </div> -->
	            </div>
	          </div>
	        </div>
	        </div>
	        </div>
	    </div>
	  </div>
	</div>


    @endsection