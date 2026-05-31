<?php

declare(strict_types=1);

namespace Mwy\LaravelStarterKit;

use Illuminate\Support\ServiceProvider;
use Mwy\LaravelStarterKit\Console\InstallCommand;
use Mwy\LaravelStarterKit\Console\StaterKitInstallCommand;

/**
 * Laravel Starter Kit Service Provider
 *
 * Provides configuration, commands, and publishable assets for the Laravel Starter Kit package.
 * This service provider handles the registration and bootstrapping of all package components.
 *
 * @package Mwy\LaravelStarterKit
 * @author  Winnicode
 * @version 1.0.0
 */
class LaravelStarterKitServiceProvider extends ServiceProvider
{
    /**
     * Package base path
     *
     * @var string
     */
    protected string $packagePath;

    /**
     * Publishable groups configuration
     *
     * @var array<string, string>
     */
    protected array $publishGroups = [
        'config' => 'laravel-starter-kit-config',
        'views' => 'laravel-starter-kit-views',
        'stubs' => 'laravel-starter-kit-stubs',
        'seeders' => 'laravel-starter-kit-seeders',
    ];

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->packagePath = dirname(__DIR__);

        $this->bootForConsole();
        $this->bootPublishables();
        $this->bootViews();
        $this->bootTranslations();
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerConfig();
        $this->registerServices();
    }

    /**
     * Register package configuration.
     *
     * @return void
     */
    protected function registerConfig(): void
    {
        $this->mergeConfigFrom(
            $this->packagePath('/config/starter-kit.php'),
            'starter-kit'
        );
    }

    /**
     * Register package services.
     *
     * @return void
     */
    protected function registerServices(): void
    {
        // Register any package services here
        // Example: $this->app->singleton(StarterKitService::class);
    }

    /**
     * Boot console-specific functionality.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->registerCommands();
    }

    /**
     * Register package commands.
     *
     * @return void
     */
    protected function registerCommands(): void
    {
        $this->commands([
            InstallCommand::class,
            StaterKitInstallCommand::class,
        ]);
    }

    /**
     * Boot publishable resources.
     *
     * @return void
     */
    protected function bootPublishables(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishConfig();
        $this->publishViews();
        $this->publishStubs();
        $this->publishSeeders();
    }

    /**
     * Publish configuration files.
     *
     * @return void
     */
    protected function publishConfig(): void
    {
        $this->publishes([
            $this->packagePath('/config/starter-kit.php') => config_path('starter-kit.php'),
        ], $this->publishGroups['config']);
    }

    /**
     * Publish view files.
     *
     * @return void
     */
    protected function publishViews(): void
    {
        $this->publishes([
            $this->packagePath('/resources/views') => resource_path('views/vendor/laravel-starter-kit'),
        ], $this->publishGroups['views']);
    }

    /**
     * Publish stub files.
     *
     * @return void
     */
    protected function publishStubs(): void
    {
        $this->publishes([
            $this->packagePath('/resources/stubs') => base_path('stubs/vendor/laravel-starter-kit'),
        ], $this->publishGroups['stubs']);
    }

    /**
     * Publish seeder files.
     *
     * @return void
     */
    protected function publishSeeders(): void
    {
        $this->publishes([
            $this->packagePath('/database/seeders/UserSeeder.php') => database_path('seeders/UserSeeder.php'),
        ], $this->publishGroups['seeders']);
    }

    /**
     * Boot package views.
     *
     * @return void
     */
    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            $this->packagePath('/resources/views'),
            'starter-kit'
        );
    }

    /**
     * Boot package translations.
     *
     * @return void
     */
    protected function bootTranslations(): void
    {
        $translationsPath = $this->packagePath('/resources/lang');

        if (is_dir($translationsPath)) {
            $this->loadTranslationsFrom($translationsPath, 'starter-kit');

            if ($this->app->runningInConsole()) {
                $this->publishes([
                    $translationsPath => $this->app->langPath('vendor/starter-kit'),
                ], 'laravel-starter-kit-translations');
            }
        }
    }

    /**
     * Get package path.
     *
     * @param  string  $path
     * @return string
     */
    protected function packagePath(string $path = ''): string
    {
        return $this->packagePath . $path;
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [
            'starter-kit',
        ];
    }
}
