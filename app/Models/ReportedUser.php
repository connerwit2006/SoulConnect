<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportedUser extends Model
{
    protected $fillable = [
        'user_id', 
        'reported_user_id', 
    ];
}
