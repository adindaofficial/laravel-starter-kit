<div class="offcanvas offcanvas-start starter-mobile-sidebar" tabindex="-1" id="starterMobileSidebar" aria-labelledby="starterMobileSidebarLabel">
    <div class="offcanvas-header border-bottom border-white border-opacity-10">
        <a href="{{ url('/') }}" class="d-flex align-items-center gap-3 text-white text-decoration-none" id="starterMobileSidebarLabel">
            <span class="starter-brand-icon">
                <i class="bi bi-grid-1x2-fill"></i>
            </span>
            <span class="fw-semibold">{{ config('app.name', 'Laravel') }}</span>
        </a>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="starter-sidebar-label">Menu</div>
        <nav class="nav flex-column starter-offcanvas-nav">
            @include('layouts.bootstrap.partials.nav-items')
        </nav>
    </div>
</div>
