<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\AdvertisementsImageTable;
use App\Models\AdvertisementReviw;
use App\Models\User;
use App\Models\AdvertisementAmentie;
use App\Models\PackagesSubscription;
use App\Models\Usertransaction;
use App\Models\Setting;
use App\Models\Amentie;
use App\Models\Wishlist;
use App\Models\SeoUrl;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Models\Categorie;
use App\Models\AdvertisementInquirie;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Session;
use View;
use Datatables;
use Validator;
use Image;
class AdvertisementController extends Controller
{
    public function index($slug=""){
    	$data	= array();
        if (isset($_REQUEST['sort'])) {
            $filter = $_REQUEST['sort'];
        } else {
            $filter = 'title';
        }

        if (isset($_REQUEST['order'])) {
            $order = $_REQUEST['order'];
        } else {
            $order = 'ASC';
        }

        $data['catList'] = Categorie::where('status','1')->with(['getCategorywiseAds'=>function($q){$q->where('status',1)->where('approved',1);
        }])->get();

        $data['state_list'] = State::where('status',1)->get();

        if($slug ==""){
            $data['allAdsList'] = Advertisement::where('status','1')
            ->where('approved','1')
            ->orderBy($filter,$order)
            ->paginate(config('app.pagination'));
        }else{
            $data['categoryDetails'] = SeoUrl::where('slug',$slug)->first();

                $data['cat_id']     = $data['categoryDetails']->resource->id;
                $data['allAdsList'] = Advertisement::where('status','1')
                    ->where('approved','1')
                    ->where('cat_id',$data['cat_id'])
                    ->orderBy($filter,$order)
                    ->paginate(config('app.pagination'));
            
        }

        $data['maxprice'] = Advertisement::where('status','1')
                    ->where('approved','1');

        $data['min_price'] = 0;
        $data['max_price'] = round($data['maxprice']->max('amount'));
    	return View::make('all_ads')->with($data);
    }

    public function ads_details($slug){
    	$data	= array();
        $data['pagedetails'] = SeoUrl::where('slug',$slug)->first();
        $id = $data['pagedetails']->resource->id;
    	$data['adsdetails'] = Advertisement::where('status','1')->where('id',$id)->first();
    	$data['adsImages'] = AdvertisementsImageTable::where('status','1')->where('ads_id',$id)->get();
    	$data['sellerDetails'] = User::where('status','1')->first();
        $data['review'] = AdvertisementReviw::where('status','1')->where('ads_id',$id)->count();
        $data['rating'] = round(AdvertisementReviw::where('status','1')->where('ads_id',$id)->avg('rating'));
        $data['adsAmenties'] = AdvertisementAmentie::where('status','1')->where('ads_id',$id)->get();
        if(session()->get('userexist')!=""){
            $userDetails = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
            $user_id = (int)$userDetails->id;
        }else{
            $user_id = 0;
        }

        $data['wishlist'] = Wishlist::where('ads_id',$id)->where('user_id',$user_id)->first();
		$view = Advertisement::where('id',$id)
                ->increment('view',1);
    	//dd($data['wishlist']);
    	return View::make('ads_details')->with($data);

    }

    public function write(Request $request){
        $json = array();       
        $adsId = $request->input('ads_id');
        $name = $request->input('name');
        $message = $request->input('text');
        $rating = $request->input('rating');
        if ($name == "") {
            $json['error'] = "Please enter your name!";
        }
        if ($message == "") {
            $json['error'] = "Please enter your review!";
        }
        if ($rating == "") {
            $json['error'] = "Please select your rating!";
        }
        if (!isset($json['error'])) {            
            $reviw = new AdvertisementReviw;
            $reviw->ads_id      = $adsId;
            $reviw->user_id     = 0;
            $reviw->name        = $name;
            $reviw->rating      = $rating;
            $reviw->review_text = $message;
            $reviw->save();           
            $json['success'] = "Success,Thanks for your review.";
        }
        return json_encode($json);
        
    }

