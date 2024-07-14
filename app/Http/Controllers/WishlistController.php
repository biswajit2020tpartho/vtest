<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Wishlist;
use App\Models\Advertisement;
use App\Models\User;
use Session;

class WishlistController extends Controller
{
    function add(Request $request){
    	$json = array(); 
    	$ads_id = $request->input('ads_id');    	
    	$adsDetails = Advertisement::where('status','1')->where('id',$ads_id)->where('approved','1')->get();      	
    	if($adsDetails){
    		if(session()->get('userexist')!=""){   			
    			$userDetails = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();

                $productExist = Wishlist::where('ads_id',$ads_id)->where('user_id',$userDetails->id)->first();
                if($productExist){
                    $res=Wishlist::where('id',$productExist->id)->delete();
                    $json['is_exists'] = 0;
                    $json['success'] = "You have successfully removed ".$adsDetails[0]->title." from your wish list!";
                }else{    
        			//insert data to wishlist//
        			$addWishlist = new Wishlist;
        			$addWishlist->ads_id  = $ads_id;
        			$addWishlist->user_id = $userDetails->id;
        			$addWishlist->save();
                    $json['is_exists'] = 1;
        			$json['success'] = "You have successfully add ".$adsDetails[0]->title." to your wish list!";
                }

    		}else{
    			$json['success'] = "You must login or create an account to save ".$adsDetails[0]->title." to your wish list!";
    		}

    	}else{
    		$json['error'] = "Something went wrong.Please try again!";
    	}
    	return json_encode($json);

    }

    public function remove_wishlist($id,$slug){

        $res=Wishlist::where('id',$id)->delete();
        Session::flash('success_message', 'Successs. You have modified your wish list!'); 
        //return redirect()->action('AdvertisementController@manage_ads');
        return redirect()->back()->with('success_message', 'Successs. You have modified your wish list!');  
    }
}
