<aside class="starter-sidebar d-none d-lg-flex flex-column">
    <div class="starter-brand">
        <a href="{{ url('/') }}" class="d-flex align-items-center gap-3 text-white text-decoration-none">
            <span class="starter-brand-icon">
                <i class="bi bi-grid-1x2-fill"></i>
            </span>
            <span class="min-w-0">
                <span class="d-block fw-semibold text-truncate">{{ config('app.name', 'Laravel') }}</span>
                <span class="d-block small text-blue-100">Starter Kit</span>
            </span>
        </a>
    </div>

    <div class="starter-sidebar-section">
        <div class="starter-sidebar-label">Menu</div>
        <nav class="nav flex-column starter-sidebar-nav">
            @include('layouts.bootstrap.partials.nav-items')
        </nav>
    </div>

    <div class="starter-sidebar-section mt-auto">
        <div class="starter-sidebar-card">
            <span class="starter-sidebar-card-icon">
                <i class="bi bi-shield-check"></i>
            </span>
            <span>
                <span class="d-block fw-semibold">Protected</span>
                <span class="d-block small">Laravel Starter Kit</span>
            </span>
        </div>
    </div>
</aside>
