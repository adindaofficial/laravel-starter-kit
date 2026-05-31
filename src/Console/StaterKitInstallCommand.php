<?php

declare(strict_types=1);

namespace Mwy\LaravelStarterKit\Console;

/**
 * Starter Kit Install Command (Alias)
 *
 * Alternative command name for backward compatibility.
 * This is an alias for the main InstallCommand.
 *
 * @package Mwy\LaravelStarterKit\Console
 * @deprecated Use starter-kit:install instead
 */
class StaterKitInstallCommand extends InstallCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stater-kit:install
        {--stack= : UI stack to install (only tailwind is supported)}
        {--force : Overwrite existing starter-kit files}
        {--without-route : Do not append starter kit routes to routes/web.php}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[DEPRECATED] Use starter-kit:install instead. Install Tailwind Laravel starter-kit.';
}
