@if ($paginator->hasPages())
    <nav class="flex items-center justify-between px-6 py-4 border-t border-slate-100 dark:border-slate-700/50"
         role="navigation" aria-label="Pagination">

        {{-- Sayfa bilgisi --}}
        <div class="text-sm text-slate-500 dark:text-slate-400">
            <span class="font-medium text-slate-700 dark:text-slate-300">{{ $paginator->firstItem() }}</span>
            –
            <span class="font-medium text-slate-700 dark:text-slate-300">{{ $paginator->lastItem() }}</span>
            / toplam
            <span class="font-medium text-slate-700 dark:text-slate-300">{{ $paginator->total() }}</span>
            kayıt
        </div>

        {{-- Butonlar --}}
        <div class="flex items-center gap-1">

            {{-- Önceki --}}
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                             text-slate-300 dark:text-slate-600 cursor-not-allowed select-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                    </svg>
                    Önceki
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg
                          text-slate-600 dark:text-slate-300 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                          hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                    </svg>
                    Önceki
                </a>
            @endif

            {{-- Sayfa numaraları --}}
            <div class="flex items-center gap-1">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-2 py-2 text-sm text-slate-400 dark:text-slate-500 select-none">{{ $element }}</span>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="inline-flex items-center justify-center w-9 h-9 text-sm font-semibold rounded-lg
                                             bg-fuchsia-500 text-white shadow-sm shadow-fuchsia-500/25">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                   class="inline-flex items-center justify-center w-9 h-9 text-sm font-medium rounded-lg
                                          text-slate-600 dark:text-slate-300 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                          hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 transition-all">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Sonraki --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                   class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium rounded-lg
                          text-slate-600 dark:text-slate-300 hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                          hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 transition-all">
                    Sonraki
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
            @else
                <span class="inline-flex items-center gap-1.5 px-3 py-2 text-sm font-medium
                             text-slate-300 dark:text-slate-600 cursor-not-allowed select-none">
                    Sonraki
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </span>
            @endif

        </div>
    </nav>
@endif
