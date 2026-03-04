<div class="flex items-center gap-0.5 flex-shrink-0">
    {{-- Outdent (disari tasi) - sadece alt seviyeler --}}
    @if($level > 0)
        <button type="button" class="btn-outdent p-1.5 text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-all cursor-pointer" data-id="{{ $item->id }}" title="Disari tasi">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
            </svg>
        </button>
    @endif

    {{-- Indent (iceri tasi) - seviye 0 ve 1 --}}
    @if($level < 2)
        <button type="button" class="btn-indent p-1.5 text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-lg transition-all cursor-pointer" data-id="{{ $item->id }}" title="Iceri tasi">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"/>
            </svg>
        </button>
    @endif

    {{-- Toggle --}}
    <label class="inline-flex items-center cursor-pointer p-1.5">
        <div class="relative">
            <input type="checkbox" class="sr-only peer status-toggle" data-id="{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
            <div class="w-9 h-5 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full transition-colors duration-200"></div>
        </div>
    </label>

    {{-- Edit --}}
    <a href="{{ route('menu-items.edit', $item->id) }}"
       class="p-1.5 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all" title="Duzenle">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
        </svg>
    </a>

    {{-- Ceviriler --}}
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" type="button"
                class="p-1.5 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all cursor-pointer" title="Ceviriler">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
            </svg>
        </button>
        <div x-show="open" @click.away="open = false"
             x-transition:enter="transition ease-out duration-100"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute right-0 mt-1 w-44 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
            @foreach ($activeLanguages as $activeLang)
                <a href="{{ route('menu-items.editTranslate', ['id' => $item->id, 'lang' => $activeLang->locale]) }}"
                   class="flex items-center gap-2 px-3 py-2 text-sm font-medium
                          text-slate-600 dark:text-slate-300
                          hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                          hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                          transition-all">
                    <span class="w-5 h-5 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[9px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                        {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                    </span>
                    {{ $activeLang->name ?: $activeLang->locale }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Delete --}}
    <form action="{{ route('menu-items.delete', $item->id) }}" method="POST"
          x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Menu Ogesini Sil', message: 'Bu menu ogesini silmek istediginize emin misiniz?{{ $item->children->count() ? " Alt ogeleri de silinecektir." : "" }}', form: $el })">
        @csrf
        @method('DELETE')
        <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer" title="Sil">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
            </svg>
        </button>
    </form>
</div>
