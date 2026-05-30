<nav class="starter-topbar navbar navbar-expand bg-white sticky-top">
    <div class="container-fluid px-3 px-lg-4">
        <button class="btn btn-light starter-icon-button d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#starterMobileSidebar" aria-controls="starterMobileSidebar" aria-label="Open navigation">
            <i class="bi bi-list"></i>
        </button>

        <a class="navbar-brand fw-semibold d-lg-none ms-2" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <form class="starter-search d-none d-md-flex ms-lg-0" role="search">
            <i class="bi bi-search"></i>
            <input type="search" class="form-control" placeholder="Search" aria-label="Search">
        </form>

        <div class="ms-auto d-flex align-items-center gap-2">
            <button type="button" class="btn btn-light starter-icon-button" id="starterNavbarAlert" data-bs-toggle="tooltip" data-bs-title="Notifications">
                <i class="bi bi-bell"></i>
            </button>

            <button type="button" class="btn btn-light starter-icon-button d-none d-sm-inline-flex" data-bs-toggle="tooltip" data-bs-title="Shortcuts">
                <i class="bi bi-lightning-charge"></i>
            </button>

            <div class="dropdown">
                <button class="btn starter-user-menu dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="starter-avatar">
                        <i class="bi bi-person"></i>
                    </span>
                    <span class="d-none d-sm-inline text-start">
                        <span class="d-block fw-semibold lh-sm">@auth {{ auth()->user()->name }} @else Administrator @endauth</span>
                        <span class="d-block small text-secondary lh-sm">Dashboard</span>
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person-circle me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
