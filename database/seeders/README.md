# 🌱 Database Seeders

## Overview

Laravel Starter Kit menyediakan seeder untuk mengisi database dengan data sample yang siap digunakan untuk development dan testing.

---

## Available Seeders

### UserSeeder

Seeds the `users` table with sample user accounts.

**What it creates:**
- ✅ 1 Administrator account
- ✅ 20 Regular user accounts
- ✅ Mix of verified and unverified users (every 3rd user is unverified)

**Default Credentials:**
- **Email**: `admin@example.com` (Administrator)
- **Email**: `user01@example.com` to `user20@example.com` (Regular users)
- **Password**: `password` (for all accounts)

---

## Usage

### Run All Seeders

```bash
php artisan db:seed
```

### Run Specific Seeder

```bash
php artisan db:seed --class=UserSeeder
```

### Fresh Migration with Seeding

```bash
php artisan migrate:fresh --seed
```

---

## Seeder Details

### UserSeeder Configuration

```php
// Number of regular users to create
private const REGULAR_USERS_COUNT = 20;

// Default password for all users
private const DEFAULT_PASSWORD = 'password';
```

### User Data Structure

Each user is created with:

| Field | Description | Example |
|-------|-------------|---------|
| `name` | User's full name | "Administrator", "User 01" |
| `email` | Unique email address | "admin@example.com" |
| `email_verified_at` | Email verification timestamp | `now()` or `null` |
| `password` | Hashed password | Hash of "password" |
| `remember_token` | Remember me token | Random 10 characters |
| `created_at` | Creation timestamp | `now()` |
| `updated_at` | Last update timestamp | `now()` |

---

## Customization

### Change Number of Users

Edit `UserSeeder.php`:

```php
private const REGULAR_USERS_COUNT = 50; // Create 50 users instead of 20
```

### Change Default Password

```php
private const DEFAULT_PASSWORD = 'your-password-here';
```

### Customize Verification Pattern

```php
// Current: Every 3rd user is unverified
$verified = $number % 3 === 0;

// All verified
$verified = true;

// All unverified
$verified = false;

// Random verification
$verified = rand(0, 1) === 1;
```

### Add Custom User Data

```php
private function generateUsers(): array
{
    $users = [
        $this->createUserData('Administrator', 'admin@example.com', true),
        
        // Add your custom users here
        $this->createUserData('John Doe', 'john@example.com', true),
        $this->createUserData('Jane Smith', 'jane@example.com', true),
    ];

    // ... rest of the code
}
```

---

## Integration with DatabaseSeeder

The installer automatically adds UserSeeder to `DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        
        // Add more seeders here
        // $this->call(ProductSeeder::class);
        // $this->call(CategorySeeder::class);
    }
}
```

---

## Testing

### Verify Seeded Data

```bash
# Count users
php artisan tinker
>>> \App\Models\User::count()
=> 21

# Check admin user
>>> \App\Models\User::where('email', 'admin@example.com')->first()

# Check verified users
>>> \App\Models\User::whereNotNull('email_verified_at')->count()
```

### Login with Seeded Accounts

```php
// In your test or controller
Auth::attempt([
    'email' => 'admin@example.com',
    'password' => 'password'
]);
```

---

## Best Practices

### ✅ DO

- Use seeders for development and testing data
- Keep default passwords simple for development
- Document any custom seeder logic
- Use constants for configurable values
- Clean up existing data before seeding
- Add output messages for better feedback

### ❌ DON'T

- Use seeders in production (use migrations instead)
- Hardcode sensitive data in seeders
- Create duplicate data without cleanup
- Forget to hash passwords
- Skip email verification for all users

---

## Advanced Usage

### Using Factories

For more complex seeding, use Laravel factories:

```php
use App\Models\User;

public function run(): void
{
    // Create admin
    User::factory()->create([
        'name' => 'Administrator',
        'email' => 'admin@example.com',
        'email_verified_at' => now(),
    ]);

    // Create 20 regular users
    User::factory(20)->create();
    
    // Create 5 unverified users
    User::factory(5)->unverified()->create();
}
```

### Seeding Related Data

```php
public function run(): void
{
    $admin = User::create([
        'name' => 'Administrator',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
    ]);

    // Create related data
    $admin->profile()->create([
        'bio' => 'System Administrator',
        'avatar' => 'default.png',
    ]);
}
```

### Conditional Seeding

```php
public function run(): void
{
    // Only seed if no users exist
    if (User::count() === 0) {
        $this->seedUsers();
    }
    
    // Only seed in development
    if (app()->environment('local')) {
        $this->seedTestData();
    }
}
```

---

## Troubleshooting

### Seeder Not Found

```bash
# Regenerate autoload files
composer dump-autoload

# Clear cache
php artisan optimize:clear
```

### Duplicate Entry Error

The seeder automatically removes existing users with the same emails before inserting. If you still get errors:

```php
// Add this to handle duplicates
DB::table('users')->truncate(); // Clear all users first
```

### Password Not Working

Make sure you're using the correct default password:

```php
private const DEFAULT_PASSWORD = 'password';
```

And that it's properly hashed:

```php
'password' => Hash::make(self::DEFAULT_PASSWORD)
```

---

## Output Example

When running the seeder, you'll see:

```
Seeding: Database\Seeders\UserSeeder
✓ Seeded 21 users successfully
  Default password: password
Seeded:  Database\Seeders\UserSeeder (50.00ms)
Database seeding completed successfully.
```

---

## Additional Resources

- [Laravel Seeding Documentation](https://laravel.com/docs/seeding)
- [Database Factories](https://laravel.com/docs/database-testing#defining-model-factories)
- [Faker Library](https://fakerphp.github.io/)

---

<div align="center">

**Made with ❤️ by Winnicode**

</div>
