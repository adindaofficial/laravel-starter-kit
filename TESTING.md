# 🧪 Testing Guide

## Manual Testing Scenarios

### Test Case 1: Fresh Laravel Installation

**Setup:**
```bash
# Fresh Laravel project
composer create-project laravel/laravel test-app
cd test-app
```

**Initial `routes/web.php`:**
```php
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
```

**Install Package:**
```bash
composer require mwy/laravel-starter-kit:@dev
php artisan starter-kit:install
```

**Expected Result:**
```php
<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Laravel Starter Kit Routes: BEGIN
Route::name('starter-kit.')->group(function (): void {
    // User Management Routes
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
    Route::delete('/users/reset-data', [UserController::class, 'destroyAll'])->name('users.reset-data');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Documentation Route
    Route::view('/documentation', 'documentation.index')->name('documentation.index');
});
// Laravel Starter Kit Routes: END
```

**Verification:**
```bash
# Check for duplicates
grep -c "use Illuminate\Support\Facades\Route" routes/web.php
# Expected: 1

grep -c "use App\Http\Controllers\UserController" routes/web.php
# Expected: 1

# Check formatting
cat routes/web.php | head -20
# Should have proper newlines and spacing
```

---

### Test Case 2: Existing Project with UserController

**Setup:**
```php
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [UserController::class, 'about']);
```

**Install Package:**
```bash
php artisan starter-kit:install
```

**Expected Result:**
```php
<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;  // NOT duplicated
use Illuminate\Support\Facades\Route;     // NOT duplicated

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [UserController::class, 'about']);

// Laravel Starter Kit Routes: BEGIN
Route::name('starter-kit.')->group(function (): void {
    // Routes here...
});
// Laravel Starter Kit Routes: END
```

**Verification:**
```bash
# No duplicates
grep -c "use App\Http\Controllers\UserController" routes/web.php
# Expected: 1

grep -c "use Illuminate\Support\Facades\Route" routes/web.php
# Expected: 1
```

---

### Test Case 3: Re-installation

**Setup:**
```bash
# Install once
php artisan starter-kit:install

# Install again with force
php artisan starter-kit:install --force
```

**Expected Result:**
- Use statements should remain exactly the same
- Only route block should be updated
- No duplicates should appear

**Verification:**
```bash
# Count use statements (should not increase)
grep -c "^use " routes/web.php

# Check route block
grep -A 20 "Laravel Starter Kit Routes: BEGIN" routes/web.php
```

---

### Test Case 4: No Existing Use Statements

**Setup:**
```php
<?php

Route::get('/', function () {
    return view('welcome');
});
```

**Install Package:**
```bash
php artisan starter-kit:install
```

**Expected Result:**
```php
<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Laravel Starter Kit Routes: BEGIN
// ...
```

**Verification:**
- Blank line after `<?php`
- Use statements added
- Blank line after use statements
- Proper spacing maintained

---

## Automated Verification Script

Create `verify-installation.sh`:

```bash
#!/bin/bash

echo "🧪 Verifying Laravel Starter Kit Installation..."
echo ""

# Check for duplicate use statements
echo "1. Checking for duplicate use statements..."
ROUTE_COUNT=$(grep -c "use Illuminate\Support\Facades\Route" routes/web.php)
CONTROLLER_COUNT=$(grep -c "use App\Http\Controllers\UserController" routes/web.php)

if [ "$ROUTE_COUNT" -eq 1 ]; then
    echo "   ✅ Route facade: No duplicates"
else
    echo "   ❌ Route facade: Found $ROUTE_COUNT occurrences (expected 1)"
fi

if [ "$CONTROLLER_COUNT" -eq 1 ]; then
    echo "   ✅ UserController: No duplicates"
else
    echo "   ❌ UserController: Found $CONTROLLER_COUNT occurrences (expected 1)"
fi

# Check for route markers
echo ""
echo "2. Checking for route markers..."
if grep -q "Laravel Starter Kit Routes: BEGIN" routes/web.php; then
    echo "   ✅ BEGIN marker found"
else
    echo "   ❌ BEGIN marker not found"
fi

if grep -q "Laravel Starter Kit Routes: END" routes/web.php; then
    echo "   ✅ END marker found"
else
    echo "   ❌ END marker not found"
fi

# Check file structure
echo ""
echo "3. Checking installed files..."
FILES=(
    "app/Http/Controllers/UserController.php"
    "resources/views/users/index.blade.php"
    "resources/views/documentation/index.blade.php"
    "database/seeders/UserSeeder.php"
)

for file in "${FILES[@]}"; do
    if [ -f "$file" ]; then
        echo "   ✅ $file"
    else
        echo "   ❌ $file (missing)"
    fi
done

# Check routes
echo ""
echo "4. Checking registered routes..."
ROUTES=$(php artisan route:list --name=starter-kit --columns=name,uri | tail -n +4)
if [ -n "$ROUTES" ]; then
    echo "   ✅ Routes registered"
    echo "$ROUTES" | sed 's/^/      /'
else
    echo "   ❌ No routes found"
fi

echo ""
echo "✨ Verification complete!"
```

