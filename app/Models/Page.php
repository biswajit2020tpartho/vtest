<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        "page_title","seo_url_id","description","short_description","meta_title","meta_description","meta_keyword","status","is_menu"
    ];

	protected $casts = [
        'page_title' => 'json',
        'description' => 'json',
        'short_description' => 'json',
    ];
    public function getPageslug(){
        return $this->belongsTo(SeoUrl::class, 'seo_url_id', 'id');
    }

    public function getBanner(){
        return $this->hasMany(Banner::class, 'page_id', 'id')->where('status', 1);
    }

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
    public function getPageShortdescriptionAttribute($page_shdesscription)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($page_shdesscription) ? json_decode($page_shdesscription)->$locale : '';
    }
    public function setPageTitleAttribute($page_title)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $page_title[$labbr];
        }
        $this->attributes['page_title'] = json_encode($jsonTitle);
    }
    public function setPageDescriptionAttribute($page_desscriptions)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $page_desscriptions[$labbr];
        }
        $this->attributes['desscription'] = json_encode($jsonTitle);
    }
    public function setPageShortDescriptionAttribute($page_shdes)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $page_shdes[$labbr];
        }
        $this->attributes['short_description'] = json_encode($jsonTitle);
    }
}
