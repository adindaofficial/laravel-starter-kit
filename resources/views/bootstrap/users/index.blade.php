@extends('layouts.bootstrap.app')

@section('title', 'Users')
@section('page-kicker', 'Management')
@section('page-title', 'Manajemen Users')
@section('page-subtitle', 'Tabel user menggunakan DataTables dengan pencarian, pagination, sorting, dan tampilan responsive.')

@section('page-actions')
    <button type="button" class="btn btn-outline-primary" onclick="window.location.reload()">
        <i class="bi bi-arrow-clockwise me-2"></i>Refresh
    </button>
    <button type="button" class="btn btn-primary" id="usersPageAlert">
        <i class="bi bi-bell me-2"></i>Notify
    </button>
@endsection

@section('content')
    @php
        $totalUsers = $users->count();
        $verifiedUsers = $users->filter(fn ($user) => ! is_null($user->email_verified_at))->count();
        $newUsers = $users->filter(fn ($user) => optional($user->created_at)->greaterThanOrEqualTo(now()->subDays(30)))->count();
    @endphp

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <x-bootstrap.stat-card label="Total users" :value="$totalUsers" icon="people" tone="primary" />
        </div>
        <div class="col-md-4">
            <x-bootstrap.stat-card label="Verified" :value="$verifiedUsers" icon="patch-check" tone="success" />
        </div>
        <div class="col-md-4">
            <x-bootstrap.stat-card label="Last 30 days" :value="$newUsers" icon="calendar2-week" tone="warning" />
        </div>
    </div>

    <div class="card starter-table-card border-0 shadow-sm">
        <div class="card-header d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-2 py-3">
            <div class="d-flex align-items-start gap-3">
                <span class="starter-table-icon">
                    <i class="bi bi-table"></i>
                </span>
                <div>
                    <h2 class="h6 fw-bold mb-1">User Directory</h2>
                    <p class="text-secondary small mb-0">DataTable responsive dengan pencarian, pagination, dan sorting.</p>
                </div>
            </div>
            <span class="badge text-bg-primary-subtle text-primary-emphasis">
                <i class="bi bi-database me-1"></i>{{ $totalUsers }} records
            </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="usersTable" class="table table-hover align-middle nowrap w-100 starter-datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Verified</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td class="fw-semibold">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->email_verified_at)
                                        <span class="badge text-bg-success">Verified</span>
                                    @else
                                        <span class="badge text-bg-secondary">Pending</span>
                                    @endif
                                </td>
                                <td>{{ optional($user->created_at)->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.StarterKit.dataTable('#usersTable', {
                order: [[0, 'asc']],
                columnDefs: [
                    { targets: 0, width: '5rem' },
                    { targets: 3, orderable: false }
                ]
            });

            document.getElementById('usersPageAlert')?.addEventListener('click', function () {
                window.StarterKit.toast('Users loaded', 'Data user sudah dimuat.');
            });
        });
    </script>
@endpush
