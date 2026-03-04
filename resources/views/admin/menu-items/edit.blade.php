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
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Menu Ogesi Duzenle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Menu ogesini duzenleyin</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('menu-items.update', $menuItem->id) }}" method="POST">
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
                        <p class="text-xs text-slate-400 mt-0.5">Varsayilan dilde etiket ve baglanti bilgilerini duzenleyin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <x-text-input name="label" label="Etiket" placeholder="Ornegin: Ana Sayfa, Hakkimizda..." :value="$menuItem->label" required />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-text-input name="url" label="URL" placeholder="/ veya /hakkimizda veya https://..." :value="$menuItem->url" required />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Target --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Hedef</label>
                        <select name="target"
                                class="w-full px-4 py-3 bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600 rounded-xl text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-fuchsia-500/60 focus:border-transparent outline-none transition-all">
                            <option value="_self" {{ (old('target', $menuItem->target)) === '_blank' ? '' : 'selected' }}>Ayni Pencere (_self)</option>
                            <option value="_blank" {{ (old('target', $menuItem->target)) === '_blank' ? 'selected' : '' }}>Yeni Pencere (_blank)</option>
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
                                <option value="{{ $parent->id }}" {{ (int) old('parent_id', $menuItem->parent_id) === $parent->id ? 'selected' : '' }}>
                                    {{ $parent->label }}
                                </option>
                                @foreach($parent->children as $child)
                                    <option value="{{ $child->id }}" {{ (int) old('parent_id', $menuItem->parent_id) === $child->id ? 'selected' : '' }}>
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
                    Guncelle
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

            {{-- Ceviriler --}}
            @if ($activeLanguages->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Ceviriler</h3>
                <div class="space-y-2">
                    @foreach ($activeLanguages as $activeLang)
                        <a href="{{ route('menu-items.editTranslate', ['id' => $menuItem->id, 'lang' => $activeLang->locale]) }}"
                           class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium rounded-xl
                                  text-slate-600 dark:text-slate-300
                                  hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                  hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                  transition-all">
                            <span class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                            </span>
                            {{ $activeLang->name ?: $activeLang->locale }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</form>
@endsection
