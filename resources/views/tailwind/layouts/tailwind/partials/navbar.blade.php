<nav class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 shadow-sm shadow-slate-200/40 backdrop-blur">
    <div class="flex min-h-16 items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button" id="starterMobileOpen" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 lg:hidden" aria-label="Open navigation">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>

            <div class="min-w-0">
                <div class="truncate text-sm font-bold">{{ config('app.name', 'Laravel') }}</div>
                <div class="truncate text-xs text-slate-500">Admin workspace</div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden text-right sm:block">
                <div class="text-sm font-semibold text-slate-900">@auth {{ auth()->user()->name }} @else Administrator @endauth</div>
                <div class="text-xs text-slate-500">Signed in</div>
            </div>
            <div class="flex h-10 w-10 items-center justify-center rounded-full border border-blue-100 bg-blue-50 text-blue-700 shadow-sm">
                @auth
                    <span class="text-sm font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                @else
                    <i data-lucide="user" class="h-4 w-4"></i>
                @endauth
            </div>
        </div>
    </div>
</nav>
