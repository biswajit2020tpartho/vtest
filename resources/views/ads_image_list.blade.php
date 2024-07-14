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
	          <h3>Dashboard / Ads Image</h3>
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
			  	<div class="col-sm-12 text-right">
				  <button type="button" class="addimgbtn" data-toggle="modal" data-target="#addimage_modal"><i class="fa fa-image text-normal" aria-hidden="true"></i> Add Image</button>
				</div>
				
			  	<div class="col-sm-12">
			  		@if(count($imageList) > 0)
					<div class="table_custom">
						<div class="table-responsive">
							<table class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
									<th scope="col">#</th>
									<th scope="col" class="imagecell">Image</th>			
									<th scope="col" class="imagecell">Date</th>			
									<th scope="col" class="lastcell action">Action</th>
									</tr>
								</thead>
								<tbody>
									@if(count($imageList) > 0)
									@php $i=1;@endphp
										@foreach($imageList as $list)
										<tr>
											<td>{{ $i++ }}</td>
											<td scope="col" class="imagecell"><span class="viewimg"><img src="{{ url('/')}}/{{  $list->image_name }}" alt=""></span></td>
											<td>{{  date('d-m-Y',strtotime($list->created_at)) }}</td>
											<td class="lastcell action">
												<div class="actbtn_grp">
													<button type="button" class="actnntn delbtn"><i class="fa fa-trash" aria-hidden="true" onclick="deleteAdsImage({{$list->id}});"></i></button>
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
									<th scope="col" class="imagecell">Date</th>
									<th scope="col" class="lastcell action">Action</th>
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
				<div class="col-12">
                  <div class="spinnerbx">
                    {{ $imageList->links() }}
                  </div>
                </div>
	          </div>
	        </div>
	        </div>
	        </div>
	    </div>
	  </div>
	</div>
	<!------------add image modal----------->
	<div class="modal fade exviewdetailsmodal mailmodal" id="addimage_modal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Upload Images</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body"> 
			 <div class="modal_file_up">
				<form id="upload_image" method="post" action="{{ url('en/upload-image') }}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="ads_id" value="{{ $adsDetails->id }}">
					<div class="row">
						<div class="col-sm-12 filelabel"><h4>Select Images <i class="fa fa-arrow-down" aria-hidden="true"></i></h4></div>
						<div class="col-sm-10 fileup">
							<div class="form-group">
								<div class="formgroupinner">
									<input type="file" name="file[]" class="form-control" id="file" accept="image/png, image/jpeg" multiple required/>
								</div>
							</div>
						</div>
						<div class="col-sm-2 filesub">
							<input type="submit" name="upload" value="Upload" class="uploadbtn" />
						</div>
					</div>
				</form>
			</div>
			<div class="progress" style="display: none;">
                <div class="progress-bar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    0%
                </div>
            </div>
	      </div>	           
	    </div>
	  </div>
	</div>
	@endsection