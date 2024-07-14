<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\Models\Payments;
use App\Models\User;
use App\Models\Package;
use App\Models\PackagesSubscription;
use App\Models\Usertransaction;
use Redirect;
use Session;
use URL;
 
class PaymentController extends Controller
{
	private $_api_context;

    public function __construct()
    {
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
 
   
    public function createPayment(Request $request)
    {    	
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName($request->get('item_id')) /** item name **/
            ->setCurrency('EUR')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('EUR')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('en/confirm-payment?amount='.$request->get('amount'))) /** Specify return URL **/
            ->setCancelUrl(URL::to('payment-fail'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');

            } else {

                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::to('/');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('package_id', $request->get('item_id'));        
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');

    }

 
    public function confirmPayment(Request $request)
    {
    	$payment_id = Session::get('paypal_payment_id');
    	//$payment_id = Input::get('PayerID');
        $package_id = Session::get('package_id');      
        $packageDetails = Package::where('id',$package_id)->first();
    	$userDetails = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();    	
        // Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            Session::flash('error_message', "Payment failed");
            return redirect()->action('PackagesController@index');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);       
        if ($result->getState() == 'approved') {
        	$insertPayment = Payments::create([
        						"transactions_id" => $payment_id,
                                "user_id"        => $userDetails->id,
                                "amount"         => $packageDetails->price,
                                "status"         => "success",
                            ]);
        	$insertpackages_subscriptions = PackagesSubscription::create([
        		'payment_id' => $insertPayment->id,
        		'package_id' => $package_id,
        		'user_id'	 => $userDetails->id,
        		'status'     => 'success',
        		'start_at'   => date('Y-m-d'),
        		'expires_at' => date('Y-m-d', strtotime('+'.$packageDetails->expires_in_months.' months'))
        	]);

            $updateuser = User::where('id',$userDetails->id)
                ->increment('credit_point',$packageDetails->credit_point);
            $updateuser = User::where('id',$userDetails->id)->update(['id_cms_privileges' => 3]);
            $insertTrns = Usertransaction::create([
                'user_id'       => $userDetails->id,
                'description'   => "Purchase package",
                'credit_point'  => $packageDetails->credit_point,
                'type'          => "credit",
                'created_at'    => date('Y-m-d H:i:s'), 
            
            ]); 
            Session::flash('success_message', "Your payment has been sucessfully submitted!");
            return redirect()->action('PackagesController@index');
        }

        Session::flash('error_message', "Payment failed");
        return Redirect::to('/purchase-packages');
    }
 
    
 	public function payment_fail(){   
   		Session::flash('error_message', "Payment failed");
        return redirect()->action('PackagesController@index');
	}
}