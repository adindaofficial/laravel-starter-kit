@hasSection('page-title')
    <div class="starter-page-header">
        <div class="d-flex flex-column flex-xl-row align-items-xl-center justify-content-between gap-3">
            <div>
                <div class="starter-page-kicker">@yield('page-kicker', 'Dashboard')</div>
                <h1 class="h3 fw-bold mb-1">@yield('page-title')</h1>

                @hasSection('page-subtitle')
                    <p class="text-secondary mb-0">@yield('page-subtitle')</p>
                @endif
            </div>

            @hasSection('page-actions')
                <div class="d-flex flex-wrap align-items-center gap-2">
                    @yield('page-actions')
                </div>
            @endif
        </div>
    </div>
@endif
