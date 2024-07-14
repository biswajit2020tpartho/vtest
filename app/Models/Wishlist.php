<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'users_wishlist';

    public function getwishlistDetails(){
        return $this->belongsTo(Advertisement::class,'ads_id');
    }

    



}
