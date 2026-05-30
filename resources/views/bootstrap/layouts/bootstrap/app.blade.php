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
        @include('layouts.bootstrap.partials.mobile-sidebar')

        <div class="starter-main flex-grow-1 d-flex flex-column min-vh-100">
            @include('layouts.bootstrap.partials.navbar')

            <main class="starter-content flex-grow-1">
                @include('layouts.bootstrap.partials.page-header')
                @yield('content')
            </main>

            @include('layouts.bootstrap.partials.footer')
        </div>
    </div>

    @include('layouts.bootstrap.partials.scripts')
    @stack('scripts')
</body>
</html>
