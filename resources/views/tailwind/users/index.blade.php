@extends('layouts.tailwind.app')

@section('title', 'Manajemen User')
@section('page-kicker', 'Pengguna')
@section('page-title', 'Manajemen User')
@section('page-subtitle', 'Kelola akun pengguna, status verifikasi, password, dan data akses dari satu halaman.')
@section('page-actions')
    <div class="flex flex-wrap items-center gap-2">
        <button type="button" class="inline-flex h-11 items-center justify-center gap-2 rounded-lg border border-rose-200 bg-white px-4 text-sm font-bold text-rose-700 shadow-sm transition hover:bg-rose-50" data-users-reset-all data-action="{{ route('starter-kit.users.reset-data') }}">
            <i data-lucide="rotate-ccw" class="h-4 w-4"></i>
            Reset Data
        </button>
        <button type="button" class="inline-flex h-11 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700" data-user-create>
            <i data-lucide="user-plus" class="h-4 w-4"></i>
            Tambah User
        </button>
    </div>
@endsection

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
            <x-tailwind.stat-card label="Total User" :value="$totalUsers" icon="users" />
            <x-tailwind.stat-card label="Terverifikasi" :value="$verifiedUsers" icon="badge-check" />
            <x-tailwind.stat-card label="30 Hari Terakhir" :value="$newUsers" icon="calendar-days" />
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-lg">
            <div class="border-b border-slate-200 bg-gradient-to-r from-slate-50 via-white to-slate-50 px-6 py-5">
                <div class="flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 shadow-lg shadow-blue-500/30">
                        <i data-lucide="table-2" class="h-6 w-6 text-white"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Daftar User</h2>
                        <p class="text-sm text-slate-500">DataTables dengan pencarian, pagination, sorting, dan modal aksi.</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="usersTable" class="starter-datatable starter-users-table w-full border-collapse text-sm">
                    <thead>
                        <tr class="border-b-2 border-slate-200 bg-slate-50/80">
                            <th class="w-20 whitespace-nowrap px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-600">
                                <div class="flex items-center justify-center gap-1.5">
                                    <i data-lucide="hash" class="h-3.5 w-3.5"></i>
                                    <span>No</span>
                                </div>
                            </th>
                            <th class="min-w-[240px] whitespace-nowrap px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-600">
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="user" class="h-3.5 w-3.5"></i>
                                    <span>Nama</span>
                                </div>
                            </th>
                            <th class="min-w-[260px] whitespace-nowrap px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-slate-600">
                                <div class="flex items-center gap-1.5">
                                    <i data-lucide="mail" class="h-3.5 w-3.5"></i>
                                    <span>Email</span>
                                </div>
                            </th>
                            <th class="w-40 whitespace-nowrap px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-600">
                                <div class="flex items-center justify-center gap-1.5">
                                    <i data-lucide="shield-check" class="h-3.5 w-3.5"></i>
                                    <span>Verifikasi</span>
                                </div>
                            </th>
                            <th class="w-44 whitespace-nowrap px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-slate-600">
                                <div class="flex items-center justify-center gap-1.5">
                                    <i data-lucide="settings" class="h-3.5 w-3.5"></i>
                                    <span>Aksi</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($users as $user)
                            <tr class="group transition-all duration-200 hover:bg-gradient-to-r hover:from-blue-50/50 hover:via-blue-50/30 hover:to-transparent">
                                <td class="whitespace-nowrap px-6 py-5 text-center">
                                    <div class="flex items-center justify-center">
                                        <span data-row-number class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-slate-100 to-slate-200 text-xs font-bold text-slate-700 shadow-sm ring-1 ring-slate-300/50 transition-all group-hover:from-blue-100 group-hover:to-blue-200 group-hover:text-blue-700 group-hover:ring-blue-300/50">
                                            {{ $loop->iteration }}
                                        </span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-5">
                                    <div class="flex items-center gap-3.5">
                                        <div class="relative">
                                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-gradient-to-br from-blue-500 via-blue-600 to-blue-700 text-sm font-bold text-white shadow-lg shadow-blue-500/40 ring-2 ring-white transition-transform group-hover:scale-110">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div class="absolute -bottom-0.5 -right-0.5 h-3.5 w-3.5 rounded-full border-2 border-white {{ $user->email_verified_at ? 'bg-emerald-500' : 'bg-slate-400' }} shadow-sm"></div>
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-semibold text-slate-900 transition-colors group-hover:text-blue-700">{{ $user->name }}</span>
                                            <span class="text-xs text-slate-500">Akun pengguna</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2.5">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 text-slate-500 transition-colors group-hover:bg-blue-100 group-hover:text-blue-600">
                                            <i data-lucide="mail" class="h-4 w-4"></i>
                                        </div>
                                        <span class="font-medium text-slate-700 transition-colors group-hover:text-slate-900">{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-5 text-center">
                                    @if ($user->email_verified_at)
                                        <span class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-emerald-50 to-emerald-100 px-3.5 py-2 text-xs font-bold text-emerald-700 shadow-sm ring-1 ring-emerald-200/50">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Terverifikasi</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-amber-50 to-amber-100 px-3.5 py-2 text-xs font-bold text-amber-700 shadow-sm ring-1 ring-amber-200/50">
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Menunggu</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-6 py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            type="button"
                                            class="group/btn relative inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-md shadow-blue-500/30 transition-all duration-200 hover:scale-110 hover:shadow-lg hover:shadow-blue-500/40 active:scale-95"
                                            data-user-reset
                                            data-action="{{ route('starter-kit.users.reset-password', $user) }}"
                                            data-name="{{ $user->name }}"
                                            title="Reset password"
                                        >
                                            <i data-lucide="key-round" class="relative z-10 h-4 w-4"></i>
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-blue-500 opacity-0 transition-opacity group-hover/btn:opacity-100"></div>
                                        </button>
                                        <button
                                            type="button"
                                            class="group/btn relative inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-amber-500 to-amber-600 text-white shadow-md shadow-amber-500/30 transition-all duration-200 hover:scale-110 hover:shadow-lg hover:shadow-amber-500/40 active:scale-95"
                                            data-user-edit
                                            data-action="{{ route('starter-kit.users.update', $user) }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            data-verified="{{ $user->email_verified_at ? '1' : '0' }}"
                                            title="Edit user"
                                        >
                                            <i data-lucide="pencil" class="relative z-10 h-4 w-4"></i>
                                            <div class="absolute inset-0 bg-gradient-to-br from-amber-400 to-amber-500 opacity-0 transition-opacity group-hover/btn:opacity-100"></div>
                                        </button>
                                        <button
                                            type="button"
                                            class="group/btn relative inline-flex h-9 w-9 items-center justify-center overflow-hidden rounded-lg bg-gradient-to-br from-rose-500 to-rose-600 text-white shadow-md shadow-rose-500/30 transition-all duration-200 hover:scale-110 hover:shadow-lg hover:shadow-rose-500/40 active:scale-95"
                                            data-user-delete
                                            data-action="{{ route('starter-kit.users.destroy', $user) }}"
                                            data-name="{{ $user->name }}"
                                            data-email="{{ $user->email }}"
                                            title="Delete user"
                                        >
                                            <i data-lucide="trash-2" class="relative z-10 h-4 w-4"></i>
                                            <div class="absolute inset-0 bg-gradient-to-br from-rose-400 to-rose-500 opacity-0 transition-opacity group-hover/btn:opacity-100"></div>
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

    <div id="createUserModal" class="fixed inset-0 z-50 hidden" data-starter-modal>
        <div class="absolute inset-0 bg-slate-950/55 opacity-0 backdrop-blur-sm transition-opacity duration-150" data-starter-modal-backdrop></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div class="w-full max-w-2xl translate-y-2 scale-95 rounded-lg border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-150" data-starter-modal-panel>
                <form id="createUserForm" method="POST" action="{{ route('starter-kit.users.store') }}">
                    @csrf

                    <div class="flex items-start justify-between gap-4 border-b border-slate-200 bg-gradient-to-r from-blue-50 via-white to-white p-5">
                        <div class="flex items-start gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                                <i data-lucide="user-plus" class="h-5 w-5"></i>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-slate-950">Tambah User</h3>
                                <p class="mt-1 text-sm text-slate-500">Buat akun pengguna baru dengan password awal.</p>
                            </div>
                        </div>
                        <button type="button" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700" data-starter-modal-close>
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="grid gap-4 p-5 md:grid-cols-2">
                        <label class="block md:col-span-2">
                            <span class="text-sm font-semibold text-slate-700">Nama</span>
                            <input name="name" type="text" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="block md:col-span-2">
                            <span class="text-sm font-semibold text-slate-700">Email</span>
                            <input name="email" type="email" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Password</span>
                            <input name="password" type="password" value="password" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Confirm password</span>
                            <input name="password_confirmation" type="password" value="password" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="flex items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 p-3 md:col-span-2">
                            <input name="email_verified" value="1" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>
                                <span class="block text-sm font-semibold text-slate-800">Email terverifikasi</span>
                                <span class="block text-xs text-slate-500">Centang jika email user sudah diverifikasi.</span>
                            </span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 p-4">
                        <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Batal</button>
                        <button type="submit" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 hover:bg-blue-700">
                            <i data-lucide="save" class="h-4 w-4"></i>
                            Simpan User
                        </button>
                    </div>
                </form>
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
                            <span class="text-sm font-semibold text-slate-700">Nama</span>
                            <input id="editUserName" name="name" type="text" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Email</span>
                            <input id="editUserEmail" name="email" type="email" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="flex items-center gap-3 rounded-lg border border-slate-200 bg-slate-50 p-3">
                            <input id="editUserVerified" name="email_verified" value="1" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                            <span>
                                <span class="block text-sm font-semibold text-slate-800">Email terverifikasi</span>
                                <span class="block text-xs text-slate-500">Centang untuk menandai email user sudah terverifikasi.</span>
                            </span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 p-4">
                        <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Batal</button>
                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-blue-600 px-4 text-sm font-semibold text-white shadow-sm shadow-blue-600/20 hover:bg-blue-700">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="resetUserModal" class="fixed inset-0 z-50 hidden" data-starter-modal>
        <div class="absolute inset-0 bg-slate-950/55 opacity-0 backdrop-blur-sm transition-opacity duration-150" data-starter-modal-backdrop></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div class="w-full max-w-lg translate-y-2 scale-95 rounded-lg border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-150" data-starter-modal-panel>
                <form id="resetPasswordForm" method="POST">
                    @csrf

                    <div class="flex items-start justify-between gap-4 border-b border-slate-200 bg-gradient-to-r from-blue-50 via-white to-white p-5">
                        <div class="flex items-start gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-600/20">
                                <i data-lucide="key-round" class="h-5 w-5"></i>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-slate-950">Reset Password</h3>
                                <p class="mt-1 text-sm text-slate-500">Atur password baru untuk user yang dipilih.</p>
                            </div>
                        </div>
                        <button type="button" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700" data-starter-modal-close>
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="space-y-4 p-5">
                        <div class="flex items-center gap-3 rounded-lg border border-blue-100 bg-blue-50 p-3">
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-white text-blue-700 shadow-sm">
                                <i data-lucide="user-round" class="h-4 w-4"></i>
                            </span>
                            <div>
                                <div class="text-xs font-semibold uppercase text-blue-700">User Tujuan</div>
                                <div id="resetUserName" class="mt-0.5 text-sm font-bold text-slate-900"></div>
                            </div>
                        </div>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Password baru</span>
                            <input id="resetPassword" name="password" type="password" value="password" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <label class="block">
                            <span class="text-sm font-semibold text-slate-700">Konfirmasi password</span>
                            <input id="resetPasswordConfirmation" name="password_confirmation" type="password" value="password" class="mt-1 h-11 w-full rounded-lg border border-slate-200 px-3 text-sm outline-none focus:border-blue-400 focus:ring-4 focus:ring-blue-100" required>
                        </label>

                        <div class="rounded-lg border border-blue-100 bg-blue-50 p-3 text-sm text-blue-800">
                            Password minimal 8 karakter. Default starter kit adalah <span class="font-semibold">password</span>.
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 p-4">
                        <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Batal</button>
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
                                <h3 class="text-base font-bold text-slate-950">Hapus User</h3>
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
                        <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Batal</button>
                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-rose-600 px-4 text-sm font-semibold text-white shadow-sm shadow-rose-600/20 hover:bg-rose-700">Hapus User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="resetAllUsersModal" class="fixed inset-0 z-50 hidden" data-starter-modal>
        <div class="absolute inset-0 bg-slate-950/55 opacity-0 backdrop-blur-sm transition-opacity duration-150" data-starter-modal-backdrop></div>
        <div class="relative flex min-h-full items-center justify-center p-4">
            <div class="w-full max-w-md translate-y-2 scale-95 rounded-lg border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-150" data-starter-modal-panel>
                <form id="resetAllUsersForm" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="flex items-start justify-between gap-4 border-b border-slate-200 bg-gradient-to-r from-rose-50 via-white to-white p-5">
                        <div class="flex items-start gap-3">
                            <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-50 text-rose-700">
                                <i data-lucide="rotate-ccw" class="h-5 w-5"></i>
                            </span>
                            <div>
                                <h3 class="text-base font-bold text-slate-950">Reset Data User</h3>
                                <p class="mt-1 text-sm text-slate-500">Aksi ini akan menghapus semua data user.</p>
                            </div>
                        </div>
                        <button type="button" class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-700" data-starter-modal-close>
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>

                    <div class="space-y-4 p-5">
                        <div class="rounded-lg border border-rose-100 bg-rose-50 p-4 text-sm text-rose-800">
                            Semua record pada tabel users akan dihapus. Proses ini tidak dapat dibatalkan dari starter kit.
                        </div>
                        <div class="rounded-lg border border-slate-200 bg-slate-50 p-3 text-sm text-slate-600">
                            Total data saat ini: <span class="font-bold text-slate-900">{{ $totalUsers }}</span> user.
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 border-t border-slate-200 bg-slate-50 p-4">
                        <button type="button" class="inline-flex h-10 items-center justify-center rounded-lg border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-700 hover:bg-slate-100" data-starter-modal-close>Batal</button>
                        <button type="submit" class="inline-flex h-10 items-center justify-center rounded-lg bg-rose-600 px-4 text-sm font-semibold text-white shadow-sm shadow-rose-600/20 hover:bg-rose-700">Hapus Semua</button>
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
                const createButton = event.target.closest('[data-user-create]');
                const editButton = event.target.closest('[data-user-edit]');
                const resetButton = event.target.closest('[data-user-reset]');
                const deleteButton = event.target.closest('[data-user-delete]');
                const resetAllButton = event.target.closest('[data-users-reset-all]');

                if (createButton) {
                    document.getElementById('createUserForm').reset();
                    window.StarterKit.openModal('createUserModal');
                }

                if (resetAllButton) {
                    document.getElementById('resetAllUsersForm').action = resetAllButton.dataset.action;
                    window.StarterKit.openModal('resetAllUsersModal');
                }

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
