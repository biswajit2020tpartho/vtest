<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackagesSubscription extends Model
{
    protected $fillable = [
        "payment_id",
        "package_id",
        "user_id",
        "start_at",
        "expires_at",
        "status"
    ];
}
