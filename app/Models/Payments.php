<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        "transactions_id",
        "user_id",
        "amount",
        "status"
    ];
}
