<aside class="starter-sidebar d-none d-lg-flex flex-column p-3">
    <a href="{{ url('/') }}" class="d-flex align-items-center gap-2 text-white text-decoration-none mb-4">
        <span class="d-inline-flex align-items-center justify-content-center rounded bg-white text-dark" style="height: 2.25rem; width: 2.25rem;">
            <i class="bi bi-grid-1x2-fill"></i>
        </span>
        <span class="fw-semibold">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <nav class="nav nav-pills flex-column">
        <a href="{{ url('/') }}" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </a>
        <a href="{{ url('/users') }}" class="nav-link {{ request()->is('users') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i>Users
        </a>
    </nav>

    <div class="mt-auto small text-white-50">
        Laravel Starter Kit
    </div>
</aside>
