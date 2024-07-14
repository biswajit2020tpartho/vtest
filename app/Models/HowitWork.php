<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowitWork extends Model
{
    protected $fillable = [
        "name",
        "image"
    ];
    protected $casts = [
        'name' => 'json',
    ];
    public function getCountryNameAttribute($name)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($name) ? json_decode($name)->$locale : '';
    }

    public function setCountryNameAttribute($name)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $name[$labbr];
        }
        $this->attributes['name'] = json_encode($jsonTitle);
    }


}
