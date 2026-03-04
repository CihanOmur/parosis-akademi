@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('menu-items.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Yeni Menu Ogesi</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Navigasyon menusune yeni bir oge ekleyin</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('menu-items.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Menu Ogesi Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Varsayilan dilde etiket ve baglanti bilgilerini girin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <x-text-input name="label" label="Etiket" placeholder="Ornegin: Ana Sayfa, Hakkimizda..." required />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-text-input name="url" label="URL" placeholder="/ veya /hakkimizda veya https://..." required />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Target --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Hedef</label>
                        <select name="target"
                                class="w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500/60 focus:border-transparent outline-none transition-all">
                            <option value="_self" {{ old('target') === '_blank' ? '' : 'selected' }}>Ayni Pencere (_self)</option>
                            <option value="_blank" {{ old('target') === '_blank' ? 'selected' : '' }}>Yeni Pencere (_blank)</option>
                        </select>
                        @error('target')
                            <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Ust Menu --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Ust Menu</label>
                        <select name="parent_id"
                                class="w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500/60 focus:border-transparent outline-none transition-all">
                            <option value="">- Ana Menu Ogesi (Ust seviye) -</option>
                            @foreach($parentItems as $parent)
                                <option value="{{ $parent->id }}" {{ (int) old('parent_id') === $parent->id ? 'selected' : '' }}>
                                    {{ $parent->label }}
                                </option>
                                @foreach($parent->children as $child)
                                    <option value="{{ $child->id }}" {{ (int) old('parent_id') === $child->id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;&nbsp;&nbsp;-- {{ $child->label }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('parent_id')
                            <p class="mt-1.5 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Sag kolon --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Aksiyonlar --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5 space-y-3">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                               bg-gradient-to-r from-fuchsia-500 to-purple-600
                               hover:from-fuchsia-600 hover:to-purple-700
                               text-white font-semibold text-sm rounded-xl
                               shadow-lg shadow-fuchsia-500/25
                               transition-all duration-200 active:scale-[.98] cursor-pointer">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Kaydet
                </button>
                <a href="{{ route('menu-items.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Iptal
                </a>
            </div>

            {{-- Ipucu --}}
            <div class="bg-amber-50 dark:bg-amber-900/10 border border-amber-200/60 dark:border-amber-800/30 rounded-2xl p-4">
                <div class="flex gap-3">
                    <svg class="w-4.5 h-4.5 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd"/>
                    </svg>
                    <div class="space-y-1.5">
                        <p class="text-xs font-semibold text-amber-800 dark:text-amber-400">Bilgi</p>
                        <p class="text-xs text-amber-700 dark:text-amber-500">
                            Etiket varsayilan dilde kaydedilir. Diger dillerdeki cevirilerini duzenleme sayfasindan ekleyebilirsiniz. Ust menu secerseniz bu oge alt menu ogesi olarak eklenir.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
