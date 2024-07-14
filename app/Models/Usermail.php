<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usermail extends Model
{
    protected $table = 'mails';
    protected $fillable = [
        "to_email","from_email","email",
        "subject",
        "message",
        "status","type","mail_type"
    ];
}
