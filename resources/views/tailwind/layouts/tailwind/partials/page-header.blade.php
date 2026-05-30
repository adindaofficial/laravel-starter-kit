@hasSection('page-title')
    <div class="relative mb-5 overflow-hidden rounded-lg border border-slate-200 bg-white p-6 shadow-panel">
        <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>
        <div class="absolute right-0 top-0 h-28 w-28 rounded-bl-full bg-blue-50"></div>
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div class="relative flex items-start gap-4">
                <span class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20 sm:flex">
                    <i data-lucide="panel-top" class="h-5 w-5"></i>
                </span>
                <div>
                    <div class="text-xs font-bold uppercase text-blue-600">@yield('page-kicker', 'Dashboard')</div>
                    <h1 class="mt-1 text-3xl font-bold tracking-tight text-slate-950">@yield('page-title')</h1>

                    @hasSection('page-subtitle')
                        <p class="mt-1 max-w-2xl text-sm text-slate-500">@yield('page-subtitle')</p>
                    @endif
                </div>
            </div>

            @hasSection('page-actions')
                <div class="flex flex-wrap items-center gap-2">
                    @yield('page-actions')
                </div>
            @endif
        </div>
    </div>
@endif
