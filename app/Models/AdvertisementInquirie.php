<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementInquirie extends Model
{   

    public function getAdvtDetails(){
        return $this->belongsTo(Advertisement::class, 'ads_id', 'id');
    }
}
