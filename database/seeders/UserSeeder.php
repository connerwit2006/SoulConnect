<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'nickname' => $faker->unique()->userName ?? 'guest_' . $i,
                'one_liner' => $faker->sentence(6),
                'appreciate' => $faker->words(3, true),
                'looking_for' => $faker->sentence(4),
                'face_card' => $faker->imageUrl(150, 150, 'people'),
                'gender' => $faker->randomElement(['male', 'female']),
                'looking_for_gender' => $faker->randomElement(['male', 'female']),
                'dob' => $faker->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
                'postcode' => $this->generateDutchPostcode(),
                'relationship_type' => $faker->randomElement(['friendly', 'romantic']),
                'terms' => true,
                'email_verified' => true,
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }
    }
    private function generateDutchPostcode(): string
    {
        $digits = random_int(1000, 9999); // Generate 4 random digits
        $letters = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 2)); // Generate 2 random uppercase letters
        return "{$digits} {$letters}"; // Combine digits and letters
    }
}
