<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel Starter Kit'))</title>

    @include('layouts.bootstrap.partials.styles')
    @stack('styles')
</head>
<body class="starter-body">
    <div class="starter-shell d-lg-flex">
        @include('layouts.bootstrap.partials.sidebar')

        <div class="starter-main flex-grow-1 d-flex flex-column min-vh-100">
            @include('layouts.bootstrap.partials.navbar')

            <main class="starter-content flex-grow-1">
                @hasSection('page-title')
                    <div class="starter-page-header">
                        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
                            <div>
                                <div class="starter-page-kicker">@yield('page-kicker', 'Dashboard')</div>
                                <h1 class="h3 fw-bold mb-1">@yield('page-title')</h1>

                                @hasSection('page-subtitle')
                                    <p class="text-secondary mb-0">@yield('page-subtitle')</p>
                                @endif
                            </div>

                            @hasSection('page-actions')
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    @yield('page-actions')
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

            @include('layouts.bootstrap.partials.footer')
        </div>
    </div>

    @include('layouts.bootstrap.partials.scripts')
    @stack('scripts')
</body>
</html>
