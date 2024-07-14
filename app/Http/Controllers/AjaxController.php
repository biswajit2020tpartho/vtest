<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Amentie;

class AjaxController extends Controller
{
    public function getsate(Request $request){
    	$countryId = $request->input('id');
    	$StateList = State::where('country_id',$countryId)->where('status',1)->get();
    	return response()->json(['data' => $StateList]);

    }
    public function get_city(Request $request){
    	$stateId = $request->input('id');
    	$CityList = City::where('state_id',$stateId)->where('status',1)->get();
    	return response()->json(['data' => $CityList]);
    }
    public function get_aminities($catId){
       $catId   = $catId; 
       $ameList = Amentie::where('cat_id',$catId)
                    ->where('status',1)
                    ->get();
        // dd($ameList);            
        return response()->json(['data' => $ameList]);
    }

}
