@extends('layouts.tailwind.app')

@section('title', 'Users')
@section('page-kicker', 'Management')
@section('page-title', 'Manajemen Users')
@section('page-subtitle', 'Kelola user melalui tabel DataTables lengkap dengan pencarian, pagination, sorting, dan status verifikasi.')

@section('page-actions')
    <button type="button" onclick="window.location.reload()" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-blue-200 bg-white px-4 text-sm font-semibold text-blue-700 shadow-sm hover:bg-blue-50">
        <i data-lucide="refresh-cw" class="h-4 w-4"></i>
        <span>Refresh</span>
    </button>
    <button type="button" id="usersPageAlert" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 hover:bg-blue-700">
        <i data-lucide="bell" class="h-4 w-4"></i>
        <span>Notify</span>
    </button>
@endsection

@section('content')
    @php
        $totalUsers = $users->count();
        $verifiedUsers = $users->filter(fn ($user) => ! is_null($user->email_verified_at))->count();
        $newUsers = $users->filter(fn ($user) => optional($user->created_at)->greaterThanOrEqualTo(now()->subDays(30)))->count();
    @endphp

    <div class="space-y-5">
        <div class="grid gap-4 md:grid-cols-3">
            <x-tailwind.stat-card label="Total users" :value="$totalUsers" icon="users" />
            <x-tailwind.stat-card label="Verified" :value="$verifiedUsers" icon="badge-check" />
            <x-tailwind.stat-card label="Last 30 days" :value="$newUsers" icon="calendar-days" />
        </div>

        <div class="rounded-lg border border-slate-200 bg-white shadow-panel">
            <div class="flex flex-col gap-3 border-b border-slate-200 bg-gradient-to-r from-white to-blue-50 p-4 md:flex-row md:items-center md:justify-between">
                <div class="flex items-start gap-3">
                    <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-700">
                        <i data-lucide="table-2" class="h-5 w-5"></i>
                    </span>
                    <div>
                        <h2 class="text-sm font-bold text-slate-950">User Directory</h2>
                        <p class="text-sm text-slate-500">DataTable responsive dengan pencarian, pagination, dan sorting.</p>
                    </div>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    <i data-lucide="database" class="h-3.5 w-3.5"></i>
                    {{ $totalUsers }} records
                </span>
            </div>

            <div class="p-4">
                <div class="overflow-x-auto">
                    <table id="usersTable" class="starter-datatable w-full min-w-[820px] text-left text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-3">ID</th>
                                <th class="px-3 py-3">Name</th>
                                <th class="px-3 py-3">Email</th>
                                <th class="px-3 py-3">Verified</th>
                                <th class="px-3 py-3">Created</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($users as $user)
                                <tr class="hover:bg-blue-50/40">
                                    <td class="px-3 py-3">
                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">#{{ $user->id }}</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-100 text-sm font-bold text-blue-700">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                            <span>
                                                <span class="block font-semibold text-slate-950">{{ $user->name }}</span>
                                                <span class="block text-xs text-slate-500">User account</span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-slate-600">{{ $user->email }}</td>
                                    <td class="px-3 py-3">
                                        @if ($user->email_verified_at)
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                Verified
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">
                                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-slate-600">{{ optional($user->created_at)->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
