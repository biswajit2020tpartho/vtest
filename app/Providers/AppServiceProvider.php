<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;
use App\Models\Social;
use App\Models\Setting;
use App\Models\Categorie;
use App\Models\Page;
use App\Models\Visitor;
use App\Models\SeoUrl;
use App\Models\User;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set the app locale according to the URL
        app()->setLocale(request()->segment(1));
        $curr_lang = request()->segment(1);
        // dd($curr_lang);
        View::composer(['layout.header','layout.footer','layout.nav','layout.sidebar'], function ($view) {
            $data = array();
            $data['socialMedia']=   Social::where('status',1)->get();
            $data['navMenu']    =   Categorie::where('is_menu',1)->get();
            $data['settings']   =   Setting::find(1);
            $data['curr_lang']  =   request()->segment(1);
            $data['footer_menu']     = Page::where('status',1)->where('is_menu','1')->where('id','<>','2')->get();    
            $data['nos_user']  = User::where('id','<>',1)->where('id','<>',2)->count();  
            $data['visitor']    = Visitor::distinct('ip_address')->count('ip_address');
            if(session()->get('userexist')!=""){
                $data['userDetails'] = User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first();
            }   
            //dd( $data['userDetails']);
            $view->with('data',$data); // bind data to view
        });
    }
}
