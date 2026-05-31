<?php

declare(strict_types=1);

namespace Mwy\LaravelStarterKit\Providers;

use Illuminate\Support\ServiceProvider;
use Mwy\LaravelStarterKit\Console\InstallCommand;
use Mwy\LaravelStarterKit\Console\StaterKitInstallCommand;

class LaravelStarterKitServiceProvider extends ServiceProvider
{
    private const PUBLISH_GROUPS = [
        'views' => 'laravel-starter-kit-views',
        'stubs' => 'laravel-starter-kit-stubs',
        'seeders' => 'laravel-starter-kit-seeders',
    ];

    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
            StaterKitInstallCommand::class,
        ]);

        $this->publishViews();
        $this->publishStubs();
        $this->publishSeeders();
    }

    private function publishViews(): void
    {
        $this->publishes([
            $this->packagePath('resources/views') => resource_path('views/vendor/laravel-starter-kit'),
        ], self::PUBLISH_GROUPS['views']);
    }

    private function publishStubs(): void
    {
        $this->publishes([
            $this->packagePath('resources/stubs') => base_path('stubs/vendor/laravel-starter-kit'),
        ], self::PUBLISH_GROUPS['stubs']);
    }

    private function publishSeeders(): void
    {
        $this->publishes([
            $this->packagePath('database/seeders/UserSeeder.php') => database_path('seeders/UserSeeder.php'),
        ], self::PUBLISH_GROUPS['seeders']);
    }

    private function packagePath(string $path = ''): string
    {
        $basePath = dirname(__DIR__, 2);

        return $path === ''
            ? $basePath
            : $basePath.DIRECTORY_SEPARATOR.$path;
    }
}
