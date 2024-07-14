<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\SeoUrl;
use App\Models\Banner;
use App\Models\Inquiry;
use App\Models\Setting;
use View;
use Session;

class PageController extends Controller
{
    function __construct(){

        Session::flush();
    }
    public function index($slug){
    	$data = array();
    	$data['pagedetails'] = SeoUrl::where('slug',$slug)->first();        
    	$data['page_id'] 	 = $data['pagedetails']->resource->id;
        $data['settings']   =   Setting::find(1);
    	// $data['getBanner']   = Banner::where('page_id', $data['page_id'] )->where('status',1)->get()->random(1);
    	$data['getBanner']   = Banner::where('page_id', $data['page_id'] )->where('status',1)->get();
    	//dd($data['pagedetails']->resource->description);
    	//dd( $data['pagedetails']->resource->getBanner);
        if($slug == "contact-us"){            
            return View::make('contact_us')->with($data);
        }else{            
            return View::make('cms')->with($data);
        }
    }

    public function contact_submit(Request $request){
        $first_name = $request->input('first_name');
        $last_name  = $request->input('last_name');
        $phone_nos  = $request->input('phone_nos');
        $email      = $request->input('email');
        $message    = $request->input('message');
        if($first_name && $last_name && $phone_nos && $email && $message){
            $Inquiry = new Inquiry;
            $Inquiry->name      = $first_name." ". $last_name;
            $Inquiry->email     = $email;
            $Inquiry->phone_nos = $phone_nos;
            $Inquiry->message   = $message;
            $Inquiry->save();            
            return redirect()->to('en/thank-you/success');
        }else{
            $msg='Something went wrong.Please try again!';
            Session::flash('error_message', $msg);
            return redirect()->to('en/cms/contact-us');
        }        

    }
}
