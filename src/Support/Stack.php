<?php

namespace Mwy\LaravelStarterKit\Support;

use InvalidArgumentException;

final class Stack
{
    public const TAILWIND = 'tailwind';

    public static function available(): array
    {
        return config('starter-kit.stacks', [
            self::TAILWIND,
        ]);
    }

    public static function default(): string
    {
        return config('starter-kit.default_stack', self::TAILWIND);
    }

    public static function normalize(?string $stack): string
    {
        $stack = strtolower(trim((string) $stack));

        if ($stack === '') {
            return self::default();
        }

        if (! in_array($stack, self::available(), true)) {
            throw new InvalidArgumentException('Invalid stack. This starter kit only supports tailwind.');
        }

        return $stack;
    }
}
