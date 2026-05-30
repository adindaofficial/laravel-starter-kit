<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel Starter Kit'))</title>

    @include('layouts.tailwind.partials.styles')
    @stack('styles')
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div class="min-h-screen bg-[linear-gradient(180deg,#f8fbff_0%,#eef4ff_42%,#f8fafc_100%)] lg:flex">
        @include('layouts.tailwind.partials.mobile-sidebar')
        @include('layouts.tailwind.partials.sidebar')

        <div class="flex min-w-0 flex-1 flex-col">
            @include('layouts.tailwind.partials.navbar')

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @include('layouts.tailwind.partials.page-header')
                @yield('content')
            </main>

            @include('layouts.tailwind.partials.footer')
        </div>
    </div>

    @include('layouts.tailwind.partials.scripts')
    @stack('scripts')
</body>
</html>
