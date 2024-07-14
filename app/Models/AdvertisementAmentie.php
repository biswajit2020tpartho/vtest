<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementAmentie extends Model
{
	protected $fillable = [
        "ads_id","amenties_id","status",
    ];

    public function getAmenties(){
        return $this->belongsTo(Amentie::class, 'amenties_id');
    }
}
