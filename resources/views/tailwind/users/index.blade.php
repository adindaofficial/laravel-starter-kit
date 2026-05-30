@extends('layouts.tailwind.app')

@section('title', 'Users')
@section('page-kicker', 'Management')
@section('page-title', 'Manajemen Users')
@section('page-subtitle', 'Kelola user melalui tabel DataTables lengkap dengan pencarian, pagination, sorting, dan status verifikasi.')

@section('content')
    @php
        $totalUsers = $users->count();
        $verifiedUsers = $users->filter(fn ($user) => ! is_null($user->email_verified_at))->count();
        $newUsers = $users->filter(fn ($user) => optional($user->created_at)->greaterThanOrEqualTo(now()->subDays(30)))->count();
    @endphp

    <div class="space-y-5">
        @if ($errors->any())
            <x-tailwind.alert type="danger" title="Validasi gagal">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-tailwind.alert>
        @endif

        <div class="grid gap-4 md:grid-cols-3">
            <x-tailwind.stat-card label="Total users" :value="$totalUsers" icon="users" />
            <x-tailwind.stat-card label="Verified" :value="$verifiedUsers" icon="badge-check" />
            <x-tailwind.stat-card label="Last 30 days" :value="$newUsers" icon="calendar-days" />
        </div>

        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-panel">
            <div class="flex flex-col gap-3 border-b border-slate-200 bg-gradient-to-r from-white via-blue-50 to-white p-5 md:flex-row md:items-center md:justify-between">
                <div class="flex items-start gap-3">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                        <i data-lucide="table-2" class="h-5 w-5"></i>
                    </span>
                    <div>
                        <h2 class="text-base font-bold text-slate-950">Users</h2>
                        <p class="mt-1 text-sm text-slate-500">Kelola data pengguna dengan DataTables dan action modal.</p>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <table id="usersTable" class="starter-datatable w-full min-w-[820px] text-left text-sm">
                        <thead>
                            <tr>
                                <th class="px-3 py-3">ID</th>
                                <th class="px-3 py-3">Name</th>
                                <th class="px-3 py-3">Email</th>
                                <th class="px-3 py-3">Verified</th>
                                <th class="px-3 py-3">Created</th>
                                <th class="px-3 py-3 text-right">Actions</th>
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
                                    <td class="px-3 py-3">
                                        <div class="flex justify-end gap-2">
                                            <button
                                                type="button"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-blue-200 bg-blue-50 text-blue-700 hover:bg-blue-100"
                                                data-user-reset
                                                data-action="{{ route('starter-kit.users.reset-password', $user) }}"
                                                data-name="{{ $user->name }}"
                                                title="Reset password"
                                            >
                                                <i data-lucide="key-round" class="h-4 w-4"></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-amber-200 bg-amber-50 text-amber-700 hover:bg-amber-100"
                                                data-user-edit
                                                data-action="{{ route('starter-kit.users.update', $user) }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-verified="{{ $user->email_verified_at ? '1' : '0' }}"
                                                title="Edit user"
                                            >
                                                <i data-lucide="pencil" class="h-4 w-4"></i>
                                            </button>
                                            <button
                                                type="button"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100"
                                                data-user-delete
                                                data-action="{{ route('starter-kit.users.destroy', $user) }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                title="Delete user"
                                            >
                                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="editUserModal" class="fixed inset-0 z-50 hidden" data-starter-modal>
        <div class="absolute inset-0 bg-slate-950/55 opacity-0 backdrop-blur-sm transition-opacity duration-150" data-starter-modal-backdrop></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div class="w-full max-w-lg translate-y-2 scale-95 rounded-lg border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-150" data-starter-modal-panel>
                <form id="editUserForm" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="flex items-start justify-between gap-4 border-b border-slate-200 p-5">
                        <div class="flex items-start gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-amber-50 text-amber-700">
                                <i data-lucide="pencil" class="h-5 w-5"></i>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-slate-950">Edit User</h3>
                                <p class="mt-1 text-sm text-slate-500">Ubah nama, email, dan status verifikasi user.</p>
                            </div>
                        </div>
                        <button type="button" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700" data-starter-modal-close>
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="space-y-4 p-5">
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Name</span>
                            <input id="editUserName" name="name" type="text" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Email</span>
                            <input id="editUserEmail" name="email" type="email" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="flex items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 p-3">
                            <input id="editUserVerified" name="email_verified" value="1" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>
                                <span class="block text-sm font-semibold text-slate-800">Verified email</span>
                                <span class="block text-xs text-slate-500">Centang untuk menandai email user sudah terverifikasi.</span>
                            </span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 p-4">
                        <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Cancel</button>
                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 hover:bg-blue-700">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="resetUserModal" class="fixed inset-0 z-50 hidden" data-starter-modal>
        <div class="absolute inset-0 bg-slate-950/55 opacity-0 backdrop-blur-sm transition-opacity duration-150" data-starter-modal-backdrop></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div class="w-full max-w-md translate-y-2 scale-95 rounded-lg border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-150" data-starter-modal-panel>
                <form id="resetPasswordForm" method="POST">
                    @csrf

                    <div class="flex items-start justify-between gap-4 border-b border-slate-200 p-5">
                        <div class="flex items-start gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-700">
                                <i data-lucide="key-round" class="h-5 w-5"></i>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-slate-950">Reset Password</h3>
                                <p class="mt-1 text-sm text-slate-500">Reset password untuk <span id="resetUserName" class="font-semibold text-slate-800"></span>.</p>
                            </div>
                        </div>
                        <button type="button" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700" data-starter-modal-close>
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="space-y-4 p-5">
                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">New password</span>
                            <input id="resetPassword" name="password" type="password" value="password" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Confirm password</span>
                            <input id="resetPasswordConfirmation" name="password_confirmation" type="password" value="password" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <div class="rounded-lg border border-blue-100 bg-blue-50 p-3 text-sm text-blue-800">
                            Default password starter kit adalah <span class="font-semibold">password</span>. Ubah sebelum submit jika diperlukan.
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 p-4">
                        <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Cancel</button>
                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 hover:bg-blue-700">Reset password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteUserModal" class="fixed inset-0 z-50 hidden" data-starter-modal>
        <div class="absolute inset-0 bg-slate-950/55 opacity-0 backdrop-blur-sm transition-opacity duration-150" data-starter-modal-backdrop></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div class="w-full max-w-md translate-y-2 scale-95 rounded-lg border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-150" data-starter-modal-panel>
                <form id="deleteUserForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="flex items-start justify-between gap-4 border-b border-slate-200 p-5">
                        <div class="flex items-start gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50 text-rose-700">
                                <i data-lucide="trash-2" class="h-5 w-5"></i>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-slate-950">Delete User</h3>
                                <p class="mt-1 text-sm text-slate-500">Aksi ini akan menghapus user dari database.</p>
                            </div>
                        </div>
                        <button type="button" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700" data-starter-modal-close>
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="space-y-4 p-5">
                        <div class="rounded-lg border border-rose-100 bg-rose-50 p-4">
                            <div class="text-sm font-semibold text-rose-900" id="deleteUserName"></div>
                            <div class="mt-1 text-sm text-rose-700" id="deleteUserEmail"></div>
                        </div>
                        <p class="text-sm text-slate-500">Pastikan data user ini memang boleh dihapus. Proses ini tidak dapat dibatalkan dari starter kit.</p>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 p-4">
                        <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Cancel</button>
                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-rose-600 px-4 text-sm font-semibold text-white shadow-sm shadow-rose-600/20 hover:bg-rose-700">Delete user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.addEventListener('click', function (event) {
                const editButton = event.target.closest('[data-user-edit]');
                const resetButton = event.target.closest('[data-user-reset]');
                const deleteButton = event.target.closest('[data-user-delete]');

                if (editButton) {
                    document.getElementById('editUserForm').action = editButton.dataset.action;
                    document.getElementById('editUserName').value = editButton.dataset.name;
                    document.getElementById('editUserEmail').value = editButton.dataset.email;
                    document.getElementById('editUserVerified').checked = editButton.dataset.verified === '1';
                    window.StarterKit.openModal('editUserModal');
                }

                if (resetButton) {
                    document.getElementById('resetPasswordForm').action = resetButton.dataset.action;
                    document.getElementById('resetUserName').textContent = resetButton.dataset.name;
                    document.getElementById('resetPassword').value = 'password';
                    document.getElementById('resetPasswordConfirmation').value = 'password';
                    window.StarterKit.openModal('resetUserModal');
                }

                if (deleteButton) {
                    document.getElementById('deleteUserForm').action = deleteButton.dataset.action;
                    document.getElementById('deleteUserName').textContent = deleteButton.dataset.name;
                    document.getElementById('deleteUserEmail').textContent = deleteButton.dataset.email;
                    window.StarterKit.openModal('deleteUserModal');
                }
            });

            lucide.createIcons();
        });
    </script>
@endpush
