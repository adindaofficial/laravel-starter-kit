<?php

namespace Mwy\LaravelStarterKit\Traits;

use Illuminate\Filesystem\Filesystem;

trait InstallsFiles
{
    abstract protected function files(): Filesystem;

    protected function copyDirectory(string $source, string $destination, bool $force, ?callable $output = null): void
    {
        if (! $this->files()->isDirectory($source)) {
            $this->write($output, 'warn', "Source directory not found: {$source}");

            return;
        }

        foreach ($this->files()->allFiles($source) as $file) {
            $relativePath = str_replace('\\', '/', $file->getRelativePathname());
            $target = $destination.DIRECTORY_SEPARATOR.$relativePath;
            $exists = $this->files()->exists($target);

            if ($exists && ! $force) {
                $this->write($output, 'line', "Skipped existing: {$relativePath}");

                continue;
            }

            $this->ensureDirectoryExists(dirname($target));
            $this->files()->copy($file->getPathname(), $target);

            $this->write($output, 'line', ($exists ? 'Overwritten' : 'Created').": {$relativePath}");
        }
    }

    protected function ensureDirectoryExists(string $path): void
    {
        if (! $this->files()->isDirectory($path)) {
            $this->files()->makeDirectory($path, 0755, true);
        }
    }

    protected function write(?callable $output, string $type, string $message): void
    {
        if ($output === null) {
            return;
        }

        $output($type, $message);
    }
}
