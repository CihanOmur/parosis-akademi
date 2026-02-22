@push('modals')
<div id="actionbutton-modal-{{ $student->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[70] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white dark:bg-slate-800 rounded-2xl
                    shadow-[0_25px_60px_-12px_rgba(0,0,0,0.3)] dark:shadow-[0_25px_60px_-12px_rgba(0,0,0,0.6)]
                    border border-slate-200/50 dark:border-slate-700/50">

            {{-- Header --}}
            <div class="flex items-center justify-between p-5 border-b border-slate-100 dark:border-slate-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600
                                flex items-center justify-center">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">İşlemler</h3>
                        <p class="text-xs text-slate-400 dark:text-slate-500">{{ $student->full_name }}</p>
                    </div>
                </div>
                <button type="button"
                        class="w-8 h-8 flex items-center justify-center rounded-lg
                               text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                               hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors cursor-pointer"
                        data-modal-toggle="actionbutton-modal-{{ $student->id }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="p-5 space-y-2.5">

                @if ($student->registration_type == '2')
                    {{-- Kayıt Formu --}}
                    <form id="downloadRegistrationForm{{ $student->id }}"
                          action="{{ route('students.downloadRegistrationForm') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                    </form>
                    <button type="submit" form="downloadRegistrationForm{{ $student->id }}"
                            class="w-full flex items-center gap-4 p-4 rounded-xl
                                   bg-slate-50 dark:bg-slate-700/40
                                   border border-slate-200/60 dark:border-slate-600/50
                                   hover:bg-blue-50 dark:hover:bg-blue-900/20
                                   hover:border-blue-300 dark:hover:border-blue-600
                                   transition-all duration-200 cursor-pointer text-left">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600
                                    flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Kayıt Formu</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">PDF olarak indir</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                    </button>

                    {{-- Sözleşme --}}
                    <form id="downloadContract{{ $student->id }}"
                          action="{{ route('students.downloadContract') }}" method="POST" class="hidden">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                    </form>
                    <button type="submit" form="downloadContract{{ $student->id }}"
                            class="w-full flex items-center gap-4 p-4 rounded-xl
                                   bg-slate-50 dark:bg-slate-700/40
                                   border border-slate-200/60 dark:border-slate-600/50
                                   hover:bg-violet-50 dark:hover:bg-violet-900/20
                                   hover:border-violet-300 dark:hover:border-violet-600
                                   transition-all duration-200 cursor-pointer text-left">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600
                                    flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25Z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Sözleşme</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">PDF olarak indir</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                    </button>

                    {{-- Kayıt Yenile --}}
                    <a href="{{ route('students.reCreate', $student->id) }}"
                       class="flex items-center gap-4 p-4 rounded-xl
                              bg-slate-50 dark:bg-slate-700/40
                              border border-slate-200/60 dark:border-slate-600/50
                              hover:bg-emerald-50 dark:hover:bg-emerald-900/20
                              hover:border-emerald-300 dark:hover:border-emerald-600
                              transition-all duration-200">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600
                                    flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM4 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 10.374 21c-2.331 0-4.512-.645-6.374-1.766Z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Kayıt Yenile</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Yeni dönem kaydı oluştur</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>
                    </a>
                @endif

                @if ($student->registration_type == '1')
                    {{-- Kesin Kayıta Dönüştür --}}
                    <a href="{{ route('students.pre-to-normal', $student->id) }}"
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
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-200">Kesin Kayıta Dönüştür</p>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">Ön kaydı kesin kayıta çevir</p>
                        </div>
                        <svg class="w-4 h-4 text-slate-300 dark:text-slate-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>
                    </a>
                @endif

            </div>
        </div>
    </div>
</div>
@endpush
