<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\AdvertisementInquirie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\EmailSetupTrait;
use App\Http\Traits\SmsSetupTrait;
use App\Models\Usertransaction;
use Redirect;
use View;
use CRUDBooster;
use Mail;
use Session;
use Image;

class UserController extends Controller
{
   use EmailSetupTrait,SmsSetupTrait;
    function __construct(){

        Session::flush();
    }

    function login()
	{
		if(session()->get('userexist')){
            return redirect('dashboard');
        } 
		$data =	array();
		return View::make('login')->with($data);
	}
	function login_validate(Request $request)
    {
    	$email_id=$request->input('email_id_log');
    	$password=$request->input('password_log');
    	$hash_pass=Hash::make($password);
        $request->validate([          
            'email_id_log'       => 'required',
            'password_log'      => 'required'          
        ]);

    	if($email_id!='' && $password!='')
    	{
    		$exist_user=User::where('email', $email_id)->first();

    		if($exist_user){ 

    			if($exist_user->status=='Inactive')
    			{
    				$msg= 'Your account is not approved by Administrator';
    				Session::flash('error_message', $msg);
    				return redirect()->action('UserController@login');
    			}
    			$user_pass=$exist_user->password;
    			if(Hash::check($password, $user_pass)){
    				Session::put('userexist' , $email_id);
                    $msg= 'Your have successfully logged in.';
                    Session::flash('success_message', $msg);
                    return redirect()->action('UserController@dashboard');
    			}
    			else
    			{
    				$msg= 'Valid email ID and invalid password';
    				Session::flash('error_message', $msg);
    				return redirect()->action('UserController@login');

    			}


    		}else{
    			$msg='Email id not found';
    			Session::flash('error_message', $msg);
    			return redirect()->action('UserController@login');
    		}
    	}
    	else
    	{
    		$msg='Please enter appropriate Email Id and Password.';
    		Session::flash('error_message', $msg);
    	}

    	return redirect()->action('UserController@login');
    }
    function forgot_password(Request $request)
    {
        $email_id = $request->input('email_id_forgot');		
        $check_email_exist = User::where('email',$email_id)->first();
        if($check_email_exist)
        {
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $random_password = substr(str_shuffle($str_result),  
                0, 6); 
            $changed_password = Hash::make($random_password); 
            $name=$check_email_exist->name;
            $to=$email_id;
            $cc ="";
            $template_slug='forgot_password_backend';
            $subject = "Password has been generated for your account.";
            $message = 'New password has been generated for your account. use this password to enter your account and change your password further.';


            $config = [
                'from' => [
                'name' => CRUDBooster::getSetting('appname'),
                'email'=> CRUDBooster::getSetting('email_sender')
                ],
                'to' => $to,
                'email_slug_name' => $template_slug,
                'mail_key_code' => [
                'name'     => $name,
                'password' => $random_password
                ],
                'subject' =>  $subject
                ];

                


            $result =  $this->initiateMail($config); 
            if($result==1){
				
				$updatepassword = User::where('email', $email_id)
				   ->update([
					   'password' => $changed_password
					]);
                $msg= 'One Email has been sent to your email account.Please check inbox of your email account.';
                Session::flash('success_message', $msg);
                return redirect()->action('UserController@login');
            }
            else
            {
                $msg= 'Sorry!! Forgot password process can not be completed now.';
                Session::flash('error_message', $msg);
                return redirect()->action('UserController@login');
            }



        //dd($random_password);
        }
        else
        {
            $msg= 'Sorry!! Email Id not found.';
            Session::flash('error_message', $msg);
            return redirect()->action('UserController@login');

        }

    }

