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
	          <h3>@lang('dashboard.dashboard_txt') / @lang('dashboard.view_manage_txt')</h3>
	          @if(Session::has('error_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-danger alert-dismissible') }}">{{ Session::get('error_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
              @if(Session::has('success_message'))
              <div class="alert {{ Session::get('alert-class', 'alert-success alert-dismissible') }}">{{ Session::get('success_message') }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
              @endif 
	          <div class="row">	          	 
               @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
			  @endif
			  <div class="col-sm-12">
				<div class="table_custom">
					<div class="table-responsive">
						<table class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
								<th scope="col">#</th>
								<th scope="col" class="imagecell">Image</th>
								<th scope="col" class="namecell">Ads Name</th>					
								<th scope="col">Short Description</th>
								<th scope="col" class="pricecol">Price</th>
								<th scope="col" class="lastcell action">Action</th>
								</tr>
							</thead>
							<tbody>
								@if(count($adslist) > 0)
								@php $i=1;@endphp
									@foreach($adslist as $list)
									<tr>
										<td>{{ $i++ }}</td>
										<td class="imagecell"><span class="viewimg"><img src="{{ url('/')}}/{{  $list->images }}" alt=""></span></td>
										<td class="namecell">{{ $list->title}}</td>		
										<td>{{ \Illuminate\Support\Str::limit($list->short_description, 66, $end=' ') }}</td>
										<td class="nowrap">&euro; {{ $list->amount }}</td>
										<td class="lastcell nowrap">
											<div class="actbtn_grp">
												<a href="{{ url(app()->getLocale().'/ads-images')}}/{{$list->getPageslug->slug}}" class="actnntn vewbtn" id="{{ $list->id }}" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Image">
												<i class="fa fa-image text-normal" aria-hidden="true"></i>
												</a>
												<button type="button" class="actnntn vewbtn ads_details" id="{{ $list->id }}" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="View"><i class="fa fa-eye" aria-hidden="true"></i></button>

												<a href="{{ url(app()->getLocale().'/edit-post')}}/{{$list->getPageslug->slug}}" class="actnntn edtbtn" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<a href="{{ url(app()->getLocale().'/ads-review')}}/{{$list->getPageslug->slug}}" class="actnntn edtbtn" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Review"><i class="fa fa-street-view" aria-hidden="true"></i></a>

												<button type="button" class="actnntn delbtn" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Delete"><i class="fa fa-trash" aria-hidden="true" onclick="deleteAds({{$list->id}});"></i></button>
											</div>
										</td>
									</tr>
									@endforeach
								@endif								
							</tbody>				  
							<tfoot>
								<tr>
								<th scope="col">#</th>
								<th scope="col" class="imagecell">Image</th>
								<th scope="col" class="namecell">Ads Name</th>					
								<th scope="col">Short Description</th>
								<th scope="col">Price</th>
								<th scope="col">Action</th>
								</tr>
							</tfoot>
							</table>
						</div>
					</div>
				</div>
				<div class="col-12">
                  <div class="spinnerbx">
                    {{ $adslist->links() }}
                  </div>
                </div>
	          </div>
	        </div>
	        </div>
	        </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade exviewdetailsmodal mailmodal" id="ads_details_modal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">View Details</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body"> 
          
          <div id="user_jobs"></div>
           
	      </div>	      
	    </div>
	  </div>
	</div>

    @endsection