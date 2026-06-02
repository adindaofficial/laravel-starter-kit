<?php

declare(strict_types=1);

namespace Mwy\LaravelStarterKit\Services;

use Illuminate\Filesystem\Filesystem;
use Mwy\LaravelStarterKit\Traits\InstallsFiles;
use RuntimeException;

/**
 * Starter Kit Installer Service
 *
 * Handles the installation process of Laravel Starter Kit components including:
 * - Copying controller stubs and Blade views
 * - Managing route registration in routes/web.php
 * - Cleaning up legacy files
 *
 * @package Mwy\LaravelStarterKit\Services
 */
class StarterKitInstaller
{
    use InstallsFiles;

    /**
     * Legacy route require pattern for removal
     *
     * @var string
     */
    private const LEGACY_ROUTE_REQUIRE_PATTERN = '/^\s*require\s+__DIR__\s*\.\s*[\'"]\/starter-kit\.php[\'"]\s*;\s*[\r\n]*/m';

    /**
     * Route block markers
     *
     * @var string
     */
    private const ROUTE_BLOCK_START = '// Laravel Starter Kit Routes: BEGIN';
    private const ROUTE_BLOCK_END = '// Laravel Starter Kit Routes: END';

    /**
     * Create a new installer instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $filesystem
     * @return void
     */
    public function __construct(
        private readonly Filesystem $filesystem
    ) {
    }

    /**
     * Install the starter kit.
     *
     * @param  string  $stack
     * @param  bool  $force
     * @param  bool  $loadRoutes
     * @param  callable|null  $output
     * @return void
     */
    public function install(
        string $stack,
        bool $force = false,
        bool $loadRoutes = true,
        ?callable $output = null
    ): void {
        $this->installFiles($stack, $force, $output);
        $this->cleanupLegacyFiles($output);

        if ($loadRoutes) {
            $this->setupRoutes($output);
        }
    }

    /**
     * Get the filesystem instance.
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    protected function files(): Filesystem
    {
        return $this->filesystem;
    }

    /**
     * Install all necessary files.
     *
     * @param  string  $stack
     * @param  bool  $force
     * @param  callable|null  $output
     * @return void
     */
    protected function installFiles(string $stack, bool $force, ?callable $output): void
    {
        // Copy Controllers
        $this->copyDirectory(
            $this->packagePath('resources/stubs/app/Http/Controllers'),
            app_path('Http/Controllers'),
            $force,
            $output
        );

        // Copy Layouts
        $this->copyDirectory(
            $this->packagePath("resources/views/{$stack}/layouts"),
            resource_path('views/layouts'),
            $force,
            $output
        );

        // Copy Users Views
        $this->copyDirectory(
            $this->packagePath("resources/views/{$stack}/users"),
            resource_path('views/users'),
            $force,
            $output
        );

        // Copy Documentation Views
        $this->copyDirectory(
            $this->packagePath("resources/views/{$stack}/documentation"),
            resource_path('views/documentation'),
            $force,
            $output
        );

        // Copy Database Seeders
        $this->copyDirectory(
            $this->packagePath('database/seeders'),
            database_path('seeders'),
            $force,
            $output
        );
    }

    /**
     * Setup application routes.
     *
     * @param  callable|null  $output
     * @return void
     */
    protected function setupRoutes(?callable $output): void
    {
        $this->appendStarterKitRoutesToWeb($output);
        $this->removeLegacyStarterKitRouteFile($output);
    }

    /**
     * Clean up legacy files and components.
     *
     * @param  callable|null  $output
     * @return void
     */
    protected function cleanupLegacyFiles(?callable $output): void
    {
        $this->removeLegacyRootComponents($output);
    }

