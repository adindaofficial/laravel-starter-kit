@extends('layouts.tailwind.app')

@section('title', 'Users')
@section('page-kicker', 'Management')
@section('page-title', 'Users')
@section('page-subtitle', 'Kelola data pengguna dengan DataTables, status verifikasi, dan ringkasan cepat.')

@section('page-actions')
    <button type="button" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg border border-blue-200 bg-white px-4 text-sm font-semibold text-blue-700 hover:bg-blue-50">
        <i data-lucide="download" class="h-4 w-4"></i>
        <span>Export</span>
    </button>
    <button type="button" id="usersPageAlert" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white hover:bg-blue-700">
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

        <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 border-b border-slate-200 p-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-sm font-bold text-slate-950">User Directory</h2>
                    <p class="text-sm text-slate-500">DataTable responsive dengan pencarian, pagination, dan sorting.</p>
                </div>
                <span class="inline-flex w-fit items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    <i data-lucide="database" class="h-3.5 w-3.5"></i>
                    {{ $totalUsers }} records
                </span>
            </div>

            <div class="p-4">
            <div class="overflow-x-auto">
                <table id="usersTable" class="w-full min-w-[760px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs uppercase text-slate-500">
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
                                <td class="px-3 py-3">{{ $user->id }}</td>
                                <td class="px-3 py-3 font-medium text-slate-950">{{ $user->name }}</td>
                                <td class="px-3 py-3">{{ $user->email }}</td>
                                <td class="px-3 py-3">
                                    @if ($user->email_verified_at)
                                        <span class="inline-flex rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700">Verified</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600">Pending</span>
                                    @endif
                                </td>
                                <td class="px-3 py-3">{{ optional($user->created_at)->format('d M Y') }}</td>
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
            new DataTable('#usersTable', {
                order: [[0, 'asc']],
                pageLength: 10,
                responsive: true
            });

            document.getElementById('usersPageAlert')?.addEventListener('click', function () {
                window.StarterKit.toast('Users loaded', 'Data user sudah dimuat.');
            });
        });
    </script>
@endpush