    public function add_post(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data['country'] = Country::where('status',1)->get();
        $data['categoryList'] = Categorie::where('status',1)->get();
        // dd($data['country'][0]);
        return View::make('add_post')->with($data);
    }

    public function manage_ads(){
        $data = array();        
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data['adslist'] = Advertisement::where('user_id',$data['userDetails']->id)
                        ->orderBy('id','DESC')
                        ->paginate(config('app.pagination'));
        return View::make('manage_ads')->with($data);
    }

    public function view_inquiries(){        
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data['inqueryDetails'] = AdvertisementInquirie::where('user_id',$data['userDetails']->id)->paginate(config('app.pagination'));
        if(request()->ajax())
        {  

            return datatables()->of(AdvertisementInquirie::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="view btn btn-primary btn-sm">View</button>';                
                        return $button;
                    })
                    ->editColumn('id', '{{$id}}')
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view::make('view_inquiries')->with($data);
    }

    public function getInquiriesData(){        
        if(request()->ajax())
        {
            // $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
            // $data['inqueryDetails'] = AdvertisementInquirie::where('user_id',$data['userDetails']->id)->get();

            return datatables()->of(AdvertisementInquirie::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">View</button>';                
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('view_inquiries');
    }

    public function inquery_data($id){
		$update = AdvertisementInquirie::where('id',$id)
         ->update( [ 'type' => "read" ]); 
        if(request()->ajax())
        {
            $data = AdvertisementInquirie::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function adsInquery(Request $request){
        $json = array();       
        $adsId = $request->input('ads_id');
        $seller_id = $request->input('seller_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $phone_no = $request->input('phone_no');
        $message = $request->input('message');

        $rules = array(
            'name'      =>  'required',
            'email'     =>  'required|email',
            'phone_no'  =>  'required|numeric|digits:10',
            'message'   =>  'required',            
        );
        $error = \Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }                   
        $inquirie = new AdvertisementInquirie;
        $inquirie->ads_id      = $adsId;
        $inquirie->user_id     = $seller_id;
        $inquirie->name        = $name;
        $inquirie->email       = $email;
        $inquirie->phone_no    = $phone_no;
        $inquirie->message     = $message;
        $inquirie->save();        
        return response()->json(['success' => 'Success,Message successfully submitted']);        
    }

    public function view_ads_details($id){
        if(request()->ajax()) {
            if($id) {
                $data['adsdetails'] = Advertisement::where('id',$id)->first();
                if(!$data['adsdetails']) {
                    return response()->json( array('success' => false, 'html'=>'No Jobs assigned to ') );
                }
                $returnHTML = View::make('view_ads')->with($data)->render();
                return response()->json( array('success' => true, 'html'=>$returnHTML) );

            } 
        }    
    }

    public function delete_ads(Request $request){
      $adsId = $request->input('id');
      if($adsId){
        $delete =  Advertisement::where('id', $adsId)->delete();
        echo "sucess";
      }else{
        echo "fail";
      }
    }
	
	public function delete_ads_image(Request $request){
      $adsId = $request->input('id');
      if($adsId){
        $delete =  AdvertisementsImageTable::where('id', $adsId)->delete();
        echo "sucess";
      }else{
        echo "fail";
      }
    }

    public function insert_post(Request $request){
        $getSettingData = Setting::where('id',1)->first();
        $userDetails = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $packageExp = PackagesSubscription::where('user_id',$userDetails->id)->orderBy('id','DESC')->first();
        $currentDate = date('Y-m-d');   

        $request->validate([          
            'title'       => 'required|regex:/^[A-Za-z0-9 ]+$/',       
        ]);     
        /*************check wallets balance available********************/
        if(($getSettingData->ad_fees <= $userDetails->credit_point) && ($currentDate <= $packageExp->expires_at)){
            $folderName     =   date('Y')."-".date('m');
            $path = storage_path('/app/uploads/1/'.$folderName);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }  
            //create seo url
            $slug = SlugService::createSlug(SeoUrl::class, 'slug',$request['title']);
            $seo = SeoUrl::create([
                                "slug"  => $slug,
                                "model" => "App\Models\Advertisement",
                                "created_at" => date('Y-m-d, H:i:s')
                            ]);      
            $seo_url_id = $seo->id; 
            //upload image
            if ($request->hasfile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = storage_path('app/uploads/1/'.$folderName.'/') . $filename;

                Image::make($image)->save($location);
            }
            
            /*****************adv expaire date*********************/

            $insertAds = new Advertisement;
            $insertAds->title         = $request['title'];
            $insertAds->user_id       = $userDetails->id;
            $insertAds->cat_id        = $request['category'];
            $insertAds->amount        = $request['price'];
            $insertAds->country_id    = $request['country'];
            $insertAds->state_id      = $request['state'];        
            $insertAds->city_id       = $request['city'];  
            $insertAds->short_description        = $request['short_description'];  
            $insertAds->description   = $request['description'];  
            $insertAds->status        = $request['status']; 
            $insertAds->ads_tag       = $request['ads_tag']; 
			$insertAds->location      = $request['location']; 
            $insertAds->seo_url_id    = $seo_url_id;  
            $insertAds->approved      = 1;  
            $insertAds->expair_at     = $packageExp->expires_at;  
            if ($request->hasfile('image')) {
                $insertAds->images = "uploads/1/".$folderName."/".$filename;
            }
            $insertAds->save();
            /*********************amenities**************/
            if(!empty($request['amenities'])){
                foreach ($request['amenities'] as $value) {
					if($value != ""){
						$insertamenities = AdvertisementAmentie::create([
							"ads_id"         => $insertAds->id,
							"amenties_id"    => $value,                        
							"status"         => 1,
						]);
					}	
                }          
            }
            /********************update wallets**************************/
            $updateuser = User::where('id',$userDetails->id)
                ->decrement('credit_point',$getSettingData->ad_fees);
            /*******************update transaction table******************/
            $insertTrns = Usertransaction::create([
                'user_id'       => $userDetails->id,
                'description'   => "Post add",
                'credit_point'  => $getSettingData->ad_fees,
                'type'          => "debit",
                'created_at'    => date('Y-m-d H:i:s'),             
            ]); 

            Session::flash('success_message', 'Grate! Your AD is successfully added'); 
            return redirect()->action('AdvertisementController@manage_ads');
        }else{
            Session::flash('error_message', ' Insufficient wallet balance, Please recharge your wallets first!'); 
            return redirect()->action('AdvertisementController@add_post');
        }       

    }

    public function edit_ads($slug=""){
        $data['seoSlug']        = SeoUrl::where('slug',$slug)->first();
        $data['adsDetails']     = $data['seoSlug']->resource;
		$data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        if(!empty($data['adsDetails'])){
            $data['country'] = Country::where('status',1)->get();
            $data['stateList'] = State::where('status',1)->where('country_id',$data['adsDetails']->country_id)->get();
           
            $data['cityList'] = City::where('status',1)->where('state_id',$data['adsDetails']->state_id)->get();
            $data['categoryList'] = Categorie::where('status',1)->get();
            $data['amenities']    = Amentie::where('status',1)->get();          
            $advamenities = AdvertisementAmentie::select('amenties_id')->where('status',1)->where('ads_id',$data['adsDetails']->id)->get();
            if(count($advamenities) > 0){
                foreach ($advamenities as $value) {
                    $data['advamenities'][] = $value->amenties_id;
                }
            }else{
                 $data['advamenities'][] = "hh";
            }
            
            //dd($data['advamenities']);
            return View::make('edit_post')->with($data);
        }else{
            Session::flash('error_message', 'Error, Invalid Ads'); 
            return redirect()->action('AdvertisementController@manage_ads');
        }
    }

    public function update_post(Request $request){
		//dd( $request['location']);
        $userDetails = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $request->validate([          
            'title'       => 'required|regex:/^[A-Za-z0-9 ]+$/',       
        ]); 
        //dd($request['amenities']);
        if($request['ads_id']!=""){ 
            //upload iage if exist
            $folderName     =   date('Y')."-".date('m');
            $path = storage_path('/app/uploads/1/'.$folderName);
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            } 
            if ($request->hasfile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $locations = storage_path('app/uploads/1/'.$folderName.'/') . $filename;
                Image::make($image)->save($locations);
            }
//dd( $request['location']);
            $updateAds = Advertisement::find($request['ads_id']);
            $updateAds->title         = $request['title'];
            $updateAds->user_id       = $userDetails->id;
            $updateAds->cat_id        = $request['category'];
            $updateAds->amount        = $request['price'];
            $updateAds->country_id    = $request['country'];
            $updateAds->state_id      = $request['state'];        
            $updateAds->city_id       = $request['city'];  
            $updateAds->short_description        = $request['short_description'];  
            $updateAds->description        = $request['description'];			
            $updateAds->ads_tag       = $request['ads_tag']; 
            $updateAds->location      = $request['location']; 
            $updateAds->status        = $request['status']; 
            if ($request->hasfile('image')) {
                $updateAds->images = "uploads/1/".$folderName."/".$filename;
            }
            $updateAds->save();

            /*********************amenities**************/
            if(!empty($request['amenities'])){
                $delete =  AdvertisementAmentie::where('ads_id', $request['ads_id'])->delete();
                foreach ($request['amenities'] as $value) {
                    $insertamenities = AdvertisementAmentie::create([
                        "ads_id"         =>$request['ads_id'],
                        "amenties_id"    => $value,                        
                        "status"         => 1,
                    ]);
                }          
            }
            Session::flash('success_message', 'Great! Your AD is Successfully updated'); 
            return redirect()->action('AdvertisementController@manage_ads'); 
        }else{
            Session::flash('error_message', 'Error, Invalid Ads'); 
            return redirect()->action('AdvertisementController@manage_ads');
        }

    }

    public function ads_images($slug=""){
        $data = array();
        $data['seoSlug']        = SeoUrl::where('slug',$slug)->first();
        $data['adsDetails']     = $data['seoSlug']->resource;
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        if(!empty($data['adsDetails'])){
            $data['imageList'] = AdvertisementsImageTable::where('ads_id',$data['adsDetails']->id)
                ->where('status',1)
                ->paginate(config('app.pagination'));

        }else{
             Session::flash('error_message', 'Error, Invalid Ads'); 
            return redirect()->action('AdvertisementController@manage_ads');
        }
        return View::make('ads_image_list')->with($data);
    }

    public function upload_image(Request $request){
        $image_code = '';
        $images = $request->file('file');
        $ads_id = $request['ads_id'];
        $folderName     =   date('Y')."-".date('m');
        $path = storage_path('/app/uploads/1/'.$folderName);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }         
        foreach($images as $image)
        {
          $new_name = rand() . '.' . $image->getClientOriginalExtension();
          $image->move(storage_path('app/uploads/1/'.$folderName.'/'), $new_name);
          $insertImage = new AdvertisementsImageTable;
          $insertImage->ads_id = $ads_id;
          $insertImage->image_name = "uploads/1/".$folderName."/".$new_name;
          $insertImage->status = 1;
          $insertImage->save();
        }
        $output = array(
          'success'  => 'Images uploaded successfully',
        );
        return response()->json($output);
    }

    public function filter_ads($category,$rating,$price,$state=""){       
        if (isset($_REQUEST['sort'])) {
            $filter = $_REQUEST['sort'];
        } else {
            $filter = 'title';
        }

        if (isset($_REQUEST['order'])) {
            $order = $_REQUEST['order'];
        } else {
            $order = 'ASC';
        }
// dd($rating);
        if($rating != 0){
            $minrating = min(explode(",", $rating));
        }else{
            $minrating = 1;
        }
// search by state;       
        // dd($state);
        if($state!=""){
            $state_id_exist = State::where('state_name', 'like','%' . $state . '%')->first();
        }else{
            $state_id_exist = "";
        }    
       // dd($state_id_exist);
       // dd($data['state_id']->id);
        $priceMin = min(explode(",", $price));
        $priceMaX = max(explode(",", $price));

        $query = Advertisement::where('status','1');
        $query->where('approved',1);
        $query->where('rating','>=',$minrating);
        $query->whereBetween('amount', [$priceMin, $priceMaX]);
        if($state_id_exist != Null){
            $query->where('state_id',$state_id_exist->id);
        }elseif($state != "" && $state!="test"){
            $query->where('state_id',0);
        }
        if($category!=0){
            $query->whereIn('cat_id',explode(",", $category));
        }
        $query->orderBy($filter,$order);
        $data['sort_by'] = $filter.'&'.$order;
        $data['allAdsList'] = $query->paginate(config('app.pagination'));        
        $returnHTML = View::make('search_ads_list')->with($data)->render();
        return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    public function search_result(Request $response){
        $data   = array();

        $data['catList'] = Categorie::where('status','1')->with(['getCategorywiseAds'=>function($q){$q->where('status',1)->where('approved',1);
        }])->get();
        $data['state_list'] = State::where('status',1)->get();
       
        $query = Advertisement::where('status','1');
        $query->where('approved',1);
        if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id']!='') {
			$data['cat_id'] = $_REQUEST['cat_id'];
            $query->where('cat_id',$_REQUEST['cat_id']);
        } 
        if (isset($_REQUEST['serch_price']) && $_REQUEST['serch_price']!='') {
            $query->where('amount','<=',$_REQUEST['serch_price']);
        } 
        if (isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='') {
            $query->Where('description','like','%' . $_REQUEST['keyword'] . '%');
        } 
        if (isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='') {
            $query->orWhere('short_description','like','%' . $_REQUEST['keyword'] . '%');
        } 
        if (isset($_REQUEST['keyword']) && $_REQUEST['keyword']!='') {
            $query->orWhere('title','like','%' . $_REQUEST['keyword'] . '%');
        }    
        $query->orderBy('id','desc');
        $data['allAdsList'] = $query->paginate(config('app.pagination'))
        ->appends(request()->query());
        
        
        $data['maxprice'] = Advertisement::where('status','1')
                    ->where('approved','1');
        $data['min_price'] = 0;
        $data['max_price'] = round($data['maxprice']->max('amount'));
        
        return View::make('search_ads')->with($data);
    }

    public function ads_review($slug=""){
        $data['seoSlug']        = SeoUrl::where('slug',$slug)->first();
        $data['adsDetails']     = $data['seoSlug']->resource;
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        if(!empty($data['adsDetails'])){
            $data['reviewlist'] = AdvertisementReviw::where('ads_id',$data['adsDetails']->id)
            ->orderBy('id','DESC')
            ->paginate(config('app.pagination'));
           // dd($data['reviewlist']);
            return View::make('reviewlist')->with($data);
        }else{
            Session::flash('error_message', 'Error, Invalid Ads'); 
            return redirect()->action('AdvertisementController@manage_ads');
        }
    }

    public function updat_review($id,$slug){
        $getDetailreview = AdvertisementReviw::where('id',$id)->first();
        //dd($getDetailreview);
        if($getDetailreview->status == 1){
            $advertisement = AdvertisementReviw::where('id',$id)->update(['status'=>0]);
        }else{
            $advertisement = AdvertisementReviw::where('id',$id)->update(['status'=>1]);
        }
      
        $rating = round(AdvertisementReviw::where('status','1')->where('ads_id',$getDetailreview->ads_id)->avg('rating'));
        $advertisement = Advertisement::where('id',$getDetailreview->ads_id)->update(['rating'=>$rating]);

        Session::flash('success_message', 'Review successfully updated!'); 
        //return redirect()->action('AdvertisementController@manage_ads');
        return redirect()->back()->with('success_message', 'Review successfully updated!');  
    }

    public function wish_list(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data['wishlist'] = Wishlist::where('user_id', $data['userDetails']->id)->orderBy('id','DESC')
            ->paginate(config('app.pagination'));
        return View::make('wish_list')->with($data);
    }
}
