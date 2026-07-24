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

    {{-- Kebap: Duzenle / Ceviriler / Sil --}}
    <x-action-menu>
        <a href="{{ route('menu-items.edit', $item->id) }}" class="am-item">
            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/></svg>
            Duzenle
        </a>
        @foreach ($activeLanguages as $activeLang)
            <a href="{{ route('menu-items.editTranslate', ['id' => $item->id, 'lang' => $activeLang->locale]) }}" class="am-item">
                <span class="w-4 h-4 rounded flex items-center justify-center text-[9px] font-bold bg-slate-100 dark:bg-slate-700 text-slate-500">{{ strtoupper(substr($activeLang->locale, 0, 2)) }}</span>
                {{ $activeLang->name ?: $activeLang->locale }}
            </a>
        @endforeach
        <div class="am-divider"></div>
        <form action="{{ route('menu-items.delete', $item->id) }}" method="POST"
              x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Menu Ogesini Sil', message: 'Bu menu ogesini silmek istediginize emin misiniz?{{ $item->children->count() ? " Alt ogeleri de silinecektir." : "" }}', form: $el })" class="am-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="am-item am-danger">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                Sil
            </button>
        </form>
    </x-action-menu>
</div>