<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class SeoUrl extends Model
{
	/**
	*@traits 
	*/
	use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', "model"
    ];

	/**
	* Return the sluggable configuration array for this model.
	*
	* @return array
	*/
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => ''
            ]
        ];
    }

    public function resource(){
        return $this->hasOne($this->model);
    }
}
