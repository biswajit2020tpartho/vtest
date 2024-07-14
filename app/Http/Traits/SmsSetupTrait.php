<?php 
namespace App\Http\Traits;

use DB;
use Mail;
trait SmsSetupTrait {
    public function initiateSms($config = []){
    //dd($config);
    	

            if(!empty($config)){ 
                $numbers = $config["numbers"];
                $message = $config["message"];
                $post_data = array(
                    // 'From' doesn't matter; For transactional, this will be replaced with your SenderId;
                    // For promotional, this will be ignored by the SMS gateway
                    'From'   => '08047180005',
                    'To'    => $numbers,
                    'Body'  => $message, //Incase you are wondering who Dr. Rajasekhar is http://en.wikipedia.org/wiki/Dr._Rajasekhar_(actor)
                );

                
                 
                // You can get your $exotel_sid, $api_key and $api_token from: https://my.exotel.com/apisettings/site#api-credentials 
                $api_key = "2e20f72ef0f5067e017cef75e313628661f6451e88e76444"; // Your `API KEY`.
                $api_token = "5d9c258eb69191dfc78779ebae012f1a2d57b46a6e6177d7"; // Your `API TOKEN`
                $exotel_sid = "tbd5c2"; // Your `Account Sid`
                 
                $url = "https://".$api_key.":".$api_token."@twilix.exotel.in/v1/Accounts/".$exotel_sid."/Sms/send";
                 
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_FAILONERROR, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_data));
                 
                $http_result = curl_exec($ch);
                $error = curl_error($ch);
                $http_code = curl_getinfo($ch ,CURLINFO_HTTP_CODE);
                 
                curl_close($ch);
                 
                print "".print_r($http_result);
                
                //echo '1'; 
                
            }
    }
}