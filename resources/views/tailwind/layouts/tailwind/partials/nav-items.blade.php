@php
    $dashboardActive = request()->path() === '/';
    $userActive = request()->routeIs('starter-kit.users.*') || request()->is('users*');
@endphp

<a href="{{ url('/') }}" class="group relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition {{ $dashboardActive ? 'bg-white text-blue-800 shadow-lg shadow-blue-950/10' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}" @if ($dashboardActive) aria-current="page" @endif>
    @if ($dashboardActive)
        <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-blue-600"></span>
    @endif

    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition {{ $dashboardActive ? 'bg-blue-50 text-blue-700' : 'bg-white/10 text-blue-100 group-hover:bg-white/15 group-hover:text-white' }}">
        <i data-lucide="gauge" class="h-4 w-4"></i>
    </span>

    <span class="min-w-0 flex-1">
        <span class="block truncate font-bold">Dashboard</span>
        <span class="block truncate text-xs {{ $dashboardActive ? 'text-blue-500' : 'text-blue-200 group-hover:text-blue-100' }}">Ringkasan</span>
    </span>

    @if ($dashboardActive)
        <i data-lucide="chevron-right" class="h-4 w-4 text-blue-500"></i>
    @endif
</a>

<details class="group/user" @if ($userActive) open @endif>
    <summary class="relative flex cursor-pointer list-none items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition [&::-webkit-details-marker]:hidden {{ $userActive ? 'bg-white text-blue-800 shadow-lg shadow-blue-950/10' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}">
        @if ($userActive)
            <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-blue-600"></span>
        @endif

        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition {{ $userActive ? 'bg-blue-50 text-blue-700' : 'bg-white/10 text-blue-100 group-hover/user:bg-white/15 group-hover/user:text-white' }}">
            <i data-lucide="users" class="h-4 w-4"></i>
        </span>

        <span class="min-w-0 flex-1">
            <span class="block truncate font-bold">User</span>
            <span class="block truncate text-xs {{ $userActive ? 'text-blue-500' : 'text-blue-200 group-hover/user:text-blue-100' }}">Manajemen</span>
        </span>

        <i data-lucide="chevron-down" class="h-4 w-4 {{ $userActive ? 'text-blue-500' : 'text-blue-200' }}"></i>
    </summary>

    <div class="mt-1 space-y-1 pl-12">
        <a href="{{ url('/users') }}" class="block rounded-lg px-3 py-2 text-sm font-semibold transition {{ $userActive ? 'bg-white/10 text-white' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            Daftar User
        </a>
        <button type="button" class="block w-full rounded-lg px-3 py-2 text-left text-sm font-semibold text-blue-100 transition hover:bg-white/10 hover:text-white">
            Tambah User
        </button>
    </div>
</details>
