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
	          <h3>Dashboard / MailBox</h3>
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
	          <form method="POST" action="{{ url('en/sent-mail-admin')}}" enctype="multipart/form-data" name="compose_mail" id="compose_mail">
	          	@csrf
	          <div class="row">	          
	          <div class="col-xl-12 col-md-12 col-sm-12 col-12">
	              <div class="row">
				  	<div class="col-xl-3 col-md-3 col-sm-3 leftpanel_box">
					  	<div class="compose_link"><a href="{{ url('/compose-mail')}}">Compose</a></div>
		               	<ul class="sf-menu">
						  <li><a href="{{ url('/mail-inbox')}}"><i class="fa fa-envelope-o"></i><span>Inbox</span></a></li>
						  <li><a href="{{ url('/mail-sendbox')}}"><i class="fa fa-paper-plane-o"></i><span>Sent Mail</span></a></li>  
						  <li><a href="{{ url('/mail-trash')}}"><i class="fa fa-trash-o"></i><span>Trash</span></a></li>  
						</ul>
				    </div>
				    <div class="col-xl-9 col-md-9 col-sm-9 rightpanel_box">
				    	<div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
							<div class="form-group">
                            <div class="formgroupinner selectinput">
                              <i class="fa fa-envelope-o"></i>
                              <select class="form-control" name="to_email" id="to_email">
                                <option value="">To</option>
                                <option value="Admin">Admin</option>
                              </select>                             
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                          <div class="form-group">
                            <div class="formgroupinner">
                              <i class="fa fa-envelope-o"></i>
                              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                            </div>
                          </div>
                        </div>                  
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12 pl-2 pr-2">
                          <div class="form-group">
                            <div class="formgroupinner">
                              <i class="icon icon-edit"></i>
                              <textarea class="form-control" placeholder="Messaage" id="message" name="message"></textarea>
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