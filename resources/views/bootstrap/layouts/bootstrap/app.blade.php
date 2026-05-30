<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel Starter Kit'))</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        :root {
            --starter-sidebar-width: 17rem;
        }

        body {
            background: #f5f6f8;
        }

        .starter-shell {
            min-height: 100vh;
        }

        .starter-sidebar {
            background: #24272f;
            color: #f8f9fa;
            min-height: 100vh;
            width: var(--starter-sidebar-width);
        }

        .starter-sidebar .nav-link {
            border-radius: .55rem;
            color: rgba(255, 255, 255, .76);
            font-weight: 500;
            margin-bottom: .25rem;
        }

        .starter-sidebar .nav-link:hover,
        .starter-sidebar .nav-link.active {
            background: rgba(255, 255, 255, .12);
            color: #ffffff;
        }

        .starter-main {
            min-width: 0;
        }

        .starter-content {
            padding: 1.5rem;
        }

        @media (min-width: 992px) {
            .starter-content {
                padding: 2rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="starter-shell d-lg-flex">
        @include('layouts.bootstrap.partials.sidebar')

        <div class="starter-main flex-grow-1 d-flex flex-column">
            @include('layouts.bootstrap.partials.navbar')

            <main class="starter-content flex-grow-1">
                @yield('content')
            </main>

            @include('layouts.bootstrap.partials.footer')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')
</body>
</html>
