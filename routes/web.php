<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::name('locale.switch')->get('switch/{locale}', 'LocaleController@switch');
//Route::name('home.lang')->get('lang/{locale}', 'HomeController@lang');
$locale = request()->segment(1);
if($locale!='admin'){
	Route::group(['middleware' => ['web', 'localized'], 'prefix' => $locale], function () {		
		Route::get('/','HomeController@index');
		Route::get('/all-ads/{slug?}','AdvertisementController@index');		
		Route::get('/login', 'UserController@login');
		Route::get('/logout', 'UserController@user_logout');
		Route::post('/login-validate',  'UserController@login_validate');
		Route::post('/forgot-password', 'UserController@forgot_password');
		Route::post('/customer-insert', 'UserController@customer_insert');		
		Route::get('thank-you/{slug?}', 'HomeController@thank_you');
		Route::get('adsdetails/{slug?}','AdvertisementController@ads_details');
		Route::get('page/{id}','PageController@index');
		Route::post('contact-submit','PageController@contact_submit');
		Route::get('search-result','AdvertisementController@search_result');		
		Route::get('/get-ads/{category}/{rating}/{price}/{state?}', 'AdvertisementController@filter_ads');
		Route::post('/submitInquiry','HomeController@submitInquiry');
		Route::post('/get-state','HomeController@get_state');
		Route::any('updat-review/{id}/{slug}','AdvertisementController@updat_review');
		Route::group([
		    'middleware' => ['App\Http\Middleware\Auth'],
		], function () {
			Route::get('dashboard','UserController@dashboard');	
			Route::get('update-account','UserController@update_account');
			Route::post('/user-update', 'UserController@user_update');	
			Route::get('/wallet', 'UserController@wallet');
			Route::get('/wish-list', 'AdvertisementController@wish_list');	
			Route::get('/view-and-manage-ads', 'AdvertisementController@manage_ads');	
			Route::get('/edit-post/{slug?}','AdvertisementController@edit_ads');	
			Route::get('/ads-review/{slug?}','AdvertisementController@ads_review');	
			Route::POST('/edit-post','AdvertisementController@update_post');	
			Route::get('/post-add', 'AdvertisementController@add_post');	
			Route::POST('/post-add', 'AdvertisementController@insert_post');	
			Route::get('/view-inquiries', 'AdvertisementController@view_inquiries');	
			Route::get('/purchase-packages', 'PackagesController@index');	
			Route::get('/inquiries_data', 'AdvertisementController@getInquiriesData');	
			Route::POST('/create-payment', 'PaymentController@createPayment');	
			Route::POST('/upload-image', 'AdvertisementController@upload_image');	
			Route::POST('/sent-mail-admin', 'MailController@sent_mail_admin');	
			Route::get('/compose-mail', 'MailController@compose_mail');	
			Route::get('/mail-inbox', 'MailController@mail_inbox');	
			Route::get('/mail-trash', 'MailController@mail_trash');	
			Route::any('/confirm-payment', 'PaymentController@confirmPayment');	
			Route::any('/payment-fail', 'PaymentController@payment_fail');
			Route::get('/mail-sendbox', 'MailController@index');
			Route::get('/other-members', 'MailController@other_members');
			Route::POST('/mail-change-state','MailController@mail_change_state');
			Route::POST('/sent-mail-others','MailController@sent_mail_others');
			Route::get('/ads-images/{slug}','AdvertisementController@ads_images');
			Route::get('/get_aminities/{id}','AjaxController@get_aminities');			
			Route::any('remove-wishlist/{id}/{slug}','WishlistController@remove_wishlist');
			// Route::get('/get-ads/{category}/{price}/{lang}/{page?}', 'AdvertisementController@filter_ads');
		});			
	}); 
}

//Route::get('/adsdetails/{id}','AdvertisementController@ads_details');
Route::POST('get_state','AjaxController@getsate');	
Route::POST('get_city','AjaxController@get_city');	
Route::POST('delete-ads','AdvertisementController@delete_ads');	
Route::POST('delete-ads-image','AdvertisementController@delete_ads_image');	
Route::get('view-ads-details/{id}','AdvertisementController@view_ads_details');	
Route::get('/inquery_data/{id}','AdvertisementController@inquery_data');
Route::get('/mail-data/{id}','MailController@mail_data');
Route::get('/package_details/{id}','PackagesController@packageDetails');
Route::post('wishlist-add','WishlistController@add');

Route::post('adsReview','AdvertisementController@write');
Route::post('adsInquery','AdvertisementController@adsInquery');
Route::get('/home', 'HomeController@index')->name('home');

