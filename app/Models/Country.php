<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
	*@DESC define ralated table
	**/
    protected $table = 'countries';

    /**
    *@DESC define fillable fields
    **/
    protected $fillable = [
        "country_name",
        "sortname"
    ];

    /**
    *@DESC define explicit type casting
    **/
    protected $casts = [
        'country_name' => 'json',
    ];


    public function getCountryNameAttribute($board_name)
    { 
        $locale = \App::getLocale();
        if (!array_key_exists($locale, config('app.locales'))) {
            $locale = 'en';
        }        
        return isset($board_name) ? json_decode($board_name)->$locale : '';
    }


    public function setCountryNameAttribute($board_name)
    {
        $locales = config('app.locales');
        $jsonTitle = app()->make('stdClass');

        foreach ($locales as $labbr => $locale) {
            $jsonTitle->{$labbr} = $board_name[$labbr];
        }
        $this->attributes['country_name'] = json_encode($jsonTitle);
    }
}
