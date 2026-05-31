<?php

declare(strict_types=1);

namespace Mwy\LaravelStarterKit\Console;

use Illuminate\Console\Command;
use InvalidArgumentException;
use Mwy\LaravelStarterKit\Services\StarterKitInstaller;
use Mwy\LaravelStarterKit\Support\Stack;

/**
 * Install Command
 *
 * Handles the installation of Laravel Starter Kit components including
 * Tailwind layouts, users page, DataTables, SweetAlert, icons, and seeders.
 *
 * @package Mwy\LaravelStarterKit\Console
 */
class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'starter-kit:install
        {--stack= : UI stack to install (only tailwind is supported)}
        {--force : Overwrite existing starter-kit files}
        {--without-route : Do not append starter kit routes to routes/web.php}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Tailwind Laravel starter-kit layouts, users page, DataTables, SweetAlert, icons, and UserSeeder.';

    /**
     * Create a new command instance.
     *
     * @param  \Mwy\LaravelStarterKit\Services\StarterKitInstaller  $installer
     * @return void
     */
    public function __construct(
        private readonly StarterKitInstaller $installer
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $stack = $this->resolveStack();
        } catch (InvalidArgumentException $exception) {
            $this->error($exception->getMessage());
            return self::FAILURE;
        }

        $this->displayHeader($stack);
        $this->performInstallation($stack);
        $this->displayNextSteps();

        return self::SUCCESS;
    }

    /**
     * Display installation header.
     *
     * @param  string  $stack
     * @return void
     */
    protected function displayHeader(string $stack): void
    {
        $this->newLine();
        $this->info("╔══════════════════════════════════════════════════════════╗");
        $this->info("║         Laravel Starter Kit Installation                ║");
        $this->info("╚══════════════════════════════════════════════════════════╝");
        $this->newLine();
        $this->line("  Stack: <fg=cyan>{$stack}</>");
        $this->line("  Force: <fg=cyan>" . ($this->option('force') ? 'Yes' : 'No') . "</>");
        $this->line("  Routes: <fg=cyan>" . ($this->option('without-route') ? 'Skip' : 'Include') . "</>");
        $this->newLine();
    }

    /**
     * Perform the installation process.
     *
     * @param  string  $stack
     * @return void
     */
    protected function performInstallation(string $stack): void
    {
        $force = (bool) $this->option('force');
        $withRoutes = ! $this->option('without-route');

        $this->installer->install(
            $stack,
            $force,
            $withRoutes,
            fn (string $type, string $message) => $this->output($type, $message),
        );
    }

    /**
     * Display next steps after installation.
     *
     * @return void
     */
    protected function displayNextSteps(): void
    {
        $this->newLine();
        $this->info('✓ Laravel Starter Kit installed successfully!');
        $this->newLine();
        $this->comment('Next steps:');
        $this->line('  1. Run migrations:    <fg=cyan>php artisan migrate</>');
        $this->line('  2. Seed database:     <fg=cyan>php artisan db:seed</>');
        $this->line('  3. Visit users page:  <fg=cyan>/users</>');
        $this->line('  4. View docs:         <fg=cyan>/documentation</>');
        $this->newLine();
    }

    /**
     * Output a message with the specified type.
     *
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    protected function output(string $type, string $message): void
    {
        match ($type) {
            'info' => $this->info($message),
            'comment' => $this->comment($message),
            'warn' => $this->warn($message),
            'error' => $this->error($message),
            default => $this->line($message),
        };
    }

    /**
     * Resolve the stack option.
     *
     * @return string
     * @throws \InvalidArgumentException
     */
    protected function resolveStack(): string
    {
        $stack = trim((string) $this->option('stack'));

        if ($stack === '') {
            return Stack::default();
        }

        return Stack::normalize($stack);
    }
}
