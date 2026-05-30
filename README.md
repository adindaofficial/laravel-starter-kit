# Laravel Starter Kit

Package starter-kit Laravel untuk membuat layout, halaman `/users`, DataTables, icon library, SweetAlert2, dan `UserSeeder` secara otomatis.

## Struktur Package

```text
config/
  starter-kit.php
database/
  seeders/
    UserSeeder.php
resources/
  stubs/
    app/
      Http/
        Controllers/
          UserController.php
  views/
    bootstrap/
    tailwind/
routes/
  starter-kit.php
src/
  Console/
    InstallCommand.php
    StaterKitInstallCommand.php
  Http/
    Controllers/
  Services/
    StarterKitInstaller.php
  Support/
    Stack.php
  Traits/
    InstallsFiles.php
  LaravelStarterKitServiceProvider.php
composer.json
README.md
```

## Install Package Lokal

Jika package ini berada di folder terpisah dari project Laravel:

```bash
composer config repositories.laravel-starter-kit path "../laravel-starter-kit"
composer require winnicode/laravel-starter-kit:@dev
```

## Jalankan Installer

Command typo yang diminta tetap tersedia:

```bash
php artisan stater-kit:install
```

Command dengan ejaan yang benar juga tersedia:

```bash
php artisan starter-kit:install
```

Installer akan meminta pilihan stack:

- `bootstrap`
- `tailwind`

Untuk langsung memilih stack:

```bash
php artisan stater-kit:install --stack=bootstrap
php artisan stater-kit:install --stack=tailwind
```

Opsi tambahan:

```bash
php artisan stater-kit:install --force
php artisan stater-kit:install --without-route
```

`--without-route` tetap membuat file `routes/starter-kit.php`, tetapi tidak menambahkan loader ke `routes/web.php`.

## Setelah Install

Jalankan migrasi dan seeder:

```bash
php artisan migrate
php artisan db:seed --class=UserSeeder
```

Buka halaman:

```text
/users
```

## File Yang Dipasang

- `app/Http/Controllers/UserController.php`
- `routes/starter-kit.php`
- `resources/views/layouts/bootstrap/*` atau `resources/views/layouts/tailwind/*`
- `resources/views/components/bootstrap/*` atau `resources/views/components/tailwind/*`
- `resources/views/users/index.blade.php`
- `database/seeders/UserSeeder.php`
- `routes/web.php` akan memuat `routes/starter-kit.php`

## Struktur Project Setelah Install

```text
app/
  Http/
    Controllers/
      UserController.php
database/
  seeders/
    UserSeeder.php
resources/
  views/
    components/
      bootstrap/ atau tailwind/
    layouts/
      bootstrap/ atau tailwind/
        app.blade.php
        partials/
          footer.blade.php
          navbar.blade.php
          sidebar.blade.php
    users/
      index.blade.php
routes/
  starter-kit.php
  web.php
```
