@php
    $items = [
        [
            'label' => 'Dashboard',
            'description' => 'Ringkasan',
            'url' => url('/'),
            'icon' => 'gauge',
            'active' => request()->path() === '/',
        ],
        [
            'label' => 'User',
            'description' => 'Manajemen',
            'url' => url('/users'),
            'icon' => 'users',
            'active' => request()->routeIs('starter-kit.users.*') || request()->is('users*'),
        ],
    ];
@endphp

@foreach ($items as $item)
    <a href="{{ $item['url'] }}" class="group relative flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm transition {{ $item['active'] ? 'bg-white text-blue-800 shadow-lg shadow-blue-950/10' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}" @if ($item['active']) aria-current="page" @endif>
        @if ($item['active'])
            <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full bg-blue-600"></span>
        @endif

        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg transition {{ $item['active'] ? 'bg-blue-50 text-blue-700' : 'bg-white/10 text-blue-100 group-hover:bg-white/15 group-hover:text-white' }}">
            <i data-lucide="{{ $item['icon'] }}" class="h-4 w-4"></i>
        </span>

        <span class="min-w-0 flex-1">
            <span class="block truncate font-bold">{{ $item['label'] }}</span>
            <span class="block truncate text-xs {{ $item['active'] ? 'text-blue-500' : 'text-blue-200 group-hover:text-blue-100' }}">{{ $item['description'] }}</span>
        </span>

        @if ($item['active'])
            <i data-lucide="chevron-right" class="h-4 w-4 text-blue-500"></i>
        @endif
    </a>
@endforeach
