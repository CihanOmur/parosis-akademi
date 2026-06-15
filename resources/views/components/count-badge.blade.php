@props([
    'count'  => 0,
    'label'  => '',
    'href'   => null,
    'color'  => 'fuchsia',
    'title'  => null,
    'size'   => 'md',
])

@php
    $palette = [
        'fuchsia' => 'bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400 hover:bg-fuchsia-200 dark:hover:bg-fuchsia-900/50',
        'blue'    => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-900/50',
        'emerald' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 hover:bg-emerald-200 dark:hover:bg-emerald-900/50',
        'amber'   => 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 hover:bg-amber-200 dark:hover:bg-amber-900/50',
        'red'     => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50',
        'slate'   => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600',
    ];

    $sizeMap = [
        'sm' => 'px-2 py-0.5 text-[10px] gap-1',
        'md' => 'px-3 py-1 text-xs gap-1.5',
        'lg' => 'px-3.5 py-1.5 text-sm gap-2',
    ];

    $iconSizeMap = [
        'sm' => 'w-3 h-3',
        'md' => 'w-3.5 h-3.5',
        'lg' => 'w-4 h-4',
    ];

    $colorClass = $palette[$color] ?? $palette['fuchsia'];
    $sizeClass  = $sizeMap[$size] ?? $sizeMap['md'];
    $iconClass  = $iconSizeMap[$size] ?? $iconSizeMap['md'];

    $tag = $href ? 'a' : 'span';
    $base = "inline-flex items-center justify-center rounded-full font-semibold whitespace-nowrap leading-none transition-all {$sizeClass} {$colorClass}";
@endphp

<{{ $tag }}
    @if($href) href="{{ $href }}" @endif
    @if($title) title="{{ $title }}" @endif
    {{ $attributes->merge(['class' => $base]) }}>
    @if(! $slot->isEmpty())
        <span class="flex-shrink-0 {{ $iconClass }} [&>svg]:w-full [&>svg]:h-full">{{ $slot }}</span>
    @endif
    <span>{{ $count }}{{ $label ? ' ' . $label : '' }}</span>
</{{ $tag }}>
