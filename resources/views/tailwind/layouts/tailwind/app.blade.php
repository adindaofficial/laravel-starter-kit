<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel Starter Kit'))</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#0f9f8f',
                            600: '#0c8075'
                        }
                    }
                }
            }
        };
    </script>
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.dataTables.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .dt-container {
            color: #27272a;
            width: 100%;
        }

        .dt-container .dt-layout-row {
            align-items: center;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: space-between;
            margin: 0 0 1rem;
        }

        .dt-container .dt-input {
            background: #ffffff;
            border: 1px solid #d4d4d8;
            border-radius: .5rem;
            padding: .375rem .75rem;
        }

        .dt-container .dt-paging-button {
            border: 1px solid #d4d4d8 !important;
            border-radius: .5rem !important;
            margin: 0 .125rem;
            padding: .35rem .65rem !important;
        }

        .dt-container .dt-paging-button.current {
            background: #0f9f8f !important;
            color: #ffffff !important;
        }
    </style>

    @stack('styles')
</head>
<body class="min-h-screen bg-zinc-100 text-zinc-900 antialiased">
    <div class="min-h-screen lg:flex">
        @include('layouts.tailwind.partials.sidebar')

        <div class="flex min-w-0 flex-1 flex-col">
            @include('layouts.tailwind.partials.navbar')

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @yield('content')
            </main>

            @include('layouts.tailwind.partials.footer')
        </div>
    </div>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>

    @stack('scripts')
</body>
</html>
