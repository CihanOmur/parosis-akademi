@props(['align' => 'right'])
{{-- Kebab (3-nokta) dropdown menu — action column icin
    Kullanim:
    <x-action-menu>
        <x-slot:items>
            <a href="..." class="am-item">Duzenle</a>
            <form action="..." method="POST" onsubmit="return confirm('?')" class="am-form">
                @csrf @method('DELETE')
                <button type="submit" class="am-item am-danger">Sil</button>
            </form>
        </x-slot:items>
    </x-action-menu>
--}}
<div x-data="{ open: false }" @click.outside="open = false" @keydown.escape="open = false" class="relative inline-block">
    <button type="button" @click="open = !open"
            class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-700 dark:hover:text-slate-200 transition-colors"
            :class="{ 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200': open }"
            aria-label="İşlemler">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z"/>
        </svg>
    </button>

    <div x-show="open" x-cloak
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @class([
            'absolute z-50 mt-1 w-44 rounded-lg bg-white dark:bg-slate-800 shadow-lg ring-1 ring-black/5 dark:ring-white/10 py-1',
            'right-0' => $align === 'right',
            'left-0' => $align === 'left',
         ])
         @click="open = false">
        {{ $items ?? $slot }}
    </div>
</div>

