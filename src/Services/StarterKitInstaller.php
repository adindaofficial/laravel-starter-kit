<?php

namespace Mwy\LaravelStarterKit\Services;

use Illuminate\Filesystem\Filesystem;
use Mwy\LaravelStarterKit\Traits\InstallsFiles;

class StarterKitInstaller
{
    use InstallsFiles;

    private const LEGACY_ROUTE_REQUIRE_PATTERN = '/^\s*require\s+__DIR__\s*\.\s*[\'"]\/starter-kit\.php[\'"]\s*;\s*[\r\n]*/m';
    private const ROUTE_BLOCK_START = '// Laravel Starter Kit Routes: BEGIN';
    private const ROUTE_BLOCK_END = '// Laravel Starter Kit Routes: END';

    public function __construct(private readonly Filesystem $filesystem)
    {
    }

    public function install(string $stack, bool $force = false, bool $loadRoutes = true, ?callable $output = null): void
    {
        $this->copyDirectory($this->packagePath('resources/stubs'), base_path(), $force, $output);
        $this->copyDirectory($this->packagePath('database'), database_path(), $force, $output);
        $this->copyDirectory($this->packagePath("resources/views/{$stack}"), resource_path('views'), $force, $output);
        $this->removeLegacyRootComponents($output);
        $this->appendUserSeederCall($output);

        if ($loadRoutes) {
            $this->appendStarterKitRoutesToWeb($output);
            $this->removeLegacyStarterKitRouteFile($output);
        }
    }

    protected function files(): Filesystem
    {
        return $this->filesystem;
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
            if (! str_contains($contents, "starter-kit.documentation.index")) {
                $this->filesystem->put($routePath, rtrim($contents).PHP_EOL.PHP_EOL.$this->starterKitDocumentationRoute().PHP_EOL);
                $this->write($output, 'line', 'Updated: routes/web.php documentation route');
            } else {
                $this->filesystem->put($routePath, rtrim($contents).PHP_EOL);
                $this->write($output, 'line', 'Skipped existing: routes/web.php already contains starter kit routes');
            }

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
        return <<<'PHP'
// Laravel Starter Kit Routes: BEGIN
\Illuminate\Support\Facades\Route::name('starter-kit.')->group(function () {
    \Illuminate\Support\Facades\Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    \Illuminate\Support\Facades\Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('users.store');
    \Illuminate\Support\Facades\Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
    \Illuminate\Support\Facades\Route::post('/users/{user}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPassword'])->name('users.reset-password');
    \Illuminate\Support\Facades\Route::delete('/users/reset-data', [\App\Http\Controllers\UserController::class, 'destroyAll'])->name('users.reset-data');
    \Illuminate\Support\Facades\Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    \Illuminate\Support\Facades\Route::view('/documentation', 'documentation.index')->name('documentation.index');
});
// Laravel Starter Kit Routes: END
PHP;
    }

    private function starterKitDocumentationRoute(): string
    {
        return <<<'PHP'
// Laravel Starter Kit Documentation Route
\Illuminate\Support\Facades\Route::view('/documentation', 'documentation.index')->name('starter-kit.documentation.index');
PHP;
    }

    private function appendUserSeederCall(?callable $output = null): void
    {
        $seederPath = database_path('seeders/DatabaseSeeder.php');
        $this->ensureDirectoryExists(dirname($seederPath));

        if (! $this->filesystem->exists($seederPath)) {
            $this->filesystem->put($seederPath, $this->defaultDatabaseSeeder());
            $this->write($output, 'line', 'Created: seeders/DatabaseSeeder.php');

            return;
        }

        $contents = $this->filesystem->get($seederPath);

        if (str_contains($contents, 'UserSeeder::class')) {
            $this->write($output, 'line', 'Skipped existing: seeders/DatabaseSeeder.php already calls UserSeeder');

            return;
        }

        $updated = preg_replace_callback(
            '/(public\s+function\s+run\s*\([^)]*\)\s*(?::\s*void)?\s*\{\s*)/m',
            fn (array $matches): string => rtrim($matches[1]).PHP_EOL.'        $this->call(UserSeeder::class);'.PHP_EOL,
            $contents,
            1,
            $count,
        );

        if ($count === 0 || $updated === null) {
            $this->write($output, 'warn', 'Could not update seeders/DatabaseSeeder.php. Add $this->call(UserSeeder::class); manually.');

            return;
        }

        $this->filesystem->put($seederPath, $updated);
        $this->write($output, 'line', 'Updated: seeders/DatabaseSeeder.php');
    }

    private function defaultDatabaseSeeder(): string
    {
        return <<<'PHP'
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
    }
}
PHP;
    }

    private function packagePath(string $path = ''): string
    {
        $basePath = dirname(__DIR__, 2);

        return $path === ''
            ? $basePath
            : $basePath.DIRECTORY_SEPARATOR.$path;
    }
}
