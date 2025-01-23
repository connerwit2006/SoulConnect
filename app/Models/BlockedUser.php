<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedUser extends Model
{
    protected $fillable = [
        'blocked_user_id', 
        'blocked_by_user_id'
    ];
}