**Usage:**
```bash
chmod +x verify-installation.sh
./verify-installation.sh
```

---

## Common Issues and Fixes

### Issue 1: No newlines between use statements

**Symptom:**
```php
<?phpuse Illuminate\Support\Facades\Route;
```

**Cause:** Missing newline after `<?php`

**Fix:** Ensure `ensureUseStatements()` adds blank line after `<?php` when no use statements exist.

**Test:**
```bash
# Check first 5 lines
head -5 routes/web.php
# Should show:
# <?php
# 
# use App\Http\Controllers\UserController;
# use Illuminate\Support\Facades\Route;
```

---

### Issue 2: Comments merged with use statements

**Symptom:**
```php
use Illuminate\Support\Facades\Route;/*
|--------------------------------------------------------------------------
```

**Cause:** Missing newline before comment block

**Fix:** `getRouteBlockOnly()` should strip all comments and use statements.

**Test:**
```bash
# Check structure
cat routes/web.php | grep -A 3 "^use "
# Should have blank line after use statements
```

---

### Issue 3: Duplicate use statements

**Symptom:**
```php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Route;
```

**Cause:** Detection not working properly

**Fix:** Use regex matching in `ensureUseStatements()` to detect exact matches.

**Test:**
```bash
# Run multiple times
php artisan starter-kit:install --force
php artisan starter-kit:install --force
php artisan starter-kit:install --force

# Check count
grep -c "use Illuminate\Support\Facades\Route" routes/web.php
# Should always be 1
```

---

## Performance Testing

### Test Installation Speed

```bash
time php artisan starter-kit:install
# Expected: < 5 seconds
```

### Test Route Registration

```bash
time php artisan route:list
# Should complete without errors
```

---

## Integration Testing

### Test with Different Laravel Versions

```bash
# Laravel 10
composer create-project laravel/laravel:^10.0 test-l10
cd test-l10
composer require mwy/laravel-starter-kit:@dev
php artisan starter-kit:install
./verify-installation.sh

# Laravel 11
composer create-project laravel/laravel:^11.0 test-l11
cd test-l11
composer require mwy/laravel-starter-kit:@dev
php artisan starter-kit:install
./verify-installation.sh
```

---

## Rollback Testing

### Test Uninstallation

```bash
# Install
php artisan starter-kit:install

# Verify
./verify-installation.sh

# Uninstall (manual)
# 1. Remove routes block from routes/web.php
# 2. Remove use App\Http\Controllers\UserController; if not used elsewhere
# 3. Remove installed files

# Verify clean state
grep "Laravel Starter Kit" routes/web.php
# Should return nothing
```

---

## Continuous Integration

### GitHub Actions Test

```yaml
name: Test Installation

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
        
    - name: Create Laravel Project
      run: composer create-project laravel/laravel test-app
      
    - name: Install Package
      run: |
        cd test-app
        composer config repositories.starter-kit path ../
        composer require mwy/laravel-starter-kit:@dev
        
    - name: Run Installation
      run: |
        cd test-app
        php artisan starter-kit:install
        
    - name: Verify Installation
      run: |
        cd test-app
        # Check for duplicates
        count=$(grep -c "use Illuminate\Support\Facades\Route" routes/web.php)
        if [ "$count" -ne 1 ]; then
          echo "Duplicate Route facade found!"
          exit 1
        fi
        
        count=$(grep -c "use App\Http\Controllers\UserController" routes/web.php)
        if [ "$count" -ne 1 ]; then
          echo "Duplicate UserController found!"
          exit 1
        fi
        
        echo "✅ All tests passed!"
```

---

## Report Issues

If you find issues during testing:

1. **Document the scenario:**
   - Initial `routes/web.php` content
   - Command used
   - Actual result
   - Expected result

2. **Create a minimal reproduction:**
   ```bash
   # Create fresh Laravel
   composer create-project laravel/laravel issue-test
   
   # Modify routes/web.php to reproduce issue
   # ...
   
   # Install package
   php artisan starter-kit:install
   
   # Show the issue
   cat routes/web.php
   ```

3. **Submit to GitHub Issues** with:
   - Laravel version
   - PHP version
   - Package version
   - Reproduction steps
   - Actual vs Expected output

---

<div align="center">

**Happy Testing! 🧪**

</div>
