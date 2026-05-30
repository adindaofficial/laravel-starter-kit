<aside class="starter-sidebar-scroll hidden h-screen w-72 shrink-0 overflow-y-auto bg-gradient-to-b from-blue-700 via-blue-800 to-blue-950 p-4 text-blue-50 shadow-2xl shadow-blue-950/20 lg:sticky lg:top-0 lg:flex lg:flex-col">
    <a href="{{ url('/') }}" class="mb-5 flex items-center gap-3 rounded-lg border border-white/10 bg-white/10 p-3 shadow-lg shadow-blue-950/10 transition hover:bg-white/15">
        <span class="flex h-12 w-12 items-center justify-center rounded-lg border border-white/20 bg-white text-blue-700 shadow-lg shadow-blue-950/20">
            <i data-lucide="boxes" class="h-5 w-5"></i>
        </span>
        <span class="min-w-0 flex-1">
            <span class="block truncate text-base font-bold text-white">{{ config('app.name', 'Laravel') }}</span>
            <span class="mt-0.5 flex items-center gap-2 text-xs text-blue-100">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                Admin workspace
            </span>
        </span>
    </a>

    <div class="mb-5 rounded-lg border border-white/10 bg-white/[.08] p-3 shadow-inner shadow-white/5">
        <div class="flex items-center justify-between gap-3">
            <div>
                <div class="text-xs font-semibold uppercase text-blue-200">Workspace</div>
                <div class="mt-1 text-sm font-bold text-white">Starter Kit</div>
            </div>
            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white/10 text-blue-100">
                <i data-lucide="activity" class="h-5 w-5"></i>
            </span>
        </div>
        <div class="mt-3 grid grid-cols-2 gap-2 text-xs">
            <div class="rounded-lg border border-white/10 bg-blue-950/20 p-2">
                <div class="font-bold text-white">Tailwind</div>
                <div class="mt-0.5 text-blue-100">Interface</div>
            </div>
            <div class="rounded-lg border border-white/10 bg-blue-950/20 p-2">
                <div class="font-bold text-white">Laravel</div>
                <div class="mt-0.5 text-blue-100">Package</div>
            </div>
        </div>
    </div>

    <div class="px-3 pb-2 text-xs font-bold uppercase text-blue-200">Main Menu</div>
    <nav class="space-y-1.5">
        @include('layouts.tailwind.partials.nav-items')
    </nav>

    <div class="mt-auto pt-5">
        <div class="rounded-lg border border-white/15 bg-white/10 p-3 text-sm text-blue-50">
            <div class="mb-3 flex items-center justify-between gap-3">
                <div>
                    <div class="font-semibold text-white">System Status</div>
                    <div class="text-xs text-blue-100">All services available</div>
                </div>
                <span class="rounded-full bg-emerald-400/15 px-2 py-0.5 text-xs font-semibold text-emerald-100">Online</span>
            </div>
            <div class="h-1.5 overflow-hidden rounded-full bg-white/15">
                <div class="h-full w-4/5 rounded-full bg-gradient-to-r from-blue-200 to-emerald-200"></div>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs text-blue-100">
                <span>Tailwind Starter Kit</span>
                <span>v1.0</span>
            </div>
        </div>
    </div>
</aside>
