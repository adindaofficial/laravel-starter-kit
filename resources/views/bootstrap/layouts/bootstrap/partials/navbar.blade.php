<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand fw-semibold d-lg-none" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#starterNavbar" aria-controls="starterNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="starterNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-lg-none">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('users') ? 'active' : '' }}" href="{{ url('/users') }}">
                        <i class="bi bi-people me-2"></i>Users
                    </a>
                </li>
            </ul>

            <div class="ms-lg-auto d-flex align-items-center gap-3">
                <button type="button" class="btn btn-outline-secondary btn-sm" id="starterNavbarAlert">
                    <i class="bi bi-bell me-1"></i>Notify
                </button>

                @auth
                    <span class="small text-secondary">{{ auth()->user()->name }}</span>
                @endauth
            </div>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        document.getElementById('starterNavbarAlert')?.addEventListener('click', function () {
            Swal.fire({
                icon: 'success',
                title: 'Ready',
                text: 'Starter kit aktif.',
                timer: 1400,
                showConfirmButton: false
            });
        });
    </script>
@endpush
