@hasSection('page-title')
    <div class="mb-5 rounded-lg border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div>
                <div class="text-xs font-bold uppercase text-blue-600">@yield('page-kicker', 'Dashboard')</div>
                <h1 class="mt-1 text-2xl font-bold text-slate-950">@yield('page-title')</h1>

                @hasSection('page-subtitle')
                    <p class="mt-1 text-sm text-slate-500">@yield('page-subtitle')</p>
                @endif
            </div>

            @hasSection('page-actions')
                <div class="flex flex-wrap items-center gap-2">
                    @yield('page-actions')
                </div>
            @endif
        </div>
    </div>
@endif
