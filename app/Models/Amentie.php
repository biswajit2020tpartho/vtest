<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amentie extends Model
{
    protected $fillable = [
        "name","cat_id",
        "image",
        "status",
        "image"
    ];

	protected $casts = [
        'name' => 'json',
    ];

    public function getNameAttribute($name)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($name) ? json_decode($name)->$locale : '';
    }
    public function setNameAttribute($name)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $name[$labbr];
        }
        $this->attributes['name'] = json_encode($jsonTitle);
    }
}
