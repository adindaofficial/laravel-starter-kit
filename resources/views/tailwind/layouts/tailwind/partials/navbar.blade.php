@php
    $starterUser = auth()->user();
    $starterUserName = $starterUser?->name ?? 'Administrator';
    $starterInitial = strtoupper(substr($starterUserName, 0, 1));
    $starterPageTitle = trim($__env->yieldContent('page-title', 'Dashboard'));
    $starterPageKicker = trim($__env->yieldContent('page-kicker', 'Workspace'));
@endphp

<nav class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/95 shadow-sm shadow-slate-200/60 backdrop-blur">
    <div class="flex min-h-[76px] items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button" id="starterMobileOpen" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 lg:hidden" aria-label="Open navigation">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>

            <span class="hidden h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20 sm:flex">
                <i data-lucide="panel-top" class="h-5 w-5"></i>
            </span>

            <div class="min-w-0">
                <div class="flex min-w-0 items-center gap-2">
                    <span class="hidden text-xs font-bold uppercase text-blue-600 sm:inline">{{ $starterPageKicker }}</span>
                    <span class="hidden h-1 w-1 rounded-full bg-slate-300 sm:inline-block"></span>
                    <span class="truncate text-sm font-semibold text-slate-500">{{ config('app.name', 'Laravel') }}</span>
                </div>
                <div class="mt-1 truncate text-lg font-bold leading-6 text-slate-950 sm:text-xl">{{ $starterPageTitle }}</div>
            </div>
        </div>

        <div class="flex shrink-0 items-center gap-2 sm:gap-3">
            <div class="hidden items-center gap-2 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2 lg:flex">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-blue-700 shadow-sm">
                    <i data-lucide="layers-3" class="h-4 w-4"></i>
                </span>
                <span>
                    <span class="block text-xs font-bold text-blue-800">Tailwind Kit</span>
                    <span class="block text-[11px] text-blue-600">Ready</span>
                </span>
            </div>

            <div class="flex min-w-0 items-center gap-3 rounded-lg border border-slate-200 bg-white px-2 py-2 shadow-sm">
                <div class="hidden min-w-0 text-right sm:block">
                    <div class="max-w-40 truncate text-sm font-semibold text-slate-900">{{ $starterUserName }}</div>
                    <div class="text-xs text-slate-500">Administrator</div>
                </div>
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                    <span class="text-sm font-bold">{{ $starterInitial }}</span>
                </div>
            </div>
        </div>
    </div>
</nav>
