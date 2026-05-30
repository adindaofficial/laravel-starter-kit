<aside class="hidden min-h-screen w-72 shrink-0 bg-gradient-to-b from-blue-700 via-blue-800 to-blue-950 p-4 text-blue-50 shadow-2xl shadow-blue-950/20 lg:flex lg:flex-col">
    <a href="{{ url('/') }}" class="mb-5 flex items-center gap-3 border-b border-white/10 pb-4">
        <span class="flex h-11 w-11 items-center justify-center rounded-lg border border-white/20 bg-white/15 text-white shadow-lg shadow-blue-950/20">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
        </span>
        <span class="min-w-0">
            <span class="block truncate text-sm font-bold">{{ config('app.name', 'Laravel') }}</span>
            <span class="block text-xs text-blue-100">Tailwind Starter Kit</span>
        </span>
    </a>

    <div class="mb-4 rounded-lg border border-white/10 bg-white/10 p-3">
        <div class="flex items-center gap-2 text-sm font-semibold">
            <i data-lucide="sparkles" class="h-4 w-4 text-blue-200"></i>
            <span>Workspace Ready</span>
        </div>
        <div class="mt-1 text-xs text-blue-100">Layouts, icons, SweetAlert, dan DataTables sudah tersedia.</div>
    </div>

    <div class="px-3 pb-2 text-xs font-bold uppercase text-blue-200">Navigation</div>
    <nav class="space-y-1">
        @include('layouts.tailwind.partials.nav-items')
    </nav>

    <div class="mt-auto rounded-lg border border-white/15 bg-white/10 p-3 text-sm text-blue-50">
        <div class="mb-1 flex items-center gap-2 font-semibold">
            <i data-lucide="shield-check" class="h-4 w-4"></i>
            <span>Protected</span>
        </div>
        <div class="text-xs text-blue-100">Laravel Starter Kit</div>
    </div>
</aside>
