@php
    $items = [
        ['label' => 'Dashboard', 'url' => url('/'), 'icon' => 'speedometer2', 'active' => request()->is('/')],
        ['label' => 'Users', 'url' => url('/users'), 'icon' => 'people', 'active' => request()->is('users')],
    ];
@endphp

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
            @foreach ($items as $item)
                <a href="{{ $item['url'] }}" class="nav-link {{ $item['active'] ? 'active' : '' }}">
                    <i class="bi bi-{{ $item['icon'] }}"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
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
            @foreach ($items as $item)
                <a href="{{ $item['url'] }}" class="nav-link {{ $item['active'] ? 'active' : '' }}">
                    <i class="bi bi-{{ $item['icon'] }}"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>
    </div>
</div>
