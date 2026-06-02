# 📦 Installation Guide

## Overview

This guide provides detailed information about the Laravel Starter Kit installation process, including how routes and use statements are managed.

---

## Installation Process

### Step 1: Install Package

```bash
composer require mwy/laravel-starter-kit
```

### Step 2: Run Installer

```bash
php artisan starter-kit:install
```

---

## What Gets Installed

### Files Created/Updated

1. **Controllers**
   - `app/Http/Controllers/UserController.php`

2. **Views**
   - `resources/views/layouts/tailwind/*`
   - `resources/views/users/index.blade.php`
   - `resources/views/documentation/index.blade.php`

3. **Seeders**
   - `database/seeders/UserSeeder.php`

4. **Routes**
   - Updates `routes/web.php` (smart merge)

---

## Smart Route Management

### How It Works

The installer intelligently manages the `routes/web.php` file to prevent duplicate `use` statements and route definitions.

#### Scenario 1: Fresh Laravel Installation

**Before Installation:**
```php
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
```

**After Installation:**
```php
<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Laravel Starter Kit Routes: BEGIN
Route::name('starter-kit.')->group(function (): void {
    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // ... more routes
});
// Laravel Starter Kit Routes: END
```

**✅ No duplicate `use` statements!**

---

#### Scenario 2: Existing Project with Similar Routes

**Before Installation:**
```php
<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/profile', [UserController::class, 'profile']);
```

**After Installation:**
```php
<?php

use App\Http\Controllers\UserController;  // Already exists - NOT duplicated
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;  // Already exists - NOT duplicated

Route::get('/', [HomeController::class, 'index']);
Route::get('/profile', [UserController::class, 'profile']);

// Laravel Starter Kit Routes: BEGIN
Route::name('starter-kit.')->group(function (): void {
    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // ... more routes
});
// Laravel Starter Kit Routes: END
```

**✅ Existing `use` statements detected and skipped!**

---

#### Scenario 3: Re-installation / Update

**Before Re-installation:**
```php
<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Laravel Starter Kit Routes: BEGIN
Route::name('starter-kit.')->group(function (): void {
    // Old routes...
});
// Laravel Starter Kit Routes: END
```

**After Re-installation:**
```php
<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Laravel Starter Kit Routes: BEGIN
Route::name('starter-kit.')->group(function (): void {
    // Updated routes with new features...
});
// Laravel Starter Kit Routes: END
```

**✅ Routes updated, use statements untouched!**

---

## Use Statement Detection Algorithm

The installer uses smart detection to prevent duplicates:

### Detection Logic

```php
// Check for exact match
if (trim($line) === 'use Illuminate\Support\Facades\Route;') {
    // Already exists - skip
}

// Check for controller import
if (trim($line) === 'use App\Http\Controllers\UserController;') {
    // Already exists - skip
}
```

### Insertion Strategy

1. **Find the best insertion point:**
   - After the last existing `use` statement
   - Or after the `<?php` tag if no `use` statements exist

2. **Add missing use statements:**
   - Only add what's missing
   - Maintain proper spacing
   - Preserve existing order

3. **Add route block:**
   - Append at the end of the file
   - Use managed markers for future updates
   - Remove closing `?>` tag if present

---

## Installation Options

### Force Overwrite

```bash
php artisan starter-kit:install --force
```

Overwrites existing files without prompting.

**Use when:**
- You want to reset to default configuration
- Files have been corrupted
- You need the latest version

**⚠️ Warning:** This will overwrite customizations!

---

### Skip Routes

```bash
php artisan starter-kit:install --without-route
```

Installs files but skips route registration.

**Use when:**
- You want to manually add routes
- You have custom route structure
- Using custom route files

**Manual route addition:**
```php
// Copy from routes/web.php in the package
// Or use:
require __DIR__ . '/starter-kit-routes.php';
```

---

### Specify Stack

```bash
php artisan starter-kit:install --stack=tailwind
```

Currently only Tailwind CSS is supported.

---

## Post-Installation

### 1. Run Migrations

```bash
php artisan migrate
```

### 2. Seed Database

```bash
php artisan db:seed
```

### 3. Verify Installation