    function customer_insert(Request $request)
    {
        $username=$request->input('user_name');
        $email   =$request->input('email');
        $phone_number=$request->input('phone_number');
        $description=$request->input('description');
        $password=$request->input('user_password');
        $password_actual = $password;        
        $status='Active';

        $request->validate([
            'user_name'          => 'required|max:255',           
            'email'              => 'required|email|unique:cms_users',
            'phone_number'       => 'required|unique:cms_users|numeric|digits:10',
            'user_password'      => 'required'          
        ]);
       /* if($eml_exist){
            $msg='This Email Id already in use.please try another Email account';
            Session::flash('error_message', $msg);

        }
        if($contact_exist){
            $msg='This Contact number already in use.please try another Contact Number';
            Session::flash('error_message', $msg); 
            
        }*/




        //dd($user_type);

        $password = Hash::make($password);  

        //Register//         

        $user = new User;

        $user->name          = $username;
        $user->email         = $email;
        $user->phone_number  = $phone_number;
        $user->description   = $description;
        $user->password      = $password; 
		$user->id_cms_privileges      = 4;
        $user->status        = $status;       

        $user->save();

        $last_id=$user->id;

        $to=$email;
        $cc ="";
        $template_slug='registration_email_template';
        $subject = 'You have successfully created your account.';
        $message = 'Your account has been created successfully.Your Sign In details is given bellow.Plese use this credential to sign in to your account. ';


        $config = [
                'from' => [
                    'name' => CRUDBooster::getSetting('appname'),
                    'email'=> CRUDBooster::getSetting('email_sender')
                ],
                'to' => $to,
                'email_slug_name' => $template_slug,
                'mail_key_code' => [
                    'name'=>$username,
                    'message'=>$message,
                    'email'=>$email,
                    'password'=>$password_actual
                ],
                'subject' =>  $subject
        ];
        $result =  $this->initiateMail($config); 

        



        Session::put('currentusrtype' , 'customer');
        Session::flash('succ_message', 'Thank you for registering.Now you can log in to your account.'); 
        return redirect()->to('en/thank-you/registration');

    }

    public function user_update(Request $request){
        $folderName     =   date('Y')."-".date('m');
        $path = storage_path('/app/uploads/1/'.$folderName);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }        
        $user_id        =   $request->input('user_id');
        $username       =   $request->input('user_name');
        $email          =   $request->input('email');
        $phone_number   =   $request->input('phone_number');
        $description    =   $request->input('description');
        $password       =   $request->input('user_password');

        $request->validate([
            'user_name'          => 'required|max:255', 
            'phone_number'       => 'required|max:10',
			'user_image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if($password != ""){            
            $password = Hash::make($password);    
        }

        // $cover = $request->file('user_image');
        // $extension = $cover->getClientOriginalExtension();
        // Storage::disk('local')->put($cover->getFilename().'.'.$extension,  File::get($cover));
        if ($request->hasfile('user_image')) {
        $image = $request->file('user_image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = storage_path('app/uploads/1/'.$folderName.'/') . $filename;

        Image::make($image)->save($location);

      }
        
        $user = User::find($user_id);
        $user->name          = $username;    
        $user->phone_number  = $phone_number;
        $user->description   = $description;
        if($password!=""){
            $user->password      = $password;        
        }
        if ($request->hasfile('user_image')) {
            $user->photo = "uploads/1/".$folderName."/".$filename;
        }
        $user->save();
        Session::flash('success_message', 'Success.You have successfully update your profile.'); 

        return redirect()->action('UserController@update_account');      
    }

    function dashboard(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data['count_inquery'] = AdvertisementInquirie::where('type','Unread')
                ->where('user_id',$data['userDetails']->id)
               ->count();
        return View::make('dashboard')->with($data);
    }

    public function update_account(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        return View::make('update_account')->with($data);
    }

    public function wallet(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data['transactionList'] = Usertransaction::where('user_id',$data['userDetails']->id)->paginate(6);
        return View::make('wallet')->with($data);
    }

    function user_logout()
    {
        session()->forget('userexist');
        $msg= 'Your have successfully loged out.';
        Session::flash('success_message', $msg);
        //return redirect()->action('StoreController@index');
        return redirect('en/login');
    }
}
