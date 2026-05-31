# 🛣️ Routes Documentation

## Overview

Laravel Starter Kit menyediakan route yang sudah dikonfigurasi untuk user management dan documentation page. Routes menggunakan format modern Laravel dengan `use` statements untuk clean code.

---

## Route Structure

### Import Statements

```php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
```

**Benefits:**
- ✅ Clean dan readable code
- ✅ No fully qualified namespaces
- ✅ IDE autocomplete support
- ✅ Easier refactoring
- ✅ Professional Laravel standard

---

## Available Routes

### User Management Routes

All routes are prefixed with `starter-kit.` namespace.

| Method | URI | Controller | Action | Route Name |
|--------|-----|------------|--------|------------|
| GET | `/users` | UserController | index | `starter-kit.users.index` |
| POST | `/users` | UserController | store | `starter-kit.users.store` |
| PATCH | `/users/{user}` | UserController | update | `starter-kit.users.update` |
| POST | `/users/{user}/reset-password` | UserController | resetPassword | `starter-kit.users.reset-password` |
| DELETE | `/users/reset-data` | UserController | destroyAll | `starter-kit.users.reset-data` |
| DELETE | `/users/{user}` | UserController | destroy | `starter-kit.users.destroy` |

### Documentation Route

| Method | URI | View | Route Name |
|--------|-----|------|------------|
| GET | `/documentation` | documentation.index | `starter-kit.documentation.index` |

---

## Route Groups

Routes are organized using Laravel's route group feature:

```php
Route::name('starter-kit.')->group(function (): void {
    // All routes here will have 'starter-kit.' prefix
});
```

**Benefits:**
- ✅ Organized route naming
- ✅ Easy to identify starter kit routes
- ✅ Prevents naming conflicts
- ✅ Consistent naming convention

---

## Usage Examples

### Generating URLs

```php
// Using route helper
$url = route('starter-kit.users.index');
// Output: http://your-app.test/users

$url = route('starter-kit.users.update', ['user' => 1]);
// Output: http://your-app.test/users/1
```

### Redirecting to Routes

```php
// In controller
return redirect()->route('starter-kit.users.index');

// With success message
return redirect()
    ->route('starter-kit.users.index')
    ->with('success', 'User created successfully');
```

### Checking Current Route

```php
// In blade template
@if(request()->routeIs('starter-kit.users.*'))
    <li class="active">Users</li>
@endif

// In controller
if (request()->routeIs('starter-kit.users.index')) {
    // Do something
}
```

### Route Parameters

```php
// Get user ID from route
$userId = request()->route('user');

// In controller method
public function update(Request $request, User $user)
{
    // $user is automatically resolved via route model binding
}
```

---

## Route Model Binding

The `{user}` parameter automatically resolves to a User model instance:

```php
Route::patch('/users/{user}', [UserController::class, 'update']);

// In controller
public function update(Request $request, User $user)
{
    // $user is already a User model instance
    // No need to do User::findOrFail($id)
}
```

---

## Middleware

You can add middleware to protect routes:

```php
Route::name('starter-kit.')->middleware(['auth'])->group(function (): void {
    // All routes require authentication
});

// Or specific routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])
        ->name('starter-kit.users.index');
});
```

---

## Custom Route Configuration

### Adding New Routes

To add custom routes to the starter kit group:

```php
Route::name('starter-kit.')->group(function (): void {
    // Existing routes...
    
    // Your custom routes
    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings.index');
    
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile.show');
});
```

### Organizing Routes

For better organization, you can split routes into multiple files:

```php
// routes/web.php
require __DIR__.'/starter-kit.php';

// routes/starter-kit.php
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('starter-kit.')->group(function (): void {
    // All starter kit routes here
});
```

---

## API Routes

If you need API endpoints for the starter kit:

```php
// routes/api.php
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('starter-kit')->name('starter-kit.api.')->group(function () {
    Route::apiResource('users', UserController::class);
});
```

---

## Route Caching

For production, cache your routes for better performance:

```bash
# Cache routes
php artisan route:cache

# Clear route cache
php artisan route:clear

# List all routes
php artisan route:list

# Filter starter kit routes
php artisan route:list --name=starter-kit
```

---

## Testing Routes

### Feature Tests

```php
use Tests\TestCase;

class UserRoutesTest extends TestCase
{
    public function test_users_index_route_exists()
    {
        $response = $this->get(route('starter-kit.users.index'));
        $response->assertStatus(200);
    }
    
    public function test_user_can_be_created()
    {
        $response = $this->post(route('starter-kit.users.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
        
        $response->assertRedirect(route('starter-kit.users.index'));
    }
}
```

---

## Best Practices

### ✅ DO

- Use named routes for all links and redirects
- Use route model binding for cleaner code
- Group related routes together
- Use descriptive route names
- Add middleware for protection
- Cache routes in production

### ❌ DON'T

- Hardcode URLs in your code
- Use fully qualified namespaces in routes
- Mix different naming conventions
- Forget to clear route cache after changes
- Skip route names for important routes

---

## Troubleshooting

### Route Not Found

```bash
# Clear all caches
php artisan optimize:clear

# Regenerate route cache
php artisan route:cache
```

### Controller Not Found

Make sure the controller exists:
```bash
php artisan make:controller UserController
```

### Route Model Binding Not Working

Check your model's route key:
```php
// In User model
public function getRouteKeyName()
{
    return 'id'; // or 'slug', 'uuid', etc.
}
```

---

## Additional Resources

- [Laravel Routing Documentation](https://laravel.com/docs/routing)
- [Route Model Binding](https://laravel.com/docs/routing#route-model-binding)
- [Route Groups](https://laravel.com/docs/routing#route-groups)
- [Named Routes](https://laravel.com/docs/routing#named-routes)

---

<div align="center">

**Made with ❤️ by Winnicode**

</div>
