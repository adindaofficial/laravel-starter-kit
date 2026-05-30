@props([
    'label',
    'value',
    'icon' => 'bar-chart',
])

<div {{ $attributes->class(['rounded-lg', 'border', 'border-slate-200', 'bg-white', 'p-4', 'shadow-sm']) }}>
    <div class="flex items-center gap-3">
        <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-50 text-blue-700">
            <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
        </div>
        <div>
            <div class="text-sm text-slate-500">{{ $label }}</div>
            <div class="text-2xl font-semibold leading-none text-slate-950">{{ $value }}</div>
        </div>
    </div>
</div>
