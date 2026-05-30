<nav class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur">
    <div class="flex min-h-16 items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button" id="starterMobileOpen" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 lg:hidden" aria-label="Open navigation">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>

            <div class="min-w-0">
                <div class="truncate text-sm font-bold">{{ config('app.name', 'Laravel') }}</div>
                <div class="truncate text-xs text-slate-500">Tailwind dashboard</div>
            </div>
        </div>

        <div class="hidden min-w-0 flex-1 justify-center md:flex">
            <label class="flex h-10 w-full max-w-md items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-3 text-slate-500 focus-within:border-blue-400 focus-within:bg-white focus-within:ring-4 focus-within:ring-blue-100">
                <i data-lucide="search" class="h-4 w-4"></i>
                <input type="search" class="min-w-0 flex-1 bg-transparent text-sm text-slate-800 outline-none placeholder:text-slate-400" placeholder="Search" aria-label="Search">
                <span class="rounded border border-slate-200 bg-white px-1.5 py-0.5 text-[11px] font-semibold text-slate-400">Ctrl K</span>
            </label>
        </div>

        <div class="flex items-center gap-2">
            <button type="button" id="starterNavbarAlert" class="relative inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50" title="Notifications">
                <i data-lucide="bell" class="h-4 w-4"></i>
                <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-blue-600"></span>
            </button>

            <button type="button" class="hidden h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 sm:inline-flex" title="Shortcuts">
                <i data-lucide="zap" class="h-4 w-4"></i>
            </button>

            <div class="flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-2 py-1 shadow-sm">
                <span class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-blue-700">
                    <i data-lucide="user" class="h-4 w-4"></i>
                </span>
                <span class="hidden text-left sm:block">
                    <span class="block text-sm font-semibold leading-tight">@auth {{ auth()->user()->name }} @else Administrator @endauth</span>
                    <span class="block text-xs leading-tight text-slate-500">Dashboard</span>
                </span>
            </div>
        </div>
    </div>
</nav>
