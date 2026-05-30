<aside class="hidden min-h-screen w-72 shrink-0 bg-blue-800 p-4 text-blue-50 lg:flex lg:flex-col">
    <a href="{{ url('/') }}" class="mb-5 flex items-center gap-3 border-b border-white/10 pb-4">
        <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-white/20 bg-white/15 text-white">
            <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
        </span>
        <span class="min-w-0">
            <span class="block truncate font-semibold">{{ config('app.name', 'Laravel') }}</span>
            <span class="block text-xs text-blue-100">Starter Kit</span>
        </span>
    </a>

    <div class="px-3 pb-2 text-xs font-bold uppercase text-blue-200">Menu</div>
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
