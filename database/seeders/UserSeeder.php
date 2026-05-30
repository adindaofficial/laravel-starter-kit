<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            $this->userData('Administrator', 'admin@example.com'),
        ];

        for ($number = 1; $number <= 20; $number++) {
            $users[] = $this->userData(sprintf('User %02d', $number), sprintf('user%02d@example.com', $number));
        }

        DB::table('users')
            ->whereIn('email', array_column($users, 'email'))
            ->delete();

        DB::table('users')->insert($users);
    }

    private function userData(string $name, string $email): array
    {
        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
