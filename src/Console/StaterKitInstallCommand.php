<?php

namespace Mwy\LaravelStarterKit\Console;

class StaterKitInstallCommand extends InstallCommand
{
    protected $signature = 'stater-kit:install
        {--stack= : UI stack to install. Only tailwind is supported}
        {--force : Overwrite existing starter-kit files}
        {--without-route : Do not append the starter-kit route loader to routes/web.php}';
}
