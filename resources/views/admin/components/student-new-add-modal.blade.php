<div id="select-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-xl
                    border border-slate-200/50 dark:border-slate-700/50">

            {{-- Header --}}
            <div class="flex items-center justify-between p-5 border-b border-slate-100 dark:border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600
                                flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Kurs Kayıt</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500">Kayıt türü seçin</p>
                    </div>
                </div>
                <button type="button"
                        class="w-8 h-8 flex items-center justify-center rounded-lg
                               text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                               hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors cursor-pointer"
                        data-modal-toggle="select-modal">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="p-5 space-y-2.5">
                <a href="{{ route('students.pre.createPreRegistiration') }}"
                   class="flex items-center gap-4 p-4 rounded-xl
                          bg-slate-50 dark:bg-slate-700/40
                          border border-slate-200/60 dark:border-slate-600/50
                          hover:bg-amber-50 dark:hover:bg-amber-900/20
                          hover:border-amber-300 dark:hover:border-amber-600
                          transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600
                                flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Ön Kayıt</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Toplam {{ $preCount ?? 0 }} kayıt bulunmaktadır</p>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>

                <a href="{{ route('students.create') }}"
                   class="flex items-center gap-4 p-4 rounded-xl
                          bg-slate-50 dark:bg-slate-700/40
                          border border-slate-200/60 dark:border-slate-600/50
                          hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                          hover:border-fuchsia-300 dark:hover:border-fuchsia-600
                          transition-all duration-200">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600
                                flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Kesin Kayıt</p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Toplam {{ $normalCount ?? 0 }} kayıt bulunmaktadır</p>
                    </div>
                    <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
