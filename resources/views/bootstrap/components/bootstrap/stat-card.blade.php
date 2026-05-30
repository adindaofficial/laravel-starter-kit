@props([
    'label',
    'value',
    'icon' => 'bar-chart',
    'tone' => 'primary',
])

<div {{ $attributes->class(['card', 'border-0', 'shadow-sm', 'h-100']) }}>
    <div class="card-body d-flex align-items-center gap-3">
        <div class="rounded bg-{{ $tone }} bg-opacity-10 text-{{ $tone }} d-inline-flex align-items-center justify-content-center" style="height: 2.75rem; width: 2.75rem;">
            <i class="bi bi-{{ $icon }} fs-4"></i>
        </div>
        <div>
            <div class="text-secondary small">{{ $label }}</div>
            <div class="fs-4 fw-semibold lh-1">{{ $value }}</div>
        </div>
    </div>
</div>
