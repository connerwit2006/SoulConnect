<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'liked_user_id', 'status'];

    /**
     * Define the relationship to the user who performed the like/skip.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Define the relationship to the user who was liked/skipped.
     */
    public function likedUser()
    {
        return $this->belongsTo(User::class, 'liked_user_id');
    }
}
