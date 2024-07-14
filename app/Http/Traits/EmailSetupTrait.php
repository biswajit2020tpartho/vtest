<?php
namespace App\Http\Traits;
use DB;
use Mail;
use CRUDBooster;
trait EmailSetupTrait {
	public function initiateMail($config = []){
	// dd($config);
		if(!empty($config)){
			$data=array();
			if($config['email_slug_name']){
			$template = DB::table('cms_email_templates')->where("slug",$config['email_slug_name'])->first();
			// dd($template);
		}else{
			$template = new \stdClass();
			$template->subject = ($config['subject']!='')?$config['subject']:"";
			$template->email_content = ($config['email_content']!='')?$config['email_content']:"";
		}

		if($config['mail_key_code']!=NULL){
				$pattern = array(); $pattern = '[%s]'; $map = array();
				foreach($config['mail_key_code'] as $var => $value){
				$map[sprintf($pattern, $var)] = $value;
			}
			$body = strtr($template->content, $map);
		}else{
			$body = $template->email_content;
		}

		//setting cc , if cc is set in mail template then use it otherwise use mail settings global Cc
// dd($template);
		$Cc = null;
		if($template->cc_email){
			$Cc = $template->cc_email;
		}else{
			$setting = DB::table('cms_settings')->where("name","mail_cc")->first();
			$Cc = $setting->content;
		}
		$config['cc'][] = $Cc;
		$total_to = $config['to'];

		CRUDBooster::sendEmail(['to'=>$total_to,'data'=>$config['mail_key_code'],'template'=>$config['email_slug_name'],'attachments'=>[]]);
		return true;

		}else{
			return false;
		}
	}
}