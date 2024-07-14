@extends('layout.default')

@section('content')

	<section class="breadcrumbcontainer">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <ol class="breadcrumb">
          <li><a href="{{ url('/')}}">Home</a></li>
          <li><a href="{{ url(app()->getLocale().'/all-ads')}}/{{$adsdetails->getAdvtCategory->getPageslug->slug}}">{{ $adsdetails->getAdvtCategory->name }}</a></li>
          <li class="active">{{ $adsdetails->title }} </li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="projectdetailscontainer">
  <div class="container">
    <div class="row">
      <div class="col-xl-7 col-md-7 col-sm-12 col-12">
        <div class="projectdetailsleft">
          <div class="detailsimgbox">
            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">             
              @if(count($adsImages) > 0)
                @foreach($adsImages as $image)
                  <li href="{{ url('/')}}/{{$image->image_name}}" data-fancybox="Details" data-thumb="{{ url('/')}}/{{$image->image_name}}"> 
                    <img src="{{ url('/')}}/{{$image->image_name}}" />
                  </li>
                @endforeach
              @else
                <li href="{{ url('/')}}/{{$adsdetails->images}}" data-fancybox="Details" data-thumb="{{ url('/')}}/{{$adsdetails->images}}"> 
                    <img src="{{ url('/')}}/{{$adsdetails->images}}" />
                  </li>
              @endif
            </ul>
          </div>
          <div class="detailscollapsecontent">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Description
                    </button>
                  </h2>
                </div>
                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="">
                  <div class="card-body">              
                    {!! html_entity_decode($adsdetails->description) !!}
                  </div>
                </div>
              </div>
               @if(count($adsAmenties)>0)
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Features
                    </button>
                  </h2>
                </div>
               
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="">
                  <div class="card-body">                    
                    <div class="row ml-n2 mr-2">
                      @foreach($adsAmenties as $amenties)
                      <div class="col-xl-3 col-md-4 col-sm-3 col-6 pl-2 pr-2 mb-3">
                        <div class="amentiesbinner">
                          <div class="amentiesb">
                            <i class="icon {{ $amenties->getAmenties->image }}"></i>
                            <p>{{ $amenties->getAmenties->name }}</p>
                          </div>
                        </div>
                      </div> 
                      @endforeach
                    </div>
                  </div>
                </div>
             

              </div>
              @endif
              <div class="card"  id="write_review">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Specification
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="">
                  <div class="card-body">
                    {{ $adsdetails->short_description}}
                  </div>
                </div>
              </div>
            </div>
            <div class="detailsreviewbox">
              <form name="form-review" id="form-review">
                {{ csrf_field() }}
              <div class="form-group">                
                <label><i class="icon icon-document"></i>Write a review</label>
                <div id="review"></div>
                <input type="hidden" name="ads_id" value="{{ $adsdetails->id }}">
                <div class="form-group required frm">
                  <div class="">
                    <label class="control-label" for="input-name"><span>*</span> Your Name </label>
                    <input type="text" name="name" id="input-name" class="form-control" />
                  </div>
                </div>
                <div class="form-group required frm">
                  <div class="">
                    <label class="control-label" for="input-review"><span>*</span> Your Review</label>
                    <textarea name="text" rows="5" id="input-review" class="form-control"></textarea>                   
                  </div>
                </div>
                <div class="form-group required">
                  <div class="ratediv">
                      <label class="control-label">Rating</label>
                      Bad
                      <div class="rating-area">
                        <div class="starpanel">
                            <input type="radio" name="rating" id="st1" value="5">
                            <label for="st1"></label>                  
                            <input type="radio" name="rating" id="st2" value="4">
                            <label for="st2"></label>                   
                            <input type="radio" name="rating" id="st3" value="3">
                            <label for="st3"></label>                  
                            <input type="radio" name="rating" id="st4" value="2">
                            <label for="st4"></label>                    
                            <input type="radio" name="rating" id="st5" value="1">
                            <label for="st5"></label>
                            </div>
                          </div>
                      Good</div>               

                  <div class="revbtn">
                    <button type="button" id="button-review" class="submitbtn">Submit</button>
                  </div>
                </div>
              </div>
             
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-5 col-md-5 col-sm-12 col-12">
        <div class="detailsrightbar">
          <h2>{{ $adsdetails->title }}</h2>
          <div class="ratingbox">
            <div class="rtleft">
              <div class="rtstar">
                @for ($i = 0; $i < 5; $i++)
                    @if($rating > $i)
                      <i class="fa fa-star"></i>
                    @else
                      <i class="fa fa-star-o"></i>
                    @endif
                @endfor
                <span>{{ $rating }}</span>
              </div>
              <p>{{ $rating }} ratings and {{ $review }} reviews</p>
            </div>
            <div class="rtright">
              <a href="#write_review" class="reviewbtn"><i class="icon icon-document"></i><span>Write a review</span></a>
            </div>
          </div>
          <div class="bhkbx">
            <div class="bhkbxinnertop">
              <div class="bhkbxleft">
                <span class="bhkprice">&euro;{{ $adsdetails->amount }}</span>
              </div>
              <div class="bhkbxright">
                <h3>{{ $adsdetails->ads_tag }}</h3>
                <div class="loaction"><i class="fa fa-map-marker"></i> {{ $adsdetails->getAdvtStates->state_name}}, {{ $adsdetails->getAdvtCountry->country_name}}</div>
              </div>
            </div>
            <div class="postedshare">
              <div class="postdate"><i class="fa fa-calendar"></i>Posted: {{ date('d-m-Y',strtotime($adsdetails->created_at)) }}</div>
              <div class="sharerightb">
                <!-- <a class="shbtn" href="javascript:void(0);"><i class="fa fa-share-alt"></i></a> -->               
                @if($wishlist)
                <a class="shbtn" id="wishlist" href="javascript:void(0);" onclick="wishlist.add('{{$adsdetails->id}}');"><i class="fa fa-heart"></i></a>
                @else
                <a class="shbtn" id="wishlist" href="javascript:void(0);" onclick="wishlist.add('{{$adsdetails->id}}');"><i class="fa fa-heart-o"></i></a>
                @endif

                <!-- AddThis Button BEGIN -->
                  <div class="shbtn addthis_toolbox addthis_default_style" data-url="{{ url('adsdetails/'.$pagedetails->slug)}}"> <a class="addthis_counter addthis_pill_style"></a></div>
                  <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script> 
                <!-- AddThis Button END --> 
              </div>
            </div>
          </div>
          <div class="detailsuserbox">
            <h3>Seller description</h3>
            <div class="duserbox">
              <div class="duser">
                <img src="{{ url('/')}}/{{ $adsdetails->getSellerDetails->photo }}" alt="User 1" />
              </div>
              <div class="dusercontent">
                <h4>{{ $adsdetails->getSellerDetails->name }}</h4>
                <p>Member since {{ date('F Y',strtotime($adsdetails->getSellerDetails->created_at)) }}</p>
              </div>
              <div class="duserphone">
                <a href="tel:9876543210"><i class="fa fa-phone"></i></a>
              </div>
            </div>
            <button class="sendbtn" type="button" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-paper-plane"></i><span>Send a message</span></button>
          </div>
          <div class="detailslocation">
            <h3>LOCATION</h3>
            <p>{{ $adsdetails->location }}</p>
            <iframe src="https://maps.google.com/maps?q=35.856737, 10.606619&z=15&output=embed" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
           <!--  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1654735.4583094472!2d-120.87289555345943!3d47.06578420477507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5485e5ffe7c3b0f9%3A0x944278686c5ff3ba!2sWashington%2C%20USA!5e0!3m2!1sen!2sin!4v1584619570849!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
          </div>
        </div>
      </div>
    </div>  
  </div>
