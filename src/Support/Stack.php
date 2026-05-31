<?php

declare(strict_types=1);

namespace Mwy\LaravelStarterKit\Support;

use InvalidArgumentException;

/**
 * Stack Support Class
 *
 * Manages UI stack validation for the Laravel Starter Kit.
 * Currently supports Tailwind CSS only.
 *
 * @package Mwy\LaravelStarterKit\Support
 */
final class Stack
{
    /**
     * Tailwind CSS stack identifier
     *
     * @var string
     */
    public const TAILWIND = 'tailwind';

    /**
     * Get all available UI stacks.
     *
     * @return array<int, string>
     */
    public static function available(): array
    {
        return [self::TAILWIND];
    }

    /**
     * Get the default UI stack.
     *
     * @return string
     */
    public static function default(): string
    {
        return self::TAILWIND;
    }

    /**
     * Normalize and validate a stack name.
     *
     * @param  string|null  $stack
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function normalize(?string $stack): string
    {
        $stack = strtolower(trim((string) $stack));

        if ($stack === '') {
            return self::default();
        }

        if (! self::isValid($stack)) {
            throw new InvalidArgumentException(
                sprintf(
                    'Invalid stack "%s". Available stacks: %s',
                    $stack,
                    implode(', ', self::available())
                )
            );
        }

        return $stack;
    }

    /**
     * Check if a stack is valid.
     *
     * @param  string  $stack
     * @return bool
     */
    public static function isValid(string $stack): bool
    {
        return in_array($stack, self::available(), true);
    }

    /**
     * Get stack display name.
     *
     * @param  string  $stack
     * @return string
     */
    public static function displayName(string $stack): string
    {
        return match ($stack) {
            self::TAILWIND => 'Tailwind CSS',
            default => ucfirst($stack),
        };
    }
}
