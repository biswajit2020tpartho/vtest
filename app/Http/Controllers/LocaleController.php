<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Session;

class LocaleController extends Controller
{
    protected $previousRequest;
    protected $locale;

    public function switch($locale)
    {      

        $this->previousRequest = $this->getPreviousRequest();
        $this->locale = $locale;

        // Store the segments of the last request as an array
        $segments = $this->previousRequest->segments();

        // Check if the first segment matches a language code
        if (array_key_exists($this->locale, config('app.locales'))) {
            // Replace the first segment by the new language code
            $segments[0] = $this->locale;

            $newRoute = $this->translateRouteSegments($segments);
 //            echo $segments[2];
 // dd($this->buildNewRoute($newRoute));

            if($locale == 'en'){
                if($segments[2] == 'en'){
                $urll = str_replace('/public/en', '', $this->buildNewRoute($newRoute));
            }else{
                 $urll = str_replace('/public/ge', '', $this->buildNewRoute($newRoute));
            }

            }elseif($locale == 'ge'){
                if($segments[2] == 'ge'){
                    $urll = str_replace('/public/ge', '', $this->buildNewRoute($newRoute));
                }else{

                $urll = str_replace('/public/en', '', $this->buildNewRoute($newRoute));
            }

            }

            Session::put('currlang', $locale);
            Session::save();

            // Redirect to the required URL
            return redirect()->to($urll);
        }

        return back();
    }

    protected function getPreviousRequest()
    {
        // We Transform the URL on which the user was into a Request instance
        return request()->create(url()->previous());
    }

    protected function translateRouteSegments($segments)
    {
        $translatedSegments = collect();

        foreach ($segments as $segment) {
            if ($key = array_search($segment, array('1','2','3'))) {
                // The segment exists in the translations, so we will grab the translated version.
                $translatedSegments->push(trans('routes.' . $key, [], $this->locale));
            } else {
                // Otherwise we simply reuse the same.
                $translatedSegments->push($segment);
            }
        }

        return $translatedSegments;
    }

    protected function buildNewRoute($newRoute)
    {       
        $redirectUrl = implode('/', $newRoute->toArray());

        // Get Query Parameters if any, so they are preserved
        $queryBag = $this->previousRequest->query();       
        
        $redirectUrl .= count($queryBag) ? '?' . http_build_query($queryBag) : '';        

        return $redirectUrl;
    }
}