<?php

namespace Winnicode\LaravelStarterKit\Support;

use InvalidArgumentException;

final class Stack
{
    public const BOOTSTRAP = 'bootstrap';

    public const TAILWIND = 'tailwind';

    public static function available(): array
    {
        return config('starter-kit.stacks', [
            self::BOOTSTRAP,
            self::TAILWIND,
        ]);
    }

    public static function default(): string
    {
        return config('starter-kit.default_stack', self::BOOTSTRAP);
    }

    public static function normalize(?string $stack): string
    {
        $stack = strtolower(trim((string) $stack));

        if ($stack === '') {
            return self::default();
        }

        if (! in_array($stack, self::available(), true)) {
            throw new InvalidArgumentException('Invalid stack. Use bootstrap or tailwind.');
        }

        return $stack;
    }
}
