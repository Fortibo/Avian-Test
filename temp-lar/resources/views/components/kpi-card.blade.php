@props([
'title' => '',
'value' => '',
'value_id' => null,
'color' => 'green',
])

@php

$colors = [
'green' => 'bg-green-600',
'blue' => 'bg-blue-600',
'emerald' => 'bg-emerald-600',
'amber' => 'bg-amber-500',
'cyan' => 'bg-cyan-600',
'rose' => 'bg-rose-600',
];

$iconColor = $colors[$color] ?? $colors['green'];
@endphp

<article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-sm font-medium text-gray-900">{{ $title }}</p>
            <p @if ($value_id) id="{{ $value_id }}" @endif class="mt-3 text-3xl font-bold text-slate-950">{{ $value }}</p>
        </div>
        <div class="flex h-12 w-12 items-center justify-center rounded-lg {{ $iconColor }} text-white shadow-sm">
            {{ $slot }}
        </div>
    </div>
</article>