<div id="starterMobileOverlay" class="fixed inset-0 z-40 hidden bg-slate-950/55 backdrop-blur-sm lg:hidden">
    <div id="starterMobilePanel" class="starter-sidebar-scroll flex min-h-full w-80 max-w-[88vw] -translate-x-full flex-col overflow-y-auto bg-blue-950 p-4 text-blue-50 shadow-xl transition-transform duration-200">
        <div class="mb-5 flex items-center justify-between rounded-lg border border-white/10 bg-white/10 p-3">
            <a href="{{ url('/') }}" class="flex min-w-0 items-center gap-3">
                <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg border border-white/20 bg-white text-blue-700">
                    <i data-lucide="boxes" class="h-5 w-5"></i>
                </span>
                <span class="min-w-0">
                    <span class="block truncate text-sm font-bold text-white">{{ config('app.name', 'Laravel') }}</span>
                    <span class="mt-0.5 flex items-center gap-2 text-xs text-blue-100">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                        Admin workspace
                    </span>
                </span>
            </a>
            <button type="button" class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-white/10 text-white transition hover:bg-white/15" data-starter-mobile-close aria-label="Close navigation">
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>
        </div>

        <div class="mb-4 overflow-hidden rounded-lg border border-white/10 bg-gradient-to-br from-white/15 to-white/[.06] p-3">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <div class="text-xs font-semibold uppercase text-blue-200">Admin Suite</div>
                    <div class="mt-1 text-sm font-bold text-white">Starter Kit Panel</div>
                </div>
                <span class="rounded-full bg-emerald-400/15 px-2 py-0.5 text-xs font-semibold text-emerald-100">Online</span>
            </div>
        </div>

        <div class="px-3 pb-2 text-xs font-bold uppercase text-blue-200">Main Menu</div>
        <nav class="space-y-1.5">
            @include('layouts.tailwind.partials.nav-items')
        </nav>

        <div class="mt-auto rounded-lg border border-white/15 bg-white/10 p-3 text-xs text-blue-100">
            <div class="flex items-center justify-between">
                <span>Tailwind Starter Kit</span>
                <span>v1.0</span>
            </div>
        </div>
    </div>
</div>