    /**
     * Append starter kit routes to web.php
     *
     * @param  callable|null  $output
     * @return void
     */
    private function appendStarterKitRoutesToWeb(?callable $output = null): void
    {
        $routePath = base_path('routes/web.php');
        $this->ensureDirectoryExists(dirname($routePath));

        if (! $this->filesystem->exists($routePath)) {
            $this->createDefaultWebRoutes($routePath);
            $this->write($output, 'line', 'Created: routes/web.php');
        }

        $contents = $this->filesystem->get($routePath);
        $contents = $this->removeLegacyStarterKitRouteLoader($contents, $output);

        // Check if routes already exist
        if (str_contains($contents, self::ROUTE_BLOCK_START) && str_contains($contents, self::ROUTE_BLOCK_END)) {
            $this->updateExistingRouteBlock($routePath, $contents, $output);
            return;
        }

        if (str_contains($contents, "starter-kit.users.index")) {
            $this->write($output, 'warn', 'Skipped routes/web.php because starter kit routes already exist without managed markers.');
            return;
        }

        // Add use statements if needed
        $contents = $this->ensureUseStatements($contents);

        // Add route block
        $routeBlock = $this->getRouteBlockOnly();
        $contents = rtrim($contents);

        if (str_ends_with($contents, '?>')) {
            $contents = rtrim(substr($contents, 0, -2));
        }

        $this->filesystem->put($routePath, $contents . PHP_EOL . PHP_EOL . $routeBlock . PHP_EOL);
        $this->write($output, 'line', 'Updated: routes/web.php');
    }

    /**
     * Create default web routes file.
     *
     * @param  string  $routePath
     * @return void
     */
    private function createDefaultWebRoutes(string $routePath): void
    {
        $defaultContent = $this->starterKitRouteBlock();
        $this->filesystem->put($routePath, $defaultContent);
    }

    /**
     * Update existing route block in web.php
     *
     * @param  string  $routePath
     * @param  string  $contents
     * @param  callable|null  $output
     * @return void
     */
    private function updateExistingRouteBlock(string $routePath, string $contents, ?callable $output): void
    {
        $routeBlock = $this->getRouteBlockOnly();

        $updated = preg_replace(
            '/' . preg_quote(self::ROUTE_BLOCK_START, '/') . '.*?' . preg_quote(self::ROUTE_BLOCK_END, '/') . '/s',
            $routeBlock,
            $contents,
            1,
            $count,
        );

        if ($updated !== null && $count > 0 && $updated !== $contents) {
            $this->filesystem->put($routePath, rtrim($updated) . PHP_EOL);
            $this->write($output, 'line', 'Updated: routes/web.php starter kit routes');
        } else {
            $this->write($output, 'line', 'Skipped existing: routes/web.php already has starter kit routes');
        }
    }

    /**
     * Ensure required use statements exist in the content.
     *
     * @param  string  $contents
     * @return string
     */
    private function ensureUseStatements(string $contents): string
    {
        $requiredUseStatements = [
            'use App\Http\Controllers\UserController;',
            'use Illuminate\Support\Facades\Route;',
        ];

        $lines = explode(PHP_EOL, $contents);
        $phpTagIndex = 0;
        $lastUseIndex = 0;

        // Find <?php tag and last use statement
        foreach ($lines as $index => $line) {
            $trimmedLine = trim($line);
            
            if (str_starts_with($trimmedLine, '<?php')) {
                $phpTagIndex = $index;
            }
            
            if (str_starts_with($trimmedLine, 'use ')) {
                $lastUseIndex = $index;
            }
        }

        // Check which use statements are missing
        $missingUseStatements = [];
        foreach ($requiredUseStatements as $useStatement) {
            $found = false;
            
            foreach ($lines as $line) {
                if (trim($line) === $useStatement) {
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                $missingUseStatements[] = $useStatement;
            }
        }

        // If no missing statements, return original content
        if (empty($missingUseStatements)) {
            return $contents;
        }

        // Insert missing use statements after last use or after <?php
        $insertIndex = $lastUseIndex > 0 ? $lastUseIndex + 1 : $phpTagIndex + 1;

        // Add empty line before use statements if inserting after <?php
        if ($lastUseIndex === 0 && $insertIndex > 0) {
            if (!empty(trim($lines[$insertIndex] ?? ''))) {
                array_splice($lines, $insertIndex, 0, ['']);
                $insertIndex++;
            }
        }

        array_splice($lines, $insertIndex, 0, $missingUseStatements);

        return implode(PHP_EOL, $lines);
    }

    /**
     * Get only the route block without use statements.
     *
     * @return string
     */
    private function getRouteBlockOnly(): string
    {
        $fullContent = $this->starterKitRouteBlock();
        
        // Remove <?php tag if exists
        if (str_starts_with($fullContent, '<?php')) {
            $fullContent = trim(substr($fullContent, 5));
        }

        $lines = explode(PHP_EOL, $fullContent);
        $routeLines = [];
        $inRouteBlock = false;

        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            
            // Skip use statements and empty lines before route block
            if (str_starts_with($trimmedLine, 'use ') || 
                str_starts_with($trimmedLine, '/*') ||
                str_starts_with($trimmedLine, '*') ||
                str_starts_with($trimmedLine, '|')) {
                continue;
            }

            // Start collecting from route block marker
            if (str_contains($trimmedLine, self::ROUTE_BLOCK_START) || $inRouteBlock) {
                $inRouteBlock = true;
                $routeLines[] = $line;
                
                if (str_contains($trimmedLine, self::ROUTE_BLOCK_END)) {
                    break;
                }
            }
        }

        return implode(PHP_EOL, $routeLines);
    }

