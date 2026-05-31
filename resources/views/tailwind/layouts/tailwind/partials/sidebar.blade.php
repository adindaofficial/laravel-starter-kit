<aside class="starter-sidebar-scroll relative hidden h-screen w-72 shrink-0 overflow-y-auto bg-blue-950 p-4 text-blue-50 shadow-2xl shadow-blue-950/25 lg:sticky lg:top-0 lg:flex lg:flex-col">
    <div class="pointer-events-none absolute inset-x-0 top-0 h-40 bg-gradient-to-b from-blue-600/35 to-transparent"></div>

    <div class="relative">
        <a href="{{ url('/') }}" class="mb-5 flex items-center gap-3 rounded-lg border border-white/10 bg-white/10 p-3 shadow-lg shadow-blue-950/10 transition hover:bg-white/15">
            <span class="flex h-12 w-12 items-center justify-center rounded-lg border border-white/20 bg-white text-blue-700 shadow-lg shadow-blue-950/20">
                <i data-lucide="boxes" class="h-5 w-5"></i>
            </span>
            <span class="min-w-0 flex-1">
                <span class="block truncate text-base font-bold text-white">{{ config('app.name', 'Laravel') }}</span>
                <span class="mt-0.5 flex items-center gap-2 text-xs text-blue-100">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                    Workspace admin
                </span>
            </span>
        </a>
    </div>

    <div class="relative px-3 pb-2 text-xs font-bold uppercase text-blue-200">Menu Utama</div>
    <nav class="relative space-y-1.5">
        @include('layouts.tailwind.partials.nav-items')
    </nav>

    <div class="relative mt-auto pt-5">
        <div class="rounded-lg border border-white/15 bg-white/10 p-3 text-sm text-blue-50">
            <div class="mb-3 flex items-center justify-between gap-3">
                <div>
                    <div class="font-semibold text-white">Status Sistem</div>
                    <div class="text-xs text-blue-100">Semua layanan aktif</div>
                </div>
                <span class="rounded-full bg-emerald-400/15 px-2 py-0.5 text-xs font-semibold text-emerald-100">Online</span>
            </div>
            <div class="mt-3 flex items-center justify-between text-xs text-blue-100">
                <span>Tailwind Starter Kit</span>
                <span>v1.0</span>
            </div>
        </div>
    </div>
</aside>
