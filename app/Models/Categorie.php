<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Categorie extends Model
{

	protected $fillable = [
        "name","parent_id","seo_url_id",
        "descriptions",
        "short_descriptions",
        "image"
    ];

	protected $casts = [
        'names' => 'json',
        'descriptions' => 'json',
        'short_descriptions' => 'json',
    ];
    public function getPageslug(){
        return $this->belongsTo(SeoUrl::class, 'seo_url_id', 'id');
    }

    public function getCategorywiseAds(){
        return $this->hasMany(Advertisement::class, 'cat_id', 'id');
    }
    public function getNameAttribute($category_name)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($category_name) ? json_decode($category_name)->$locale : '';
    }

    public function getDescriptionsAttribute($category_name)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($category_name) ? json_decode($category_name)->$locale : '';
    }

    public function getShortDescriptionsAttribute($category_name)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($category_name) ? json_decode($category_name)->$locale : '';
    }


    public function setNameAttribute($category_name)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $category_name[$labbr];
        }
        $this->attributes['name'] = json_encode($jsonTitle);
    }
    public function setDescriptionsAttribute($category_name)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $category_name[$labbr];
        }
        $this->attributes['descriptions'] = json_encode($jsonTitle);
    }
    public function setShortDescriptionsAttribute($category_name)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $category_name[$labbr];
        }
        $this->attributes['short_descriptions'] = json_encode($jsonTitle);
    }
}
