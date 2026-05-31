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

<details class="starter-sidebar-details group/user rounded-lg border border-white/10 bg-white/[.04] p-1 shadow-sm shadow-blue-950/10" @if ($userActive) open @endif>
    <summary class="relative flex cursor-pointer list-none items-center gap-3 rounded-lg px-2.5 py-2.5 text-sm transition [&::-webkit-details-marker]:hidden {{ $userActive ? 'bg-white text-blue-800 shadow-lg shadow-blue-950/10' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}">
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

        <span class="hidden rounded-full px-2 py-0.5 text-[11px] font-bold sm:inline-flex {{ $userActive ? 'bg-blue-50 text-blue-700' : 'bg-white/10 text-blue-100' }}">2</span>
        <i data-lucide="chevron-down" class="starter-sidebar-chevron h-4 w-4 transition-transform duration-200 {{ $userActive ? 'text-blue-500' : 'text-blue-200' }}"></i>
    </summary>

    <div class="ml-5 mt-2 space-y-1 border-l border-white/15 pb-1 pl-4">
        <a href="{{ url('/users') }}" class="group/sub flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-semibold transition {{ $userActive ? 'bg-white/10 text-white ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/10 hover:text-white' }}">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg {{ $userActive ? 'bg-blue-500 text-white' : 'bg-white/10 text-blue-100 group-hover/sub:bg-white/15' }}">
                <i data-lucide="table-2" class="h-3.5 w-3.5"></i>
            </span>
            <span class="min-w-0 flex-1">
                <span class="block truncate">Daftar User</span>
                <span class="block truncate text-[11px] font-medium {{ $userActive ? 'text-blue-100' : 'text-blue-200' }}">Data pengguna</span>
            </span>
        </a>
        <button type="button" class="group/sub flex w-full items-center gap-2 rounded-lg px-3 py-2 text-left text-sm font-semibold text-blue-100 transition hover:bg-white/10 hover:text-white">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-white/10 text-blue-100 group-hover/sub:bg-white/15">
                <i data-lucide="user-plus" class="h-3.5 w-3.5"></i>
            </span>
            <span class="min-w-0 flex-1">
                <span class="block truncate">Tambah User</span>
                <span class="block truncate text-[11px] font-medium text-blue-200">Tampilan menu</span>
            </span>
        </button>
    </div>
</details>
