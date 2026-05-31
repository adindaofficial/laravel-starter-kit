# Laravel Tailwind Starter Kit

Package starter-kit Laravel berbasis Tailwind CSS untuk membuat layout dashboard, halaman `/users`, DataTables, modal action, icon library, SweetAlert2, controller, route, dan seeder secara otomatis.

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
    tailwind/
      components/
        tailwind/
          alert.blade.php
          stat-card.blade.php
      layouts/
        tailwind/
          app.blade.php
          partials/
            footer.blade.php
            mobile-sidebar.blade.php
            nav-items.blade.php
            navbar.blade.php
            page-header.blade.php
            scripts.blade.php
            sidebar.blade.php
            styles.blade.php
      users/
        index.blade.php
src/
  Console/
    InstallCommand.php
    StaterKitInstallCommand.php
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
composer require mwy/laravel-starter-kit:@dev
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

Package ini hanya mendukung Tailwind CSS. Opsi `--stack=tailwind` tetap tersedia jika ingin eksplisit:

```bash
php artisan stater-kit:install --stack=tailwind
```

Opsi tambahan:

```bash
php artisan stater-kit:install --force
php artisan stater-kit:install --without-route
```

`--without-route` tidak menambahkan route starter kit ke `routes/web.php`.

## Setelah Install

Jalankan migrasi dan seeder:

```bash
php artisan migrate
php artisan db:seed
```

Buka halaman:

```text
/users
```

Halaman Users sudah memakai DataTables dan menyediakan action berbasis modal:

- Tambah user
- Reset password
- Edit user
- Delete user

## File Yang Dipasang

- `app/Http/Controllers/UserController.php`
- `resources/views/layouts/tailwind/*`
- asset layout seperti Tailwind CSS, Lucide icons, DataTables, SweetAlert, custom CSS, dan JS berada di `resources/views/layouts/tailwind/partials`
- `resources/views/components/tailwind/*`
- `resources/views/users/index.blade.php` dengan DataTables dan modal action
- `database/seeders/UserSeeder.php`
- `database/seeders/DatabaseSeeder.php` akan ditambahkan `$this->call(UserSeeder::class);`
- `routes/web.php` akan langsung ditambahkan route halaman users

## Struktur Project Setelah Install

```text
app/
  Http/
    Controllers/
      UserController.php
database/
  seeders/
    DatabaseSeeder.php
    UserSeeder.php
resources/
  views/
    components/
      tailwind/
    layouts/
      tailwind/
        app.blade.php
        partials/
          footer.blade.php
          mobile-sidebar.blade.php
          nav-items.blade.php
          navbar.blade.php
          page-header.blade.php
          scripts.blade.php
          sidebar.blade.php
          styles.blade.php
    users/
      index.blade.php
routes/
  web.php
```
