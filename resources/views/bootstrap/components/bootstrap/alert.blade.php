@props([
    'type' => 'info',
    'title' => null,
])

@php
    $icons = [
        'primary' => 'info-circle',
        'success' => 'check-circle',
        'danger' => 'exclamation-triangle',
        'warning' => 'exclamation-circle',
        'info' => 'info-circle',
    ];

    $icon = $icons[$type] ?? $icons['info'];
@endphp

<div {{ $attributes->class(['alert', 'alert-'.$type, 'd-flex', 'gap-3', 'align-items-start']) }}>
    <i class="bi bi-{{ $icon }} fs-5"></i>
    <div>
        @if ($title)
            <div class="fw-semibold">{{ $title }}</div>
        @endif

        <div>{{ $slot }}</div>
    </div>
</div>
