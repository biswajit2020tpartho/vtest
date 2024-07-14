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
	          <h3>@lang('dashboard.dashboard_txt') / @lang('dashboard.others_mail_txt')</h3>
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
	          <form class="ml-n2 mr-n2" name="compose_mail_others" id="compose_mail_others" method="POST" action="{{ url('en/sent-mail-others')}}">
	          	@csrf
	          <div class="row">	          
	            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
	              <div class="row">	              	
      				    <div class="col-xl-12 col-md-12 col-sm-12">
      				    	<div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
      							  <div class="form-group">
                        <div class="formgroupinner selectinput">
                          <i class="fa fa-envelope-o"></i>
                          <select class="form-control" name="to_email" id="to_email" onchange="showhide_email_block(this);">
                            <option value="">Type</option>                            
                            <option value="customer">Customer</option>
                            <option value="any_email">Any Email</option>
                          </select>                             
                        </div>
                      </div>
                    </div>
                    <div class="customer-block col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2" style="display: none;">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="fa fa-envelope-o"></i>
                          <select class="form-control" name="customer_email[]" id="customer_email">
                           @if($allCustomer)                                               
                           @foreach($allCustomer as $all)
                           <option value="{{ $all->email }}">{{ $all->email}}</option>
                           @endforeach
                           @endif
                          </select>                             
                        </div>
                      </div>
                    </div>
                    <div class="any-email-block col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2" style="display: none;">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="fa fa-envelope-o"></i>
                          <input type="text" class="form-control" name="any_email" id="any_email" placeholder="Please enter any valid email">
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="fa fa-address-book-o"></i>
                          <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                        </div>
                      </div>
                    </div>                  
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <div class="form-group">
                        <div class="formgroupinner">
                          <i class="icon icon-edit"></i>
                          <textarea class="form-control" placeholder="Messages" id="message" name="message"></textarea>
                        </div>
                      </div>
                    </div>                
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                      <button class="updatebtn" type="submit">Send</button>
                    </div>
      					  </div>
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
    @endsection