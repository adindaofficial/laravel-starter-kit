@extends('layouts.tailwind.app')

@section('title', 'Users')

@section('content')
    @php
        $totalUsers = $users->count();
        $verifiedUsers = $users->filter(fn ($user) => ! is_null($user->email_verified_at))->count();
        $newUsers = $users->filter(fn ($user) => optional($user->created_at)->greaterThanOrEqualTo(now()->subDays(30)))->count();
    @endphp

    <div class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="text-xs font-semibold uppercase text-zinc-500">Management</div>
                <h1 class="text-2xl font-semibold text-zinc-950">Users</h1>
            </div>

            <button type="button" id="usersPageAlert" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-brand-500 px-4 text-sm font-semibold text-white hover:bg-brand-600">
                <i data-lucide="bell" class="h-4 w-4"></i>
                <span>Notify</span>
            </button>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <x-tailwind.stat-card label="Total users" :value="$totalUsers" icon="users" />
            <x-tailwind.stat-card label="Verified" :value="$verifiedUsers" icon="badge-check" />
            <x-tailwind.stat-card label="Last 30 days" :value="$newUsers" icon="calendar-days" />
        </div>

        <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
            <div class="overflow-x-auto">
                <table id="usersTable" class="w-full min-w-[760px] text-left text-sm">
                    <thead>
                        <tr class="border-b border-zinc-200 text-xs uppercase text-zinc-500">
                            <th class="px-3 py-3">ID</th>
                            <th class="px-3 py-3">Name</th>
                            <th class="px-3 py-3">Email</th>
                            <th class="px-3 py-3">Verified</th>
                            <th class="px-3 py-3">Created</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-100">
                        @foreach ($users as $user)
                            <tr class="hover:bg-zinc-50">
                                <td class="px-3 py-3">{{ $user->id }}</td>
                                <td class="px-3 py-3 font-medium text-zinc-950">{{ $user->name }}</td>
                                <td class="px-3 py-3">{{ $user->email }}</td>
                                <td class="px-3 py-3">
                                    @if ($user->email_verified_at)
                                        <span class="inline-flex rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-700">Verified</span>
                                    @else
                                        <span class="inline-flex rounded-full bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-600">Pending</span>
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
