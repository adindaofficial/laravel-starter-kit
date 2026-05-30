@hasSection('page-title')
    <div class="mb-5 rounded-lg border border-slate-200 bg-gradient-to-br from-white via-white to-blue-50 p-5 shadow-panel">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div class="flex items-start gap-4">
                <span class="hidden h-12 w-12 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20 sm:flex">
                    <i data-lucide="panel-top" class="h-5 w-5"></i>
                </span>
                <div>
                    <div class="text-xs font-bold uppercase text-blue-600">@yield('page-kicker', 'Dashboard')</div>
                    <h1 class="mt-1 text-2xl font-bold text-slate-950">@yield('page-title')</h1>

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
