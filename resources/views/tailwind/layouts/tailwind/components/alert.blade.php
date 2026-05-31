@php
    $type = $type ?? 'info';
    $title = $title ?? null;
    $content = $content ?? null;
    $html = $html ?? false;
    $class = $class ?? '';

    $styles = [
        'info' => ['wrap' => 'border-cyan-200 bg-cyan-50 text-cyan-950', 'icon' => 'info'],
        'success' => ['wrap' => 'border-emerald-200 bg-emerald-50 text-emerald-950', 'icon' => 'check-circle'],
        'warning' => ['wrap' => 'border-amber-200 bg-amber-50 text-amber-950', 'icon' => 'circle-alert'],
        'danger' => ['wrap' => 'border-rose-200 bg-rose-50 text-rose-950', 'icon' => 'triangle-alert'],
        'primary' => ['wrap' => 'border-blue-200 bg-blue-50 text-blue-950', 'icon' => 'info'],
    ];

    $style = $styles[$type] ?? $styles['info'];
@endphp

<div class="flex gap-3 rounded-lg border p-4 {{ $style['wrap'] }} {{ $class }}">
    <i data-lucide="{{ $style['icon'] }}" class="mt-0.5 h-5 w-5 shrink-0"></i>
    <div>
        @if ($title)
            <div class="font-semibold">{{ $title }}</div>
        @endif

        @if ($content)
            <div class="text-sm">
                @if ($html)
                    {!! $content !!}
                @else
                    {{ $content }}
                @endif
            </div>
        @endif
    </div>
</div>
