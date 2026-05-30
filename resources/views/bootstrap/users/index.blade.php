@extends('layouts.bootstrap.app')

@section('title', 'Users')

@section('content')
    @php
        $totalUsers = $users->count();
        $verifiedUsers = $users->filter(fn ($user) => ! is_null($user->email_verified_at))->count();
        $newUsers = $users->filter(fn ($user) => optional($user->created_at)->greaterThanOrEqualTo(now()->subDays(30)))->count();
    @endphp

    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
        <div>
            <div class="text-secondary small text-uppercase fw-semibold">Management</div>
            <h1 class="h3 mb-0">Users</h1>
        </div>

        <button type="button" class="btn btn-primary" id="usersPageAlert">
            <i class="bi bi-bell me-2"></i>Notify
        </button>
    </div>

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

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table id="usersTable" class="table table-striped table-hover align-middle nowrap w-100">
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
            new DataTable('#usersTable', {
                order: [[0, 'asc']],
                pageLength: 10,
                responsive: true
            });

            document.getElementById('usersPageAlert')?.addEventListener('click', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Users loaded',
                    text: 'Data user sudah dimuat.',
                    timer: 1500,
                    showConfirmButton: false
                });
            });
        });
    </script>
@endpush
