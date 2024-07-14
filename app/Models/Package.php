<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        "title","image","seo_url_id","description","credit_point","price","expires_in_months","status"
    ];

	protected $casts = [
        'title' => 'json',
        'description' => 'json'
    ];

    public function getPageTitleAttribute($page_title)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($page_title) ? json_decode($page_title)->$locale : '';
    }

    public function getPageDescriptionAttribute($page_desscription)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($page_desscription) ? json_decode($page_desscription)->$locale : '';
    }
}
