<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all users
        $users = User::all();

        // Seed likes and skips
        foreach ($users as $user) {
            // Get random users that this user will interact with (excluding themselves)
            $otherUsers = User::where('id', '!=', $user->id)->inRandomOrder()->take(3)->get();

            foreach ($otherUsers as $otherUser) {
                DB::table('likes')->insert([
                    'user_id' => $user->id,
                    'liked_user_id' => $otherUser->id,
                    'status' => rand(0, 1) ? 'like' : 'skip', // Randomly decide 'like' or 'skip'
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
