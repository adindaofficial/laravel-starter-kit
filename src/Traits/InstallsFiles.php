<?php

declare(strict_types=1);

namespace Mwy\LaravelStarterKit\Traits;

use Illuminate\Filesystem\Filesystem;

/**
 * Installs Files Trait
 *
 * Provides file installation utilities for copying directories,
 * ensuring directory existence, and outputting installation messages.
 *
 * @package Mwy\LaravelStarterKit\Traits
 */
trait InstallsFiles
{
    /**
     * Get the filesystem instance.
     *
     * @return \Illuminate\Filesystem\Filesystem
     */
    abstract protected function files(): Filesystem;

    /**
     * Copy a directory from source to destination.
     *
     * @param  string  $source
     * @param  string  $destination
     * @param  bool  $force
     * @param  callable|null  $output
     * @return void
     */
    protected function copyDirectory(
        string $source,
        string $destination,
        bool $force,
        ?callable $output = null
    ): void {
        if (! $this->files()->isDirectory($source)) {
            $this->write($output, 'warn', "Source directory not found: {$source}");
            return;
        }

        $files = $this->files()->allFiles($source);
        $copiedCount = 0;
        $skippedCount = 0;

        foreach ($files as $file) {
            $relativePath = str_replace('\\', '/', $file->getRelativePathname());
            $target = $destination . DIRECTORY_SEPARATOR . $relativePath;
            $exists = $this->files()->exists($target);

            if ($exists && ! $force) {
                $this->write($output, 'line', "Skipped existing: {$relativePath}");
                $skippedCount++;
                continue;
            }

            $this->ensureDirectoryExists(dirname($target));
            $this->files()->copy($file->getPathname(), $target);

            $status = $exists ? 'Overwritten' : 'Created';
            $this->write($output, 'line', "{$status}: {$relativePath}");
            $copiedCount++;
        }

        if ($copiedCount > 0 || $skippedCount > 0) {
            $this->write(
                $output,
                'info',
                sprintf(
                    'Processed %d file(s): %d copied, %d skipped',
                    $copiedCount + $skippedCount,
                    $copiedCount,
                    $skippedCount
                )
            );
        }
    }

    /**
     * Ensure a directory exists, creating it if necessary.
     *
     * @param  string  $path
     * @param  int  $mode
     * @param  bool  $recursive
     * @return void
     */
    protected function ensureDirectoryExists(
        string $path,
        int $mode = 0755,
        bool $recursive = true
    ): void {
        if (! $this->files()->isDirectory($path)) {
            $this->files()->makeDirectory($path, $mode, $recursive);
        }
    }

    /**
     * Write output message if callback is provided.
     *
     * @param  callable|null  $output
     * @param  string  $type
     * @param  string  $message
     * @return void
     */
    protected function write(?callable $output, string $type, string $message): void
    {
        if ($output === null) {
            return;
        }

        $output($type, $message);
    }

    /**
     * Check if a file exists and contains specific content.
     *
     * @param  string  $path
     * @param  string  $content
     * @return bool
     */
    protected function fileContains(string $path, string $content): bool
    {
        if (! $this->files()->exists($path)) {
            return false;
        }

        return str_contains($this->files()->get($path), $content);
    }

    /**
     * Delete a file if it exists.
     *
     * @param  string  $path
     * @param  callable|null  $output
     * @return bool
     */
    protected function deleteFileIfExists(string $path, ?callable $output = null): bool
    {
        if (! $this->files()->exists($path)) {
            return false;
        }

        $this->files()->delete($path);
        $this->write($output, 'line', 'Deleted: ' . basename($path));

        return true;
    }
}
