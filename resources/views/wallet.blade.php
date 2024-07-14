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
		          <h3>@lang('dashboard.dashboard_txt') / @lang('dashboard.wallets_txt')</h3>
		          <div class="row">
		          	<div class="col-12">
		          		<div class="walletboxouter">
		          			<div class="walletheading">
		          				<div class="walleticon"><i class="icon icon-wallet"></i></div>
		          				<div class="walletcontent">
		          					<h4>Credit Point</h4>
		          					<p>{{ $userDetails->credit_point}}</p>
		          				</div>
		          				<div class="walletadbox">
		          					<a href="{{ url('/purchase-packages')}}" class="addmoneybtn"><i class="fa fa-plus"></i> <span>Add Credit Point to Wallet</span></a>
		          				</div>
		          			</div>
		          			<div class="walletbody">
		          				@if(count($transactionList) > 0)
		          					@foreach($transactionList as $val)
			          				<div class="walletlist">
			          					<div class="walletlisticon">
			          						@if($val->type == "credit")
			          						<i class="fa fa-plus"></i>
			          						@else
			          						<i class="fa fa-minus"></i>
			          						@endif
			          					</div>
			          					<div class="walletlistcontent">
			          						<h5>{{ $val->description }}</h5>
			          						<p>{{ date('d/m/Y - H:i A',strtotime($val->created_at))}}</p>
			          					</div>
			          					<div class="walletlistprice">
			          						<span class="green">{{ $val->credit_point}}</span>
			          					</div>
			          				</div>
			          				@endforeach
			          			@else
			          			<div class="nomail_record">
									<i class="fa fa-envelope-o"></i> <span>No record found</span>
								</div>	
		          				@endif
		          			</div>
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