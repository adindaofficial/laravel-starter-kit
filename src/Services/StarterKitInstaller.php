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
        $packageRoutePath = $this->packagePath('routes/web.php');

        $this->ensureDirectoryExists(dirname($routePath));

        // If web.php doesn't exist, copy from package
        if (! $this->filesystem->exists($routePath)) {
            $this->filesystem->copy($packageRoutePath, $routePath);
            $this->write($output, 'line', 'Created: routes/web.php');
            return;
        }

        $contents = $this->filesystem->get($routePath);

        // Check if routes already exist
        if (str_contains($contents, self::ROUTE_BLOCK_START) && str_contains($contents, self::ROUTE_BLOCK_END)) {
            $this->updateExistingRouteBlock($routePath, $contents, $packageRoutePath, $output);
            return;
        }

        if (str_contains($contents, "starter-kit.users.index")) {
            $this->write($output, 'warn', 'Skipped routes/web.php because starter kit routes already exist without managed markers.');
            return;
        }

        // Merge routes from package
        $this->mergeRoutesFromPackage($routePath, $contents, $packageRoutePath, $output);
    }

    /**
     * Merge routes from package into existing web.php
     *
     * @param  string  $routePath
     * @param  string  $contents
     * @param  string  $packageRoutePath
     * @param  callable|null  $output
     * @return void
     */
    private function mergeRoutesFromPackage(
        string $routePath,
        string $contents,
        string $packageRoutePath,
        ?callable $output
    ): void {
        $packageContents = $this->filesystem->get($packageRoutePath);
        
        // Extract use statements and route block from package
        $useStatements = $this->extractUseStatements($packageContents);
        $routeBlock = $this->extractRouteBlock($packageContents);

        // Add missing use statements
        $contents = $this->addMissingUseStatements($contents, $useStatements);

        // Append route block
        $contents = rtrim($contents);
        if (str_ends_with($contents, '?>')) {
            $contents = rtrim(substr($contents, 0, -2));
        }

        $this->filesystem->put($routePath, $contents . PHP_EOL . PHP_EOL . $routeBlock . PHP_EOL);
        $this->write($output, 'line', 'Updated: routes/web.php');
    }

    /**
     * Update existing route block in web.php
     *
     * @param  string  $routePath
     * @param  string  $contents
     * @param  string  $packageRoutePath
     * @param  callable|null  $output
     * @return void
     */
    private function updateExistingRouteBlock(
        string $routePath,
        string $contents,
        string $packageRoutePath,
        ?callable $output
    ): void {
        $packageContents = $this->filesystem->get($packageRoutePath);
        $routeBlock = $this->extractRouteBlock($packageContents);

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
     * Extract use statements from content.
     *
     * @param  string  $content
     * @return array<int, string>
     */
    private function extractUseStatements(string $content): array
    {
        $lines = explode(PHP_EOL, $content);
        $useStatements = [];

        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            if (preg_match('/^use\s+([^;]+);$/', $trimmedLine, $matches)) {
                $useStatements[] = trim($matches[1]);
            }
        }

        return $useStatements;
    }

    /**
     * Extract route block from content.
     *
     * @param  string  $content
     * @return string
     */
    private function extractRouteBlock(string $content): string
    {
        $lines = explode(PHP_EOL, $content);
        $routeLines = [];
        $inBlock = false;

        foreach ($lines as $line) {
            $trimmedLine = trim($line);

            if (str_contains($trimmedLine, self::ROUTE_BLOCK_START)) {
                $inBlock = true;
            }

            if ($inBlock) {
                $routeLines[] = $line;

                if (str_contains($trimmedLine, self::ROUTE_BLOCK_END)) {
                    break;
                }
            }
        }

        return implode(PHP_EOL, $routeLines);
    }

    /**
     * Add missing use statements to content.
     *
     * @param  string  $content
     * @param  array<int, string>  $requiredUseStatements
     * @return string
     */
    private function addMissingUseStatements(string $content, array $requiredUseStatements): string
    {
        $existingUseStatements = $this->extractUseStatements($content);
        $missingUseStatements = [];

        foreach ($requiredUseStatements as $required) {
            if (!in_array($required, $existingUseStatements, true)) {
                $missingUseStatements[] = $required;
            }
        }

        if (empty($missingUseStatements)) {
            return $content;
        }

        $lines = explode(PHP_EOL, $content);
        $phpTagIndex = -1;
        $lastUseIndex = -1;

        foreach ($lines as $index => $line) {
            $trimmedLine = trim($line);

            if (str_starts_with($trimmedLine, '<?php')) {
                $phpTagIndex = $index;
            }

            if (preg_match('/^use\s+/', $trimmedLine)) {
                $lastUseIndex = $index;
            }
        }

        $insertIndex = $lastUseIndex > 0 ? $lastUseIndex + 1 : $phpTagIndex + 1;
        $useLines = [];

        // Add blank line if inserting after <?php
        if ($lastUseIndex === -1 && $phpTagIndex >= 0) {
            if (!empty(trim($lines[$insertIndex] ?? ''))) {
                $useLines[] = '';
            }
        }

        foreach ($missingUseStatements as $useClass) {
            $useLines[] = "use {$useClass};";
        }

        array_splice($lines, $insertIndex, 0, $useLines);

        return implode(PHP_EOL, $lines);
    }

    /**
     * Remove legacy starter kit route file.
     *
     * @param  callable|null  $output
     * @return void
     */
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

    /**
     * Get package path.
     *
     * @param  string  $path
     * @return string
     */
    private function packagePath(string $path = ''): string
    {
        $basePath = dirname(__DIR__, 2);

        return $path === ''
            ? $basePath
            : $basePath . DIRECTORY_SEPARATOR . $path;
    }
}
