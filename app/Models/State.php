<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    
    protected $fillable = [
        "state_name","country_id","status","image","show_in_home"
    ];

	public function getPageslug(){
        return $this->belongsTo(SeoUrl::class, 'seo_url_id', 'id');
    }
    


}
