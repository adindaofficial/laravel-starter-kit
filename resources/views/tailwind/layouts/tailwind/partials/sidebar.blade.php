<aside class="hidden min-h-screen w-72 shrink-0 bg-gradient-to-b from-blue-700 via-blue-800 to-blue-950 p-4 text-blue-50 shadow-2xl shadow-blue-950/20 lg:flex lg:flex-col">
    <a href="{{ url('/') }}" class="mb-5 flex items-center gap-3 border-b border-white/10 pb-4">
        <span class="flex h-12 w-12 items-center justify-center rounded-lg border border-white/20 bg-white/15 text-white shadow-lg shadow-blue-950/20">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
        </span>
        <span class="min-w-0">
            <span class="block truncate text-base font-bold">{{ config('app.name', 'Laravel') }}</span>
            <span class="block text-xs text-blue-100">Starter dashboard</span>
        </span>
    </a>

    <div class="mb-4 rounded-lg border border-white/10 bg-white/10 p-3 shadow-inner shadow-white/5">
        <div class="flex items-center gap-2 text-sm font-semibold">
            <i data-lucide="sparkles" class="h-4 w-4 text-blue-200"></i>
            <span>Ready to Build</span>
        </div>
        <div class="mt-1 text-xs leading-5 text-blue-100">Tailwind layout, DataTables, SweetAlert, dan modal action sudah siap.</div>
    </div>

    <div class="px-3 pb-2 text-xs font-bold uppercase text-blue-200">Navigation</div>
    <nav class="space-y-1">
        @include('layouts.tailwind.partials.nav-items')
    </nav>

    <div class="mt-auto rounded-lg border border-white/15 bg-white/10 p-3 text-sm text-blue-50">
        <div class="mb-2 flex items-center justify-between">
            <span class="font-semibold">System</span>
            <span class="rounded-full bg-emerald-400/15 px-2 py-0.5 text-xs font-semibold text-emerald-100">Online</span>
        </div>
        <div class="h-1.5 overflow-hidden rounded-full bg-white/15">
            <div class="h-full w-3/4 rounded-full bg-blue-200"></div>
        </div>
        <div class="mt-2 text-xs text-blue-100">Laravel Tailwind Starter Kit</div>
    </div>
</aside>
