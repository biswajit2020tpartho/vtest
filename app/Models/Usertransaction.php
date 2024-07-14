<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usertransaction extends Model
{
    protected $table = 'transactions';
	protected $fillable = [
        "user_id",
        "description",
        "credit_point",
        "type",
        "created_at",
        "updated_at"
    ];
}
