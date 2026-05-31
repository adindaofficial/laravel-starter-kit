<?php

declare(strict_types=1);

use Mwy\LaravelStarterKit\Providers\LaravelStarterKitServiceProvider;

if (! class_exists('Mwy\\LaravelStarterKit\\LaravelStarterKitServiceProvider', false)) {
    class_alias(LaravelStarterKitServiceProvider::class, 'Mwy\\LaravelStarterKit\\LaravelStarterKitServiceProvider');
}
