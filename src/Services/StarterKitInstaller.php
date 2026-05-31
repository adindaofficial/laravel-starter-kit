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
        $this->copyDirectory(
            $this->packagePath('resources/stubs/app/Http/Controllers'),
            app_path('Http/Controllers'),
            $force,
            $output
        );

        $this->copyDirectory(
            $this->packagePath("resources/views/{$stack}/layouts"),
            resource_path('views/layouts'),
            $force,
            $output
        );

        $this->copyDirectory(
            $this->packagePath("resources/views/{$stack}/users"),
            resource_path('views/users'),
            $force,
            $output
        );

        $this->copyDirectory(
            $this->packagePath("resources/views/{$stack}/documentation"),
            resource_path('views/documentation'),
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

    private function appendStarterKitRoutesToWeb(?callable $output = null): void
    {
        $routePath = base_path('routes/web.php');
        $this->ensureDirectoryExists(dirname($routePath));

        if (! $this->filesystem->exists($routePath)) {
            $this->filesystem->put($routePath, '<?php'.PHP_EOL);
        }

        $contents = $this->filesystem->get($routePath);
        $contents = $this->removeLegacyStarterKitRouteLoader($contents, $output);
        $routeBlock = $this->starterKitRouteBlock();

        if (str_contains($contents, self::ROUTE_BLOCK_START) && str_contains($contents, self::ROUTE_BLOCK_END)) {
            $updated = preg_replace(
                '/'.preg_quote(self::ROUTE_BLOCK_START, '/').'.*?'.preg_quote(self::ROUTE_BLOCK_END, '/').'/s',
                $routeBlock,
                $contents,
                1,
                $count,
            );

            if ($updated !== null && $count > 0 && $updated !== $contents) {
                $this->filesystem->put($routePath, rtrim($updated).PHP_EOL);
                $this->write($output, 'line', 'Updated: routes/web.php starter kit routes');
            } else {
                $this->write($output, 'line', 'Skipped existing: routes/web.php already has starter kit routes');
            }

            return;
        }

        if (str_contains($contents, "starter-kit.users.index")) {
            $this->filesystem->put($routePath, rtrim($contents).PHP_EOL);
            $this->write($output, 'warn', 'Skipped routes/web.php because starter kit routes already exist without managed markers.');
            return;
        }

        $contents = rtrim($contents);

        if (str_ends_with($contents, '?>')) {
            $contents = rtrim(substr($contents, 0, -2));
        }

        $this->filesystem->put($routePath, $contents.PHP_EOL.PHP_EOL.$routeBlock.PHP_EOL);
        $this->write($output, 'line', 'Updated: routes/web.php');
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
