@php
    $starterUser = auth()->user();
    $starterUserName = $starterUser?->name ?? 'Administrator';
    $starterInitial = strtoupper(substr($starterUserName, 0, 1));
@endphp

<nav class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/95 shadow-sm shadow-slate-200/50 backdrop-blur">
    <div class="flex min-h-[72px] items-center justify-between gap-3 px-4 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-3">
            <button type="button" id="starterMobileOpen" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-700 lg:hidden" aria-label="Open navigation">
                <i data-lucide="menu" class="h-5 w-5"></i>
            </button>

            <div class="min-w-0 border-l border-transparent lg:border-slate-200 lg:pl-4">
                <div class="flex min-w-0 items-center gap-2">
                    <span class="truncate text-sm font-bold text-slate-950">{{ config('app.name', 'Laravel') }}</span>
                    <span class="hidden rounded-full border border-blue-100 bg-blue-50 px-2 py-0.5 text-[11px] font-bold uppercase text-blue-700 sm:inline-flex">Tailwind</span>
                </div>
                <div class="mt-1 flex flex-wrap items-center gap-2 text-xs text-slate-500">
                    <span>Admin panel</span>
                    <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                    <span class="inline-flex items-center gap-1.5 font-medium text-emerald-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                        Online
                    </span>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden items-center gap-2 rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 md:flex">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-white text-blue-700 shadow-sm">
                    <i data-lucide="shield-check" class="h-4 w-4"></i>
                </span>
                <span>
                    <span class="block text-xs font-bold text-slate-700">Secure Session</span>
                    <span class="block text-[11px] text-slate-500">Protected access</span>
                </span>
            </div>

            <div class="flex min-w-0 items-center gap-3 rounded-lg border border-slate-200 bg-white px-2.5 py-2 shadow-sm">
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
