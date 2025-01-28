<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Transaction.php
    protected $fillable = [
        'user_id',
        'transaction_id',
        'amount',
        'status',
        'payment_method',
        'processed_at',
        'expiration_date',
    ];


    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
