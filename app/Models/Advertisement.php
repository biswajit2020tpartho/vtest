<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    protected $fillable = [
        "user_id","title","images",
        "country_id","state_id","city_id","view","status","approved","is_featured","created_at","updated_at","short_description","description","cat_id","amount","seo_url_id",
    ];
    //relations
    public function getAdvtCategory(){
        return $this->belongsTo(Categorie::class, 'cat_id');
    }

    public function getPageslug(){
        return $this->belongsTo(SeoUrl::class, 'seo_url_id', 'id');
    }


    public function getAdvtCountry(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function getAdvtStates(){
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function getAdvtCity(){
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function getSellerDetails(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getAdvtwishlist(){
        return $this->hasMany(Wishlist::class, 'ads_id', 'id');
    }

    public function getAdvtamenities(){
        return $this->hasMany(AdvertisementAmentie::class, 'ads_id', 'id');
    }


    public function getAdvtReview(){
        return $this->hasMany(AdvertisementReviw::class, 'ads_id', 'id')->where('status', 1);
    }

    public function scopeCompleted($query, $arg)
    {
        return $query->where('user_id', $arg);
    }

}
