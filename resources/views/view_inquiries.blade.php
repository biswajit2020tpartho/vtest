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
			  <h3>@lang('dashboard.dashboard_txt') / @lang('dashboard.view_inq_txt')</h3>
			  <div class="table_custom">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="inquery_lis" style="width:100%">
					<thead>
						<tr>
						<th scope="col">#</th>
						<th scope="col">Ads Name</th>
						<th scope="col">Sender Name</th>
						<th scope="col">Sender Email</th>
						<th scope="col">Sender Phone</th>
						<!-- <th scope="col">Message</th> -->
						<th scope="col" class="lastcell">Action</th>
						</tr>
					</thead>
					<tbody>
						@if(count($inqueryDetails) > 0)
							@php $i=1;@endphp
							@foreach($inqueryDetails as $val)
							<tr>
								<td>{{ $i++ }}</td>
								<td>{{ $val->getAdvtDetails->title }}</td>
								<td>{{ $val->name }}</td>
								<td>{{ $val->email }}</td>
								<td>{{ $val->phone_no }}</td>
								<!-- <td>{{ $val->message }}</td> -->
								<td  class="lastcell"><button type="button" name="edit" id="{{ $val->id }}" class="view btn btn-primary btn-sm">View</button></td>
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
						<th scope="col">Ads Name</th>
						<th scope="col">Sender Name</th>
						<th scope="col">Sender Email</th>
						<th scope="col">Sender Phone</th>
						<!-- <th scope="col">Message</th> -->
						<th scope="col" class="lastcell">Action</th>
						</tr>
					</tfoot>
					</table>
				</div>
			  </div>
			  
	          <div class="row">
                <div class="col-12">
                  <div class="spinnerbx">
                    {{ $inqueryDetails->links() }}
                  </div>
                </div>
              </div>
	        </div>
	        </div>
	        </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade exviewdetailsmodal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">View enquires </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <div class="row">
            <label class="control-label col-md-4" >Name : </label>
            <div class="col-md-8">
             <p id="name"></p>
            </div>
          </div>
          <div class="row">
            <label class="control-label col-md-4" > Email : </label>
            <div class="col-md-8">
               <p id="email"></p>
            </div>
          </div>
          <div class="row">
            <label class="control-label col-md-4" >Phone No : </label>
            <div class="col-md-8">
                <p id="phone_no"></p>
            </div>
          </div>
           <div class="row">
            <label class="control-label col-md-4" >Message : </label>
            <div class="col-md-8">
               <p id="message"></p>
            </div>
           </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        
	      </div>
	    </div>
	  </div>
	</div>
    @endsection