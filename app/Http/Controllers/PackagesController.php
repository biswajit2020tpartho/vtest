<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Package;
use App\Models\PackagesSubscription;
use View;
class PackagesController extends Controller
{
    //
    public function index(){
    	$data = array();
    	$data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
    	$data['packagedetails'] = Package::where('status',1)->orderBy('id','DESC')
            ->paginate(6);
        $currentPackage = PackagesSubscription::where('status','success')
            ->where('user_id',$data['userDetails']->id)
            ->where('expires_at','>=',date('Y-m-d'))
            ->orderBy('id','DESC')
            ->first();  
        if($currentPackage){
            $data['currentPackage'] = $currentPackage->package_id;
        }else{
            $data['currentPackage'] = 0;
        }
    	return View::make('purchase_packages')->with($data);
    }

    public function packageDetails($id){
    	if(request()->ajax())
        {
            $data = Package::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }
}
