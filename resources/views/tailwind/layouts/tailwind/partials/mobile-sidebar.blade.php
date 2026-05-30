<div id="starterMobileOverlay" class="fixed inset-0 z-40 hidden bg-slate-950/50 lg:hidden">
    <div id="starterMobilePanel" class="min-h-full w-72 -translate-x-full bg-blue-800 p-4 text-blue-50 shadow-xl transition-transform duration-200">
        <div class="mb-5 flex items-center justify-between border-b border-white/10 pb-4">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-white/20 bg-white/15 text-white">
                    <i data-lucide="layout-dashboard" class="h-5 w-5"></i>
                </span>
                <span class="font-semibold">{{ config('app.name', 'Laravel') }}</span>
            </a>
            <button type="button" class="flex h-9 w-9 items-center justify-center rounded-lg bg-white/10 text-white" data-starter-mobile-close aria-label="Close navigation">
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>
        </div>

        <div class="px-3 pb-2 text-xs font-bold uppercase text-blue-200">Menu</div>
        <nav class="space-y-1">
            @include('layouts.tailwind.partials.nav-items')
        </nav>
    </div>
</div>
