@props([
    'label',
    'value',
    'icon' => 'bar-chart',
])

<div {{ $attributes->class(['rounded-lg', 'border', 'border-zinc-200', 'bg-white', 'p-4', 'shadow-sm']) }}>
    <div class="flex items-center gap-3">
        <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-brand-500/10 text-brand-600">
            <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
        </div>
        <div>
            <div class="text-sm text-zinc-500">{{ $label }}</div>
            <div class="text-2xl font-semibold leading-none text-zinc-950">{{ $value }}</div>
        </div>
    </div>
</div>
