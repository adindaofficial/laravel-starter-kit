@php
    $items = [
        ['label' => 'Dashboard', 'url' => url('/'), 'icon' => 'gauge', 'active' => request()->is('/')],
        ['label' => 'Users', 'url' => url('/users'), 'icon' => 'users', 'active' => request()->is('users')],
    ];
@endphp

@foreach ($items as $item)
    <a href="{{ $item['url'] }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold {{ $item['active'] ? 'bg-white text-blue-800 shadow-sm' : 'text-blue-50 hover:bg-white/10 hover:text-white' }}">
        <i data-lucide="{{ $item['icon'] }}" class="h-4 w-4"></i>
        <span>{{ $item['label'] }}</span>
    </a>
@endforeach
