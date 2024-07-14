<?php

namespace App\Http\Middleware;

use Closure;
use CRUDBooster;
use Session;
use App\Models\User;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(session()->get('userexist')!=""){
            if(!User::where([['email','=',session()->get('userexist')],['status','=','Active']])->first()){
                Session::flush();
                Session::flash('error_message', "You have banned from the system , contact administrator for furthur help.");
				return redirect('login');  
            }    
        }else{            
            Session::flash('error_message', "You are not logged in");
           return redirect('login'); 
        }       
        return $next($request);
    }
}
