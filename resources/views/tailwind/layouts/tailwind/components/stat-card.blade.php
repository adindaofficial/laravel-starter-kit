@php
    $label = $label ?? '';
    $value = $value ?? '0';
    $icon = $icon ?? 'bar-chart';
    $class = $class ?? '';
@endphp

<div class="group relative overflow-hidden rounded-lg border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-panel {{ $class }}">
    <div class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700"></div>
    <div class="absolute -right-8 -top-8 h-24 w-24 rounded-full bg-blue-50 transition group-hover:scale-110"></div>
    <div class="relative flex items-center gap-3">
        <div class="flex h-14 w-14 items-center justify-center rounded-lg bg-blue-50 text-blue-700 ring-1 ring-blue-100">
            <i data-lucide="{{ $icon }}" class="h-5 w-5"></i>
        </div>
        <div class="min-w-0">
            <div class="truncate text-sm font-medium text-slate-500">{{ $label }}</div>
            <div class="mt-1 text-2xl font-bold leading-none text-slate-950">{{ $value }}</div>
        </div>
    </div>
</div>