    private function removeLegacyStarterKitRouteLoader(string $contents, ?callable $output = null): string
    {
        $updated = preg_replace(self::LEGACY_ROUTE_REQUIRE_PATTERN, '', $contents, -1, $count);

        if ($updated !== null && $count > 0) {
            $this->write($output, 'line', 'Removed legacy routes/starter-kit.php loader from routes/web.php');

            return $updated;
        }

        return $contents;
    }

    private function removeLegacyStarterKitRouteFile(?callable $output = null): void
    {
        $routeFile = base_path('routes/starter-kit.php');

        if (! $this->filesystem->exists($routeFile)) {
            return;
        }

        $contents = $this->filesystem->get($routeFile);

        if (! str_contains($contents, 'Laravel Starter Kit Routes')) {
            $this->write($output, 'warn', 'Skipped removing routes/starter-kit.php because it does not look like a starter kit generated file.');

            return;
        }

        $this->filesystem->delete($routeFile);
        $this->write($output, 'line', 'Removed legacy: routes/starter-kit.php');
    }

    private function removeLegacyRootComponents(?callable $output = null): void
    {
        $components = [
            resource_path('views/components/tailwind/alert.blade.php') => 'data-lucide="{{ $style[\'icon\'] }}"',
            resource_path('views/components/tailwind/stat-card.blade.php') => 'hover:shadow-panel',
        ];

        foreach ($components as $path => $signature) {
            if (! $this->filesystem->exists($path)) {
                continue;
            }

            $contents = $this->filesystem->get($path);

            if (! str_contains($contents, $signature)) {
                $this->write($output, 'warn', 'Skipped removing customized component: '.str_replace(base_path().DIRECTORY_SEPARATOR, '', $path));

                continue;
            }

            $this->filesystem->delete($path);
            $this->write($output, 'line', 'Removed legacy component: '.str_replace(base_path().DIRECTORY_SEPARATOR, '', $path));
        }

        $this->deleteDirectoryIfEmpty(resource_path('views/components/tailwind'));
        $this->deleteDirectoryIfEmpty(resource_path('views/components'));
    }

    private function deleteDirectoryIfEmpty(string $path): void
    {
        if (! $this->filesystem->isDirectory($path)) {
            return;
        }

        if ($this->filesystem->files($path) !== [] || $this->filesystem->directories($path) !== []) {
            return;
        }

        $this->filesystem->deleteDirectory($path);
    }

    private function starterKitRouteBlock(): string
    {
        $routePath = $this->packagePath('routes/web.php');

        if (! $this->filesystem->exists($routePath)) {
            throw new RuntimeException('Starter kit route file not found: routes/web.php');
        }

        $contents = trim($this->filesystem->get($routePath));

        if (str_starts_with($contents, '<?php')) {
            $contents = trim(substr($contents, 5));
        }

        return $contents;
    }

    private function packagePath(string $path = ''): string
    {
        $basePath = dirname(__DIR__, 2);

        return $path === ''
            ? $basePath
            : $basePath.DIRECTORY_SEPARATOR.$path;
    }
}
