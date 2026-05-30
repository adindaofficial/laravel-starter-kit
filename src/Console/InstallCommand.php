<?php

namespace Winnicode\LaravelStarterKit\Console;

use Illuminate\Console\Command;
use InvalidArgumentException;
use Winnicode\LaravelStarterKit\Services\StarterKitInstaller;
use Winnicode\LaravelStarterKit\Support\Stack;

class InstallCommand extends Command
{
    protected $signature = 'starter-kit:install
        {--stack= : UI stack to install: bootstrap or tailwind}
        {--force : Overwrite existing starter-kit files}
        {--without-route : Do not append the starter-kit route loader to routes/web.php}';

    protected $description = 'Install Laravel starter-kit layouts, users page, DataTables, SweetAlert, icons, and UserSeeder.';

    public function __construct(private readonly StarterKitInstaller $installer)
    {
        parent::__construct();
    }

    public function handle(): int
    {
        try {
            $stack = $this->resolveStack();
        } catch (InvalidArgumentException $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }

        $force = (bool) $this->option('force');

        $this->info("Installing Laravel Starter Kit using {$stack}...");

        $this->installer->install(
            $stack,
            $force,
            ! $this->option('without-route'),
            fn (string $type, string $message) => $this->{$type}($message),
        );

        $this->newLine();
        $this->info('Laravel Starter Kit installed.');
        $this->line('Next steps:');
        $this->line('  php artisan migrate');
        $this->line('  php artisan db:seed --class=UserSeeder');
        $this->line('  Visit /users');

        return self::SUCCESS;
    }

    private function resolveStack(): string
    {
        $stack = trim((string) $this->option('stack'));

        if ($stack === '') {
            if (! $this->input->isInteractive()) {
                $defaultStack = Stack::default();
                $this->warn("No stack selected. Defaulting to {$defaultStack}.");

                return $defaultStack;
            }

            return $this->choice('Pilih stack UI yang ingin digunakan', Stack::available(), Stack::default());
        }

        return Stack::normalize($stack);
    }
}
