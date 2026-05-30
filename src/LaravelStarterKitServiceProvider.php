<?php

namespace Winnicode\LaravelStarterKit;

use Illuminate\Support\ServiceProvider;
use Winnicode\LaravelStarterKit\Console\InstallCommand;
use Winnicode\LaravelStarterKit\Console\StaterKitInstallCommand;

class LaravelStarterKitServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/config/starter-kit.php', 'starter-kit');
    }

    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
            StaterKitInstallCommand::class,
        ]);

        $this->publishes([
            dirname(__DIR__).'/config/starter-kit.php' => config_path('starter-kit.php'),
        ], 'laravel-starter-kit-config');

        $this->publishes([
            dirname(__DIR__).'/database/seeders/UserSeeder.php' => database_path('seeders/UserSeeder.php'),
        ], 'laravel-starter-kit-seeders');

        $this->publishes([
            dirname(__DIR__).'/routes/starter-kit.php' => base_path('routes/starter-kit.php'),
        ], 'laravel-starter-kit-routes');

        $this->publishes([
            dirname(__DIR__).'/resources/views' => resource_path('views/vendor/laravel-starter-kit'),
        ], 'laravel-starter-kit-views');

        $this->publishes([
            dirname(__DIR__).'/resources/stubs' => base_path('stubs/vendor/laravel-starter-kit'),
        ], 'laravel-starter-kit-stubs');
    }
}
