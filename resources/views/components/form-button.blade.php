@props([
    'variant' => 'primary',   // primary | secondary | danger
    'type'    => 'submit',
    'href'    => null,
    'block'   => false,       // w-full kullan
    'icon'    => null,        // SVG <path d="..."/> stringi (opsiyonel)
])

@php
    $classes = trim('btn-themed btn-themed--' . $variant . ($block ? ' w-full' : ''));
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        @if ($icon)
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
            </svg>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        @if ($icon)
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $icon }}"/>
            </svg>
        @endif
        {{ $slot }}
    </button>
@endif
