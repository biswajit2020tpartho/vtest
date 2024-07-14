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
			  <h3>@lang('dashboard.dashboard_txt') / Wish List</h3>
			  <div class="table_custom">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="inquery_lis" style="width:100%">
					<thead>
						<tr>
						<th scope="col">#</th>
						<th scope="col">Image</th>
						<th scope="col">Ads Name</th>
						<th scope="col">Price</th>						
						<th scope="col" class="lastcell">Action</th>
						</tr>
					</thead>
					<tbody>
						@if(count($wishlist) > 0)
							@php $i=1;@endphp
							@foreach($wishlist as $val)
							<tr>
								<td>{{ $i++ }}</td>
								<td><span class="viewimg"><img src="{{ url('/')}}/{{ $val->getwishlistDetails->images }}" alt="{{ $val->getwishlistDetails->title }}"></span></td>
								<td>{{ $val->getwishlistDetails->title }}</td>								
								<td>&euro; {{ $val->getwishlistDetails->amount }}</td>
								<!-- <td>{{ $val->message }}</td> -->
								<td  class="lastcell">
									<a href="{{ url(app()->getLocale().'/remove-wishlist/'.$val->id.'/'.$val->getwishlistDetails->title)}}" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Remove"><i class="fa fa-times"></i></a>
								</td>
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
						<th scope="col">Image</th>
						<th scope="col">Ads Name</th>
						<th scope="col">Price</th>						
						<th scope="col" class="lastcell">Action</th>
						</tr>
					</tfoot>
					</table>
				</div>
			  </div>
			  
	          <div class="row">
                <div class="col-12">
                  <div class="spinnerbx">
                    {{ $wishlist->links() }}
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