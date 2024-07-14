    @extends('layout.default')

    @section('content')
    @php 
    $slug = end(explode("/", $_SERVER['REQUEST_URI']));
	@endphp
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
	          <h3>@lang('dashboard.dashboard_txt') / @lang('dashboard.wallets_txt')</h3>
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
	          <form name="mail_list" id="mail_list" method="POST" action="{{ url('en/mail-change-state')}}">
	          	@csrf
	          	<input type="hidden" name="redirect_url" value="{{$redirect_url}}">
	          <div class="row">	          
	          <div class="col-xl-12 col-md-12 col-sm-12 col-12">
	              <div class="row">
	              	<div class="col-xl-3 col-md-3 col-sm-3 leftpanel_box">
					  	<div class="compose_link"><a href="{{ url('/compose-mail')}}">Compose</a></div>
		               	<ul class="sf-menu">
						  <li @if($slug =="mail-inbox") class="active" @endif><a href="{{ url('/mail-inbox')}}"><i class="fa fa-envelope-o"></i><span>Inbox</span></a></li>
						  <li @if($slug =="mail-sendbox") class="active" @endif><a href="{{ url('/mail-sendbox')}}"><i class="fa fa-paper-plane-o"></i><span>Sent Mail</span></a></li>  
						  <li @if($slug =="mail-trash") class="active" @endif><a href="{{ url('/mail-trash')}}"><i class="fa fa-trash-o"></i><span>Trash</span></a></li>  
						</ul>
				    </div>				    
				    <div class="col-xl-9 col-md-9 col-sm-9 rightpanel_box">
					 @if(count($sendEmailDetails) > 0)
						<div class="mselect">
							<select name="change_val" id="change_val">
								<option value="">Bulk Action</option>
								@if($redirect_url == "MailController@mail_trash")
									<option value="delete">Delete</option>
									<option value="move_to_inbox">Move to inbox</option>
								@else
									<option value="trash">Trash</option>
									<option value="read">Mark as Read</option>
									<option value="unread">Mark as Unread</option>	
								@endif		                                       
						</select>
					   </div>	
					   	               		    	
						<div class="table_custom mail">
			                <div class="table-responsive">
			                    <table class="table table-striped table-bordered" id="inquery_lis" style="width:100%">
			                    <thead>
			                      <tr>
			                        <th scope="col">
										<span class="pscheckbox">
											<label>
												<input type="checkbox" id="selectall">
												<span></span>
											</label>
										</span>
									</th>
			                        <th>SL No</th>
			                        <th scope="col">Sender Name</th>
			                        <th scope="col" class="msgcol">Message</th>
			                        <th scope="col" class="datecol">Date</th>           
			                        <th scope="col" class="lastcell">Action</th>
			                      </tr>
			                    </thead>
			                    <tbody>
			                      @if(count($sendEmailDetails) > 0)
			                      @php $i=1;@endphp
			                      @foreach($sendEmailDetails as $value)
			                      <tr>
			                        <td>
										<span class="pscheckbox">
											<label>
												<input type="checkbox" class="checkboxall" name="select_all[]" value="{{ $value->id }}" id="select_all">
												<span></span>
											</label>
										</span>
									
									</td>
			                        <td scope="col">{{ $i++ }}</th>
			                        <td scope="col">{{ $value->to_email }}</th>
			                        <td scope="col">{{ \Illuminate\Support\Str::limit($value->message, 66, $end='....') }}</th>
			                        <td scope="col">{{ $value->created_at }}</th>
			                        <td scope="col" class="lastcell">
			                          <button type="button" name="edit" id="{{ $value->id }}" class="message-view btn btn-primary btn-sm">View</button>
			                        </th>
			                      </tr>
			                      @endforeach
			                      @else
			                      <tr>
			                      	<td colspan="6"><div class="text-center">No data Found!</div></td>
			                      </tr>
			                      @endif
			                    </tbody> 
			                    <tfoot>
			                      <tr>
			                        <th scope="col">#</th>
			                        <th scope="col">SL No</th>
			                        <th scope="col">Sender Name</th>
			                        <th scope="col">Message</th>
			                        <th scope="col">Date</th>           
			                        <th scope="col" class="lastcell">Action</th>
			                      </tr>
			                    </tfoot>
			                    </table>
			                </div>
						</div>
					@else
						<div class="nomail_record">
							<i class="fa fa-envelope-o"></i> <span>No record found</span>
						</div>
					@endif

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
	<!--------------------Modal--------------------->
	<div class="modal fade exviewdetailsmodal mailmodal" id="messageDetailsview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Message Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="get" action="{{ url('en/compose-mail') }}">
	        <div class="modal-body">
	       <div class="row">
            <label class="control-label col-md-4" >Subject : </label>
            <div class="col-md-8">
             <p id="modal_subject"></p>
            </div>
          </div>
          
           <div class="row">
            <label class="control-label col-md-4" >Message : </label>
            <div class="col-md-8">
               <p id="modal_message"></p>
            </div>
           </div>
	      </div>
	      <div class="modal-footer">
	         <button class="btn btn-secondary" type="submit" id="{{ $package->id }}">REPLY</button>	        
	      </div>
	  </form>
	    </div>
	  </div>
	</div>
    @endsection