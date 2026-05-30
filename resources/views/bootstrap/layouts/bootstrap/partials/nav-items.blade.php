@php
    $items = [
        ['label' => 'Dashboard', 'url' => url('/'), 'icon' => 'speedometer2', 'active' => request()->is('/')],
        ['label' => 'Users', 'url' => url('/users'), 'icon' => 'people', 'active' => request()->is('users')],
    ];
@endphp

@foreach ($items as $item)
    <a href="{{ $item['url'] }}" class="nav-link {{ $item['active'] ? 'active' : '' }}">
        <i class="bi bi-{{ $item['icon'] }}"></i>
        <span>{{ $item['label'] }}</span>
    </a>
@endforeach
