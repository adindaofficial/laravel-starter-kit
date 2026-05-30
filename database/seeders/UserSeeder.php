<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->createUser('Administrator', 'admin@example.com');

        for ($number = 1; $number <= 20; $number++) {
            $this->createUser(
                sprintf('User %02d', $number),
                sprintf('user%02d@example.com', $number),
            );
        }
    }

    private function createUser(string $name, string $email): void
    {
        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
        );
    }
}