</section>
<div class="modal fade exviewdetailsmodal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ $adsdetails->title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
        <form name="inquery_form" id="inquery_form">
        {{ csrf_field() }} 
        <input type="hidden" name="ads_id" value="{{ $adsdetails->id }}">
        <input type="hidden" name="seller_id" value="{{ $adsdetails->user_id }}">
          <div class="row">
            <div class="col-12">
              <div id="form_result"></div>
            </div>
          </div> 
          <div class="row">
            <div class="col-md-12 col-12">
              <div class="form-group">
                <label class="form-label"> Name : </label>
                <input type="text" name="name" id="name" class="form-control" />
              </div>
            </div>   
            <div class="col-md-12 col-12">
              <div class="form-group">
                <label class="form-label">Email : </label>
                <input type="text" name="email" id="email" class="form-control" />
              </div>
            </div> 
            <div class="col-md-12 col-12">
              <div class="form-group">
                <label class="form-label">Phone No : </label>
                <input type="text" name="phone_no" id="phone_no" class="form-control" />
              </div>
            </div>
            <div class="col-md-12 col-12">
              <div class="form-group">
                <label class="form-label">Message :</label>
                <textarea class="form-control" placeholder="Message" id="message" name="message"></textarea>
              </div>
            </div>
          </div>  
        </form>  
      </div>
      <div class="modal-footer">
        <button type="button" id="inquery_button" class="btn btn-primary">Submit</button>
      </div>
      
    </div>
  </div>
</div>
@endsection