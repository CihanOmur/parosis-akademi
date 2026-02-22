{{--
    Language Tabs Component
    ========================
    Aktif diller arasında sekme tabanlı navigasyon sağlar.
    Translatable içerik formlarında kullanılır.

    Kullanım:
        @include('admin.components.language-tabs', ['selectedLang' => $selectedLang])

    Gereksinimler:
        - $activeLanguages → SharedDatas middleware tarafından otomatik paylaşılır
        - $selectedLang    → Controller'dan iletilir (getLocaleInfo($request->lang)['translateLang'])

    Nasıl Çalışır:
        1. Controller'da: $selectedLang = getLocaleInfo($request->get('lang'))['translateLang']
        2. Bu component'i forma dahil et
        3. Form alanlarını $selectedLang ile filtrele:
           - Sadece seçili dilin alanlarını göster
           - Input name: name[{{ $selectedLang }}]  veya  title[{{ $selectedLang }}]  vb.
        4. Sekmeye tıklamak URL'e ?lang=<locale> ekler, sayfa yenilenir
--}}

@if($activeLanguages->count() > 1)
    <div class="flex items-center gap-1 p-1 bg-slate-100 dark:bg-slate-700/50 rounded-xl overflow-x-auto">
        @foreach($activeLanguages as $lang)
            @php
                $isActive = ($selectedLang ?? '') === $lang->locale;
                $tabUrl   = request()->fullUrlWithQuery(['lang' => $lang->locale]);
            @endphp
            <a href="{{ $tabUrl }}"
               class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg text-sm font-medium transition-all duration-200 whitespace-nowrap flex-shrink-0
                      {{ $isActive
                          ? 'bg-white dark:bg-slate-800 text-fuchsia-600 dark:text-fuchsia-400 shadow-sm'
                          : 'text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:hover:text-slate-200 hover:bg-white/60 dark:hover:bg-slate-800/60' }}">
                <span class="w-6 h-6 rounded-md flex items-center justify-center text-xs font-bold
                             {{ $isActive
                                 ? 'bg-fuchsia-100 dark:bg-fuchsia-900/40 text-fuchsia-600 dark:text-fuchsia-400'
                                 : 'bg-slate-200 dark:bg-slate-600 text-slate-500 dark:text-slate-400' }}">
                    {{ strtoupper(substr($lang->locale, 0, 2)) }}
                </span>
                {{ $lang->name ?: $lang->locale }}
                @if($isActive)
                    <span class="w-1.5 h-1.5 rounded-full bg-fuchsia-500 ml-0.5"></span>
                @endif
            </a>
        @endforeach
    </div>

@elseif($activeLanguages->count() === 1)
    @php $onlyLang = $activeLanguages->first(); @endphp
    <div class="inline-flex items-center gap-2 px-3.5 py-2
                bg-fuchsia-50 dark:bg-fuchsia-900/20
                border border-fuchsia-200/60 dark:border-fuchsia-700/40
                rounded-xl text-sm font-medium">
        <span class="w-6 h-6 rounded-md bg-fuchsia-100 dark:bg-fuchsia-900/40 flex items-center justify-center
                     text-xs font-bold text-fuchsia-600 dark:text-fuchsia-400">
            {{ strtoupper(substr($onlyLang->locale, 0, 2)) }}
        </span>
        <span class="text-fuchsia-700 dark:text-fuchsia-300">{{ $onlyLang->name ?: $onlyLang->locale }}</span>
        <span class="w-1.5 h-1.5 rounded-full bg-fuchsia-500"></span>
    </div>

@else
    {{-- Henüz aktif dil tanımlanmamış --}}
    <div class="flex items-center gap-2 px-3.5 py-2 bg-amber-50 dark:bg-amber-900/20
                border border-amber-200/60 dark:border-amber-700/40 rounded-xl text-sm">
        <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126Z"/>
        </svg>
        <span class="text-amber-700 dark:text-amber-300">Aktif dil bulunamadı. Önce bir dil ekleyin.</span>
    </div>
@endif
