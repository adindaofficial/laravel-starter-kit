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
            <button type="button" class="hidden items-center gap-2 rounded-lg border border-blue-100 bg-blue-50 px-3 py-2 text-left shadow-sm transition hover:border-blue-200 hover:bg-blue-100/60 xl:flex">
                <span class="relative flex h-8 w-8 items-center justify-center rounded-lg bg-white text-blue-700 shadow-sm">
                    <i data-lucide="bell" class="h-4 w-4"></i>
                    <span class="absolute -right-0.5 -top-0.5 h-2.5 w-2.5 rounded-full border-2 border-white bg-rose-500"></span>
                </span>
                <span>
                    <span class="block text-xs font-bold text-blue-800">Notifikasi</span>
                    <span class="block text-[11px] text-blue-600">3 baru</span>
                </span>
            </button>

            <div class="relative" data-starter-profile>
                <button type="button" class="flex min-w-0 items-center gap-3 rounded-lg border border-slate-200 bg-white px-2 py-2 text-left shadow-sm transition hover:border-blue-200 hover:bg-blue-50/40" data-starter-profile-button aria-expanded="false" aria-haspopup="true">
                    <div class="hidden min-w-0 text-right sm:block">
                        <div class="max-w-40 truncate text-sm font-semibold text-slate-900">{{ $starterUserName }}</div>
                        <div class="text-xs text-slate-500">Administrator</div>
                    </div>
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                        <span class="text-sm font-bold">{{ $starterInitial }}</span>
                    </div>
                    <i data-lucide="chevron-down" class="hidden h-4 w-4 text-slate-400 sm:block"></i>
                </button>

                <div class="absolute right-0 z-50 mt-2 hidden w-72 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-2xl shadow-slate-900/10" data-starter-profile-menu>
                    <div class="border-b border-slate-100 bg-gradient-to-r from-blue-50 to-white p-4">
                        <div class="flex items-center gap-3">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                                <span class="text-sm font-bold">{{ $starterInitial }}</span>
                            </span>
                            <span class="min-w-0">
                                <span class="block truncate text-sm font-bold text-slate-950">{{ $starterUserName }}</span>
                                <span class="block truncate text-xs text-slate-500">Administrator</span>
                            </span>
                        </div>
                    </div>

                    <div class="p-2">
                        <button type="button" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                                <i data-lucide="user-round" class="h-4 w-4"></i>
                            </span>
                            <span>
                                <span class="block font-semibold">Profile</span>
                                <span class="block text-xs text-slate-500">Informasi akun</span>
                            </span>
                        </button>

                        <button type="button" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                                <i data-lucide="settings" class="h-4 w-4"></i>
                            </span>
                            <span>
                                <span class="block font-semibold">Setting</span>
                                <span class="block text-xs text-slate-500">Preferensi tampilan</span>
                            </span>
                        </button>

                        <div class="my-2 border-t border-slate-100"></div>

                        <button type="button" class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm text-rose-700 transition hover:bg-rose-50">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-rose-50 text-rose-600">
                                <i data-lucide="log-out" class="h-4 w-4"></i>
                            </span>
                            <span>
                                <span class="block font-semibold">Logout</span>
                                <span class="block text-xs text-rose-500">Keluar Dari Dashboard</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
