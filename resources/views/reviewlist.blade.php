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
			  <h3>@lang('dashboard.dashboard_txt') / @lang('dashboard.review_list')</h3>
			  <div class="table_custom">
				<div class="table-responsive">
					<table class="table table-striped table-bordered" id="inquery_lis" style="width:100%">
					<thead>
						<tr>
						<th scope="col">#</th>
						<th scope="col">@lang('dashboard.tbl_name')</th>
						<th scope="col">@lang('dashboard.tbl_rating')</th>
						<th scope="col">@lang('dashboard.tbl_message')</th>
						<th scope="col" class="lastcell">@lang('dashboard.tbl_status')</th>
						</tr>
					</thead>
					<tbody>
						@if(count($reviewlist) > 0)
							@php $i=1;@endphp
							@foreach($reviewlist as $val)
							<tr>
								<td>{{ $i++ }}</td>								
								<td>{{ $val->name }}
								</td>
								<td>{{ $val->rating }}</td>
								<td>{{ $val->review_text }}</td>
								<td  class="lastcell">
									@if($val->status == 1)
									<a href="{{ url(app()->getLocale().'/updat-review/'.$val->id.'/'.$seoSlug->slug)}}"><button type="button" name="edit" id="{{ $val->id }}" class="btn btn-success btn-sm">@lang('dashboard.active_txt')</button></a>
									@else
									<a href="{{ url(app()->getLocale().'/updat-review/'.$val->id.'/'.$seoSlug->slug)}}"><button type="button" name="edit" id="{{ $val->id }}" class="btn btn-danger btn-sm">@lang('dashboard.inactive_txt')</button></a>
									@endif
								</td>
							</tr>	
							@endforeach
						@else
							<tr>
			                      	<td colspan="6"><div class="text-center">@lang('dashboard.no_data_found')</div></td>
			                      </tr>
						@endif
					</tbody>				  
					<tfoot>
						<tr>
						<th scope="col">#</th>
						<th scope="col">@lang('dashboard.tbl_name')</th>
						<th scope="col">@lang('dashboard.tbl_rating')</th>
						<th scope="col">@lang('dashboard.tbl_message')</th>
						<th scope="col" class="lastcell">@lang('dashboard.tbl_status')</th>
						</tr>
					</tfoot>
					</table>
				</div>
			  </div>
			  
	          <div class="row">
                <div class="col-12">
                  <div class="spinnerbx">
                    {{ $reviewlist->links() }}
                  </div>
                </div>
              </div>
	        </div>
	        </div>
	        </div>
	    </div>
	  </div>
	</div>
@endsection