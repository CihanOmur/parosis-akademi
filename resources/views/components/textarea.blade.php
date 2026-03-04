@props([
    'name',
    'label'       => null,
    'placeholder' => '',
    'value'       => null,
    'rows'        => 4,
    'required'    => false,
    'disabled'    => false,
    'ringColor'   => 'fuchsia',
    'inputClass'  => '',
])

@php
    $errorKey = str_replace('[]', '', $name);
    $resolvedValue = old($errorKey, $value);
    $hasError = $errors->has($errorKey);

    $ringMap = [
        'fuchsia' => 'focus:ring-fuchsia-500/60',
        'sky'     => 'focus:ring-sky-500/60',
        'blue'    => 'focus:ring-blue-500/60',
        'indigo'  => 'focus:ring-indigo-500/60',
        'amber'   => 'focus:ring-amber-500/60',
        'red'     => 'focus:ring-red-500/60',
        'emerald' => 'focus:ring-emerald-500/60',
        'violet'  => 'focus:ring-violet-500/60',
    ];
    $focusRing = $ringMap[$ringColor] ?? 'focus:ring-fuchsia-500/60';

    $ringClass = $hasError
        ? 'ring-2 ring-red-400 dark:ring-red-500 focus:ring-red-500/60'
        : "ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 {$focusRing}";

    $baseClass = "w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm "
               . "text-slate-900 dark:text-white placeholder-slate-400 "
               . "{$ringClass} transition-all resize-y";

    if ($disabled) $baseClass .= ' opacity-60 cursor-not-allowed';
    if ($inputClass) $baseClass .= ' ' . $inputClass;
@endphp

<div class="space-y-1">
    {{-- Label --}}
    @if($label)
        <label for="{{ $errorKey }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $errorKey }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        class="{{ $baseClass }}"
        {{ $disabled ? 'disabled' : '' }}
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >{{ $resolvedValue }}</textarea>

    {{-- Hata mesajı --}}
    @error($errorKey)
        <p class="text-sm text-red-500 flex items-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
            </svg>
            {{ $message }}
        </p>
    @enderror
</div>
