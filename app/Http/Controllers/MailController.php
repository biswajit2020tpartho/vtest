<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usermail;
use App\Models\User;
use App\Models\AdvertisementInquirie;
use App\Http\Traits\EmailSetupTrait;
use App\Http\Traits\SmsSetupTrait;
use CRUDBooster;
use Mail;
use View;
use Session;

class MailController extends Controller
{
    use EmailSetupTrait,SmsSetupTrait;
    function __construct(){

        Session::flush();
    }

    public function index(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data['sendEmailDetails'] = Usermail::where('status',0)
            ->where('mail_type','From')
            ->where('email',session()->get('userexist'))
            ->orderBy('id','DESC')
            ->paginate(10);
        $data["redirect_url"] = "MailController@index";
        return View::make('mail_administrator')->with($data);
    }

    public function sent_mail_admin(Request $request){
        $userDetails = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $to_email = $request->input('to_email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $request->validate([
            'to_email'          => 'required',           
            'subject'           => 'required',
            'message'           => 'required',         
        ]);

        $Usermail = new Usermail;
        $Usermail->to_email      = $to_email;
        $Usermail->email         = session()->get('userexist');
        $Usermail->from_email    = session()->get('userexist');
        $Usermail->subject       = $subject;
        $Usermail->message       = $message;
        $Usermail->type          = "Read";
        $Usermail->mail_type     = "From";       
        if( $Usermail->save()){
            $Usermail = new Usermail;
            $Usermail->to_email      = $to_email;
            $Usermail->email         = $request->input('to_email');
            $Usermail->from_email    = session()->get('userexist');
            $Usermail->subject       = $subject;
            $Usermail->message       = $message;
            $Usermail->type          = "Unread";
            $Usermail->mail_type     = "To";   
            $Usermail->save();
        }
        Session::flash('success_message', 'Mail send Successfully.'); 

        return redirect()->action('MailController@index');

    }

    public function compose_mail(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        return View::make('compose_mail')->with($data);
    }

    public function mail_inbox(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
            
        $data['sendEmailDetails'] = Usermail::where('status',0)
            ->where('mail_type','To')
            ->where('email',session()->get('userexist'))
            ->orderBy('id','DESC')
            ->paginate(10);

        $data["redirect_url"] = "MailController@mail_inbox";

        return View::make('mail_administrator')->with($data);
    }
    public function mail_trash(){
        $data = array();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        
        $data['sendEmailDetails'] = Usermail::where('status',1)
            ->where('mail_type','From')
            ->where('email',session()->get('userexist'))
            ->orderBy('id','DESC')
            ->paginate(10);
        $data["redirect_url"] = "MailController@mail_trash";

        return View::make('mail_administrator')->with($data);
    }

    public function mail_change_state(Request $request){
        $action = $request->input('change_val');
        $redirect_url = $request->input('redirect_url');

        $idArray = $request->input('select_all');
        if($action == "trash"){
            $update = Usermail::whereIn('id',$idArray)->update(['status'=> 1]);
            Session::flash('success_message', 'Message successfully move to trash.');
        }elseif($action == "read"){
            $update = Usermail::whereIn('id',$idArray)->update(['type'=> "Unread"]);
            Session::flash('success_message', 'You have successfully update your message.');
        }elseif($action == "delete"){
            $delete =  Usermail::whereIn('id', $idArray)->delete();             
            Session::flash('success_message', 'You have successfully Delete your message.');
        }elseif($action == "move_to_inbox"){
            $update = Usermail::whereIn('id',$idArray)->update(['status'=> 0]);
            Session::flash('success_message', 'Message successfully move to Inbox.');
        }else{
            $update = Usermail::whereIn('id',$idArray)->update(['type'=> "Read"]);
            Session::flash('success_message', 'You have successfully update your message.');
        }
        return redirect()->action($redirect_url); 
    }

    public function mail_data($id){
        if(request()->ajax())
        {
            $data = Usermail::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    public function other_members(){
        $data = array();
        $userDetails = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
        $data["allCustomer"] = AdvertisementInquirie::where('user_id',$userDetails->id)->get();
        return View::make('mail_others')->with($data);
    }

     public function sent_mail_others(Request $request){
        $to_email = $request->input('to_email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        if($to_email == "customer"){
            $customer_email = $request->input('customer_email');            
            foreach ($customer_email as $key => $value) {
                $to=$value;
                $cc ="";
                $template_slug='seller_to_customer';
                $subject = $subject;

                $config = [
                        'from' => [
                            'name' => CRUDBooster::getSetting('appname'),
                            'email'=> CRUDBooster::getSetting('email_sender')
                        ],
                        'to' => $to,
                        'email_slug_name' => $template_slug,
                        'mail_key_code' => [
                            'message'=>$message
                        ],
                        'subject' =>  $subject
                ];
                $result =  $this->initiateMail($config); 
            }
        }else{
            $to=$request->input('any_email');
            $cc ="";
            $template_slug='seller_to_customer';
            $subject = $subject;

            $config = [
                    'from' => [
                        'name' => CRUDBooster::getSetting('appname'),
                        'email'=> CRUDBooster::getSetting('email_sender')
                    ],
                    'to' => $to,
                    'email_slug_name' => $template_slug,
                    'mail_key_code' => [
                        'message'=>$message
                    ],
                    'subject' =>  $subject
            ];
            $result =  $this->initiateMail($config); 
        }
        Session::flash('success_message', 'Mail send successfully.');
        return redirect()->action('MailController@other_members');

    }
}
