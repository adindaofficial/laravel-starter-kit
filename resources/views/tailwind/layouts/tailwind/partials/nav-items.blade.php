@php
    $items = [
        ['label' => 'Dashboard', 'url' => url('/'), 'icon' => 'gauge', 'active' => request()->is('/')],
        ['label' => 'Users', 'url' => url('/users'), 'icon' => 'users', 'active' => request()->is('users')],
    ];
@endphp

@foreach ($items as $item)
    <a href="{{ $item['url'] }}" class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition {{ $item['active'] ? 'bg-white text-blue-800 shadow-sm' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}" @if ($item['active']) aria-current="page" @endif>
        <i data-lucide="{{ $item['icon'] }}" class="h-4 w-4"></i>
        <span class="flex-1">{{ $item['label'] }}</span>
        @if ($item['active'])
            <span class="h-2 w-2 rounded-full bg-blue-600"></span>
        @endif
    </a>
@endforeach
