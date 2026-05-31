<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * User Seeder
 *
 * Seeds the users table with sample data including:
 * - 1 Administrator account
 * - 20 Regular user accounts
 *
 * All users have the default password: "password"
 *
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * Default password for all seeded users
     *
     * @var string
     */
    private const DEFAULT_PASSWORD = 'password';

    /**
     * Number of regular users to create
     *
     * @var int
     */
    private const REGULAR_USERS_COUNT = 20;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = $this->generateUsers();

        $this->cleanupExistingUsers($users);
        $this->insertUsers($users);

        $this->command->info('✓ Seeded ' . count($users) . ' users successfully');
        $this->command->line('  Default password: ' . self::DEFAULT_PASSWORD);
    }

    /**
     * Generate user data array.
     *
     * @return array<int, array<string, mixed>>
     */
    private function generateUsers(): array
    {
        $users = [
            $this->createUserData('Administrator', 'admin@example.com', true),
        ];

        for ($number = 1; $number <= self::REGULAR_USERS_COUNT; $number++) {
            $users[] = $this->createUserData(
                sprintf('User %02d', $number),
                sprintf('user%02d@example.com', $number),
                $number % 3 === 0 // Every 3rd user is not verified
            );
        }

        return $users;
    }

    /**
     * Create user data array.
     *
     * @param  string  $name
     * @param  string  $email
     * @param  bool  $verified
     * @return array<string, mixed>
     */
    private function createUserData(string $name, string $email, bool $verified = true): array
    {
        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => $verified ? now() : null,
            'password' => Hash::make(self::DEFAULT_PASSWORD),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Remove existing users with the same emails.
     *
     * @param  array<int, array<string, mixed>>  $users
     * @return void
     */
    private function cleanupExistingUsers(array $users): void
    {
        $emails = array_column($users, 'email');

        DB::table('users')
            ->whereIn('email', $emails)
            ->delete();
    }

    /**
     * Insert users into the database.
     *
     * @param  array<int, array<string, mixed>>  $users
     * @return void
     */
    private function insertUsers(array $users): void
    {
        DB::table('users')->insert($users);
    }
}
