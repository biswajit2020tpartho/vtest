<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // $curr_lang = Session::get('locale');
     public function handle($request, Closure $next)
    {
        $locales = config('app.locales');
        $curr_lang = Session::get('currlang');

    // Check if the first segment matches a language code
    if (!array_key_exists($request->segment(1), config('app.locales'))) {
        // Store segments in array
        $segments = $request->segments();

        if($curr_lang!=''){

            $segments = array_prepend($segments, $curr_lang);

        }else{

        // Set the default language code as the first segment
        $segments = array_prepend($segments, config('app.fallback_locale'));

        }
        

        // Redirect to the correct url
        return redirect()->to(implode('/', $segments));
    }

    // The request already contains the language code
    return $next($request);
    }}