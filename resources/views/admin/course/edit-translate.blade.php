@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('courses.edit', $course->id) }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kurs Çeviri</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                {{ $selectedLanguage->name ?? $selectedLang }} dilinde çeviri yapın
            </p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('courses.updateTranslate', $course->id) }}" method="POST">
    @csrf
    <input type="hidden" name="lang" value="{{ $selectedLang }}">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Orijinal içerik (readonly) --}}
            <div class="bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-6 pt-5 pb-3 border-b border-slate-200/50 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400">Orijinal (Varsayılan Dil)</h3>
                </div>
                <div class="p-6 space-y-3">
                    <div>
                        <span class="text-xs text-slate-400 uppercase">Başlık</span>
                        <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">{{ $course->getTranslation('title', app()->getLocale(), false) ?: '—' }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 uppercase">Kısa Açıklama</span>
                        <p class="text-sm text-slate-600 dark:text-slate-300 mt-1 whitespace-pre-line">{{ $course->getTranslation('short_description', app()->getLocale(), false) ?: '—' }}</p>
                    </div>
                    <div>
                        <span class="text-xs text-slate-400 uppercase">Kategoriler</span>
                        <p class="text-sm text-slate-600 dark:text-slate-300 mt-1">{{ $course->categories->pluck('name')->join(', ') ?: '—' }}</p>
                    </div>
                </div>
            </div>

            {{-- Çeviri alanları --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-50/60 via-transparent to-indigo-50/40 dark:from-blue-950/20 dark:to-indigo-950/10 pointer-events-none"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-md shadow-blue-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">
                            Çeviri: {{ $selectedLanguage->name ?? $selectedLang }}
                        </h3>
                        <p class="text-xs text-slate-400 mt-0.5">Kursun çevirisini yazın</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <x-text-input name="title" label="Başlık" placeholder="Başlığın çevirisini yazın..." :value="$course->getTranslation('title', $selectedLang, false)" ringColor="blue" required />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-textarea name="short_description" label="Kısa Açıklama" placeholder="Kısa açıklamanın çevirisini yazın..." rows="3" :value="$course->getTranslation('short_description', $selectedLang, false)" ringColor="blue" />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-textarea name="content" label="İçerik" placeholder="İçeriğin çevirisini yazın..." rows="10" :value="$course->getTranslation('content', $selectedLang, false)" ringColor="blue" />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Neler Öğreneceksiniz - Dinamik Liste --}}
                    <div class="space-y-2" x-data="listBuilder('what_you_learn', @js(old('what_you_learn', $course->getTranslation('what_you_learn', $selectedLang, false))))">
                        <input type="hidden" name="what_you_learn" :value="toHtml()">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                                    </svg>
                                    Neler Öğreneceksiniz
                                </span>
                            </label>
                            <button type="button" @click="addItem()"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold
                                           text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20
                                           hover:bg-blue-100 dark:hover:bg-blue-900/30
                                           rounded-lg transition-all cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                Madde Ekle
                            </button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="(item, index) in items" :key="index">
                                <div class="flex items-center gap-2 group">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-bold flex-shrink-0" x-text="index + 1"></div>
                                    <input type="text" x-model="items[index]"
                                           class="flex-1 px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                                  text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                                  ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-blue-500/60 transition-all"
                                           placeholder="Madde yazın...">
                                    <button type="button" @click="removeItem(index)"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg
                                                   text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20
                                                   opacity-0 group-hover:opacity-100 transition-all cursor-pointer flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <template x-if="items.length === 0">
                            <div class="flex items-center justify-center gap-2 py-6 text-sm text-slate-400 dark:text-slate-500 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                Madde eklemek için yukarıdaki butonu kullanın
                            </div>
                        </template>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Neden Bu Kurs - Dinamik Liste --}}
                    <div class="space-y-2" x-data="listBuilder('why_choose', @js(old('why_choose', $course->getTranslation('why_choose', $selectedLang, false))))">
                        <input type="hidden" name="why_choose" :value="toHtml()">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                    </svg>
                                    Neden Bu Kurs
                                </span>
                            </label>
                            <button type="button" @click="addItem()"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold
                                           text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/20
                                           hover:bg-indigo-100 dark:hover:bg-indigo-900/30
                                           rounded-lg transition-all cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                Madde Ekle
                            </button>
                        </div>
                        <div class="space-y-2">
                            <template x-for="(item, index) in items" :key="index">
                                <div class="flex items-center gap-2 group">
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-bold flex-shrink-0" x-text="index + 1"></div>
                                    <input type="text" x-model="items[index]"
                                           class="flex-1 px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                                  text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                                  ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-indigo-500/60 transition-all"
                                           placeholder="Madde yazın...">
                                    <button type="button" @click="removeItem(index)"
                                            class="w-8 h-8 flex items-center justify-center rounded-lg
                                                   text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20
                                                   opacity-0 group-hover:opacity-100 transition-all cursor-pointer flex-shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <template x-if="items.length === 0">
                            <div class="flex items-center justify-center gap-2 py-6 text-sm text-slate-400 dark:text-slate-500 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                </svg>
                                Madde eklemek için yukarıdaki butonu kullanın
                            </div>
                        </template>
                    </div>

                </div>
            </div>
        </div>

        {{-- Sağ kolon --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Aksiyonlar --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5 space-y-3">
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                               bg-gradient-to-r from-blue-500 to-indigo-600
                               hover:from-blue-600 hover:to-indigo-700
                               text-white font-semibold text-sm rounded-xl
                               shadow-lg shadow-blue-500/25
                               transition-all duration-200 active:scale-[.98] cursor-pointer">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Çeviriyi Kaydet
                </button>
                <a href="{{ route('courses.edit', $course->id) }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3"/>
                    </svg>
                    Geri Dön
                </a>
            </div>

            {{-- Dil bilgisi --}}
            <div class="bg-blue-50 dark:bg-blue-900/10 border border-blue-200/60 dark:border-blue-800/30 rounded-2xl p-4">
                <div class="flex gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-blue-600 dark:text-blue-400">
                            {{ strtoupper(substr($selectedLang, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-blue-800 dark:text-blue-400">
                            {{ $selectedLanguage->name ?? $selectedLang }}
                        </p>
                        <p class="text-xs text-blue-600 dark:text-blue-500 font-mono mt-0.5">{{ $selectedLang }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('listBuilder', (fieldName, initialHtml) => ({
        items: [],
        init() {
            this.items = this.parseHtml(initialHtml || '');
            if (this.items.length === 0) this.items = [''];
        },
        parseHtml(html) {
            if (!html || !html.trim()) return [];
            const tmp = document.createElement('div');
            tmp.innerHTML = html;
            const lis = tmp.querySelectorAll('li');
            if (lis.length > 0) {
                return Array.from(lis).map(li => li.textContent.trim()).filter(t => t);
            }
            return html.split('\n').map(l => l.trim()).filter(l => l);
        },
        addItem() {
            this.items.push('');
            this.$nextTick(() => {
                const inputs = this.$el.querySelectorAll('input[type="text"]');
                if (inputs.length) inputs[inputs.length - 1].focus();
            });
        },
        removeItem(index) {
            this.items.splice(index, 1);
        },
        toHtml() {
            const filled = this.items.filter(i => i.trim());
            if (filled.length === 0) return '';
            return '<ul>' + filled.map(i => '<li>' + i.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</li>').join('') + '</ul>';
        }
    }));
});
</script>
@endsection