```bash
# Check routes
php artisan route:list --name=starter-kit

# Check files
ls -la app/Http/Controllers/UserController.php
ls -la resources/views/users/
ls -la database/seeders/UserSeeder.php
```

### 4. Test Pages

Visit:
- http://your-app.test/users
- http://your-app.test/documentation

---

## Troubleshooting

### Duplicate Use Statements

**Problem:**
```php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route; // Duplicate!
```

**Solution:**
This should not happen with the new installer. If it does:

```bash
# Manually edit routes/web.php and remove duplicates
# Then report the issue on GitHub
```

**Prevention:**
The installer now checks for existing use statements before adding new ones.

---

### Routes Not Added

**Problem:**
Routes don't appear in `routes/web.php`

**Possible causes:**
1. Used `--without-route` flag
2. File permissions issue
3. Routes already exist (check for markers)

**Solution:**
```bash
# Re-run installer with force
php artisan starter-kit:install --force

# Check file permissions
ls -la routes/web.php

# Verify route markers
grep "Laravel Starter Kit Routes" routes/web.php
```

---

### UserController Not Found

**Problem:**
```
Class "App\Http\Controllers\UserController" not found
```

**Solution:**
```bash
# Clear cache
php artisan optimize:clear

# Dump autoload
composer dump-autoload

# Verify file exists
ls -la app/Http/Controllers/UserController.php

# Re-run installer if missing
php artisan starter-kit:install --force
```

---

### Views Not Loading

**Problem:**
View `layouts.tailwind.app` not found

**Solution:**
```bash
# Clear view cache
php artisan view:clear

# Verify views exist
ls -la resources/views/layouts/tailwind/

# Re-install if missing
php artisan starter-kit:install --force
```

---

## Advanced Installation

### Custom Installation Path

If you need to customize where files are installed, extend the installer:

```php
use Mwy\LaravelStarterKit\Services\StarterKitInstaller;

class CustomInstaller extends StarterKitInstaller
{
    protected function installFiles(string $stack, bool $force, ?callable $output): void
    {
        // Your custom logic here
        parent::installFiles($stack, $force, $output);
    }
}
```

### Selective Installation

Install only specific components:

```bash
# Install views only
php artisan vendor:publish --tag=laravel-starter-kit-views

# Install config only
php artisan vendor:publish --tag=laravel-starter-kit-config

# Install seeders only
php artisan vendor:publish --tag=laravel-starter-kit-seeders
```

---

## Uninstallation

To remove Laravel Starter Kit:

### 1. Remove Routes

Edit `routes/web.php` and remove:
```php
// Laravel Starter Kit Routes: BEGIN
// ... (everything between markers)
// Laravel Starter Kit Routes: END
```

### 2. Remove Files

```bash
# Remove controllers
rm app/Http/Controllers/UserController.php

# Remove views
rm -rf resources/views/users
rm -rf resources/views/documentation
rm -rf resources/views/layouts/tailwind

# Remove seeders
rm database/seeders/UserSeeder.php
```

### 3. Remove Package

```bash
composer remove mwy/laravel-starter-kit
```

### 4. Clean Up Database

```bash
# Remove seeded users (optional)
php artisan tinker
>>> DB::table('users')->whereIn('email', ['admin@example.com', 'user01@example.com'])->delete();
```

---

## Best Practices

### ✅ DO

- Review changes before committing
- Test after installation
- Keep backups of customizations
- Use version control (Git)
- Document custom modifications
- Update regularly

### ❌ DON'T

- Edit package files directly
- Skip reading documentation
- Force install in production without testing
- Ignore warning messages
- Modify core route markers
- Remove safety checks

---

## Migration Guide

### Upgrading from v1.x to v2.x

1. **Backup your customizations**
2. **Run new installer:**
   ```bash
   php artisan starter-kit:install --force
   ```
3. **Verify use statements:**
   ```bash
   grep "use " routes/web.php
   ```
4. **Test all functionality**

---

## Support

Need help? Check:

- 📖 [Documentation](README.md)
- 🐛 [GitHub Issues](https://github.com/winnicode/laravel-starter-kit/issues)
- 💬 [Discussions](https://github.com/winnicode/laravel-starter-kit/discussions)
- 📧 Email: support@winnicode.com

---

<div align="center">

**Made with ❤️ by Winnicode**

Happy Coding! 🚀

</div>
