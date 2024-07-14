<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Banner;
use App\Models\Categorie;
use App\Models\Advertisement;
use App\Models\AdvertisementReviw;
use App\Models\Country;
use App\Models\State;
use App\Models\HowitWork;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Inquiry;
use App\Models\SeoUrl;
use App\Models\User;
use App\Models\Visitor;
use DB;
use Session;
use App;
use View;
use Redirect;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        //----------------visitor---------------//
        $ip_address = $this->getOriginalClientIp();
        $visitorExits = Visitor:: where('ip_address',$ip_address)->first();
        if(!$visitorExits){
            $insertVisitor = new Visitor;
            $insertVisitor->ip_address   =  $ip_address;
            $insertVisitor->save();
        }

        $data['getBanner']       = Banner::where('page_id',2)->where('status',1)->get();    
        $data['featureCategory'] = Categorie::where('is_feature',1)->where('status',1)->get(); 
        if(session()->get('userexist')!=""){
            $userDetails = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
            $user_id = (int)$userDetails->id;
        }else{
            $user_id = 0;
        }

        $data['advertisement'] = Advertisement::where('approved',1)
        ->where('status',1)
        ->where('is_featured',1)
        ->where('expair_at','>=',date('Y-m-d'))
        ->with(['getAdvtwishlist'=>function($q) use ($user_id){$q->where('user_id','=',$user_id);
        }])
        ->with(['getAdvtReview'=>function($q){$q->where('status',1);
        }])
        ->get()->take(8);

        // dd($data['advertisement']);


        $data['howit_works']      = HowitWork::get();
        $data['about']           = Page::where('id',1)->find(1);

        $data['settings']        = Setting::find(1);
        $data['categorie']       = Categorie::where('status',1)->get();
        $data['explore_location'] = State::where('show_in_home',1)->where('status',1)->get()->take(4); 
        //$review = $data['advertisement'][1]->getAdvtStates;
        // dd($review );
        //dd($data['about']->short_description['en']);
      
        return View::make('home')->with($data);
    }
    function getOriginalClientIp(Request $request = null) : string
    {
        $request = $request ?? request();
        $xForwardedFor = $request->header('x-forwarded-for');
        if (empty($xForwardedFor)) {
            // Si está vacío, tome la IP del request.
            $ip = $request->ip();
        } else {
            // Si no, viene de API gateway y se transforma para usar.
            $ips = is_array($xForwardedFor) ? $xForwardedFor : explode(', ', $xForwardedFor);
            $ip = $ips[0];
        }
        return $ip;
    }
    
    public function submitInquiry(Request $request){
        $json = array();       
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        if ($message == "") {
            $json['error'] = trans('home.feed_error_message');
        }         

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $json['error'] = trans('home.feed_error_valid_email');
        }

        if ($email == "") {
            $json['error'] = trans('home.feed_error_email');
        }

        if ($name == "") {
            $json['error'] = trans('home.feed_error_name');
            //trans('home.nos_of_user');
        }

        
        if (!isset($json['error'])) {
            $data=array('name'=>$name,
                "email"=>$email,
                "message"=>$message,
                "created_at" =>  date('Y-m-d H:i:s'),
            );
            $Inquiry = new Inquiry;
            $Inquiry->name      = $name;
            $Inquiry->email     = $email;
            $Inquiry->message   = $message;
            $Inquiry->save();
            //DB::table('inquiry_table')->insert($data);
            $json['success'] = trans('home.feedback_success');
        }

        
        return json_encode($json);
    }
    
    public function getSignOut() {        
        Auth::logout();
        return Redirect::route('home');    
    }

    function thank_you($slug=NULL)
    { 
        if($slug == 'success'){
            $data['msg']= 'Your query has been successfully submited.We will contact you soon.';
        }else{
            $data['msg']= 'Your registration process has been completed successfully';
        }
        return View::make('thankyou')->with($data);      
    }
    

    public function get_state(Request $request){
        $keyword = ucfirst($request->input('keyword'));

        $StateList = State::where('state_name', 'like','%' . $keyword . '%')->where('status',1)->get();
          // dd($StateList);
        return response()->json(['data' => $StateList]);
    }


}
