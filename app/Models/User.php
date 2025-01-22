<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nickname',
        'oneliner',
        'appreciate',
        'lookingfor',
        'face',
        'gender',
        'lookingforgender',
        'dob',
        'postcode',
        'relationshiptype',
        'terms', 
        'email_verified',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function calculateMatchScore(User $user)
    {
        $score = 0;
        $distance = 0;

        //gender match
        if($this->lookingforgender == $user->gender) {
            $score += 5;
        }

        //reltionship match
        if($this->relationshiptype == $user->relationshiptype) {
            $score += 3;
        }

        //location match
        if($distance <= 30) {
            $score += 2;
        } else {
            $score += 1;
        }

        return $score;
    }

    //distance calculation WIP
    public function calculateDistance(){
        //hardcoded zipcodes, will be replaced with user input
        $zip1 = "1000 AB";
        $zip2 = "2000 CD";

        $val1 = intval($zip1);
        $val2 = intval($zip2);

        $distance = $val1 - $val2;

        return $distance;
    }
}
