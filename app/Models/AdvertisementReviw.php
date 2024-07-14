<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementReviw extends Model
{
   protected $fillable = [
        "ads_id","user_id","review_text","rating","status","name",
    ];

    public function getusername(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
