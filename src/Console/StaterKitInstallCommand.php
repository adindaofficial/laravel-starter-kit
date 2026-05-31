<?php

namespace Mwy\LaravelStarterKit\Console;

class StaterKitInstallCommand extends InstallCommand
{
    protected $signature = 'stater-kit:install
        {--stack= : UI stack to install. Only tailwind is supported}
        {--force : Overwrite existing starter-kit files}
        {--without-route : Do not append starter kit routes to routes/web.php}';
}
