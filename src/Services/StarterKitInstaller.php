<?php

namespace Mwy\LaravelStarterKit\Services;

use Illuminate\Filesystem\Filesystem;
use Mwy\LaravelStarterKit\Traits\InstallsFiles;

class StarterKitInstaller
{
    use InstallsFiles;

    private const ROUTE_REQUIRE_LINE = "require __DIR__.'/starter-kit.php';";

    public function __construct(private readonly Filesystem $filesystem)
    {
    }

    public function install(string $stack, bool $force = false, bool $loadRoutes = true, ?callable $output = null): void
    {
        $this->copyDirectory($this->packagePath('resources/stubs'), base_path(), $force, $output);
        $this->copyDirectory($this->packagePath('database'), database_path(), $force, $output);
        $this->copyDirectory($this->packagePath('routes'), base_path('routes'), $force, $output);
        $this->copyDirectory($this->packagePath("resources/views/{$stack}"), resource_path('views'), $force, $output);
        $this->appendUserSeederCall($output);

        if ($loadRoutes) {
            $this->appendStarterKitRouteLoader($output);
        }
    }

    protected function files(): Filesystem
    {
        return $this->filesystem;
    }

    private function appendStarterKitRouteLoader(?callable $output = null): void
    {
        $routePath = base_path('routes/web.php');
        $this->ensureDirectoryExists(dirname($routePath));

        if (! $this->filesystem->exists($routePath)) {
            $this->filesystem->put($routePath, '<?php'.PHP_EOL);
        }

        $contents = $this->filesystem->get($routePath);

        if (str_contains($contents, self::ROUTE_REQUIRE_LINE)) {
            $this->write($output, 'line', 'Skipped existing: routes/web.php already loads routes/starter-kit.php');

            return;
        }

        $contents = rtrim($contents);

        if (str_ends_with($contents, '?>')) {
            $contents = rtrim(substr($contents, 0, -2));
        }

        $this->filesystem->put($routePath, $contents.PHP_EOL.PHP_EOL.self::ROUTE_REQUIRE_LINE.PHP_EOL);
        $this->write($output, 'line', 'Updated: routes/web.php');
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
