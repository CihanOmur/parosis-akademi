@props([
    'title' => 'Eşleşme Hatası',
    'message' => '- Ödeme tutarı <br/> - Ödenecek Tutar  <br/> Eşleşmiyor lütfen kontrol ediniz!',
    'confirmButtonText' => 'Kapat',
])

<div id="payment-alert-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[70] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white dark:bg-slate-800 rounded-2xl
                    shadow-[0_25px_60px_-12px_rgba(0,0,0,0.3)] dark:shadow-[0_25px_60px_-12px_rgba(0,0,0,0.6)]
                    border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">

            <div class="px-7 pt-8 pb-5 text-center">
                {{-- İkon --}}
                <div class="mx-auto w-16 h-16 rounded-2xl
                            bg-gradient-to-br from-red-50 to-red-100/80
                            dark:from-red-500/10 dark:to-red-500/5
                            flex items-center justify-center mb-5
                            ring-1 ring-red-200/60 dark:ring-red-500/20">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                    </svg>
                </div>

                <h3 class="text-lg font-bold text-slate-900 dark:text-white tracking-tight">{{ $title }}</h3>
                <p class="mt-2.5 text-[13px] leading-relaxed text-slate-500 dark:text-slate-400">{!! $message !!}</p>
            </div>

            <div class="px-7 pb-7 flex justify-center">
                <button type="button" data-modal-hide="payment-alert-modal"
                        class="px-8 py-3 text-sm font-semibold text-white rounded-xl
                               bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700
                               shadow-lg shadow-red-500/25 transition-all duration-200
                               cursor-pointer active:scale-[0.97]">
                    {{ $confirmButtonText }}
                </button>
            </div>
        </div>
    </div>
</div>
