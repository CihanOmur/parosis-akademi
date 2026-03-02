@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('courses.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kurs Düzenle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Kursu düzenleyin</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Kurs Bilgileri --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Kurs Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Kursun bilgilerini düzenleyin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    {{-- Başlık --}}
                    <div class="space-y-1">
                        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Başlık <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Kurs başlığını yazın..."
                               value="{{ old('title', $course->title) }}" required>
                        @error('title')
                            <p class="text-sm text-red-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Kısa Açıklama --}}
                    <div class="space-y-1">
                        <label for="short_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Kısa Açıklama
                        </label>
                        <textarea name="short_description" id="short_description" rows="3"
                                  class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                         text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                         ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all resize-y"
                                  placeholder="Kursun kısa açıklaması...">{{ old('short_description', $course->short_description) }}</textarea>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- İçerik --}}
                    <div class="space-y-1">
                        <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            İçerik
                        </label>
                        <textarea name="content" id="content" rows="10"
                                  class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                         text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                         ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all resize-y"
                                  placeholder="Kursun içeriği (HTML destekler)...">{{ old('content', $course->content) }}</textarea>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    {{-- Neler Öğreneceksiniz - Dinamik Liste --}}
                    <div class="space-y-2" x-data="listBuilder('what_you_learn', @js(old('what_you_learn', $course->what_you_learn)))">
                        <input type="hidden" name="what_you_learn" :value="toHtml()">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-fuchsia-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                                    </svg>
                                    Neler Öğreneceksiniz
                                </span>
                            </label>
                            <button type="button" @click="addItem()"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold
                                           text-fuchsia-600 dark:text-fuchsia-400 bg-fuchsia-50 dark:bg-fuchsia-900/20
                                           hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900/30
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
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full bg-fuchsia-100 dark:bg-fuchsia-900/30 text-fuchsia-600 dark:text-fuchsia-400 text-xs font-bold flex-shrink-0" x-text="index + 1"></div>
                                    <input type="text" x-model="items[index]"
                                           class="flex-1 px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                                  text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                                  ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
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
                    <div class="space-y-2" x-data="listBuilder('why_choose', @js(old('why_choose', $course->why_choose)))">
                        <input type="hidden" name="why_choose" :value="toHtml()">
                        <div class="flex items-center justify-between">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                <span class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/>
                                    </svg>
                                    Neden Bu Kurs
                                </span>
                            </label>
                            <button type="button" @click="addItem()"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold
                                           text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-900/20
                                           hover:bg-amber-100 dark:hover:bg-amber-900/30
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
                                    <div class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-xs font-bold flex-shrink-0" x-text="index + 1"></div>
                                    <input type="text" x-model="items[index]"
                                           class="flex-1 px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                                  text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                                  ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-amber-500/60 transition-all"
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

                    {{-- Kategoriler --}}
                    <div class="space-y-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Kategoriler</label>
                        <x-checkbox-dropdown
                            name="category_ids[]"
                            :items="$categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->values()->toArray()"
                            :selected="old('category_ids', $course->categories->pluck('id')->toArray())"
                            placeholder="Kategori seçin..."
                            singularLabel="Kategori"
                            pluralLabel="Kategori Seçildi"
                            dropdownId="categories"
                            :maxVisible="3"
                            :maxSelect="3"
                        />
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
                               bg-gradient-to-r from-fuchsia-500 to-purple-600
                               hover:from-fuchsia-600 hover:to-purple-700
                               text-white font-semibold text-sm rounded-xl
                               shadow-lg shadow-fuchsia-500/25
                               transition-all duration-200 active:scale-[.98] cursor-pointer">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Güncelle
                </button>
                <a href="{{ route('courses.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50
                          transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    İptal
                </a>
            </div>

            {{-- Yayın Tarihi --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Yayın Tarihi</h3>
                </div>
                <div class="p-5">
                    <input type="datetime-local" name="published_at" id="published_at"
                           class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                  text-slate-900 dark:text-white text-sm
                                  ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                           value="{{ old('published_at', $course->published_at ? $course->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>
            </div>

            {{-- Kurs Bilgileri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Kurs Bilgileri</h3>
                </div>
                <div class="p-5 space-y-4">
                    {{-- Fiyat --}}
                    <div class="space-y-1">
                        <label for="price" class="block text-xs font-medium text-slate-600 dark:text-slate-400">Fiyat</label>
                        <input type="text" name="price" id="price"
                               class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Örn: 299 TL"
                               value="{{ old('price', $course->price) }}">
                    </div>

                    {{-- Süre --}}
                    <div class="space-y-1">
                        <label for="duration" class="block text-xs font-medium text-slate-600 dark:text-slate-400">Süre</label>
                        <input type="text" name="duration" id="duration"
                               class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Örn: 40 Saat"
                               value="{{ old('duration', $course->duration) }}">
                    </div>

                    {{-- Ders Sayısı --}}
                    <div class="space-y-1">
                        <label for="lesson_count" class="block text-xs font-medium text-slate-600 dark:text-slate-400">Ders Sayısı</label>
                        <input type="text" name="lesson_count" id="lesson_count"
                               class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Örn: 120"
                               value="{{ old('lesson_count', $course->lesson_count) }}">
                    </div>

                    {{-- Dil --}}
                    <div class="space-y-1">
                        <label for="language" class="block text-xs font-medium text-slate-600 dark:text-slate-400">Dil</label>
                        <input type="text" name="language" id="language"
                               class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Örn: Türkçe"
                               value="{{ old('language', $course->language) }}">
                    </div>

                    {{-- Öğrenci Sayısı --}}
                    <div class="space-y-1">
                        <label for="student_count" class="block text-xs font-medium text-slate-600 dark:text-slate-400">Öğrenci Sayısı</label>
                        <input type="text" name="student_count" id="student_count"
                               class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Örn: 500"
                               value="{{ old('student_count', $course->student_count) }}">
                    </div>

                    {{-- Sertifika --}}
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="has_certification" value="0">
                        <input type="checkbox" name="has_certification" id="has_certification" value="1"
                               class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-fuchsia-500 focus:ring-fuchsia-500/30 dark:bg-slate-700"
                               {{ old('has_certification', $course->has_certification) ? 'checked' : '' }}>
                        <label for="has_certification" class="text-sm font-medium text-slate-700 dark:text-slate-300">Sertifika Var</label>
                    </div>

                    {{-- Eğitmen Adı --}}
                    <div class="space-y-1">
                        <label for="instructor_name" class="block text-xs font-medium text-slate-600 dark:text-slate-400">Eğitmen Adı</label>
                        <input type="text" name="instructor_name" id="instructor_name"
                               class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Eğitmenin adı..."
                               value="{{ old('instructor_name', $course->instructor_name) }}">
                    </div>
                </div>
            </div>

            {{-- Kurs Görseli --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Kurs Görseli</h3>
                </div>
                <div class="p-5">
                    <x-image-upload name="image" :existing="$course->image ? asset($course->image) : null" />
                </div>
            </div>

            {{-- İç Görsel --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">İç Görsel</h3>
                </div>
                <div class="p-5">
                    <x-image-upload name="inner_image" :existing="$course->inner_image ? asset($course->inner_image) : null" />
                </div>
            </div>

            {{-- Eğitmen Görseli --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Eğitmen Görseli</h3>
                </div>
                <div class="p-5">
                    <x-image-upload name="instructor_image" :existing="$course->instructor_image ? asset($course->instructor_image) : null" />
                </div>
            </div>

            {{-- Çeviriler --}}
            @if ($activeLanguages->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Çeviriler</h3>
                <div class="space-y-2">
                    @foreach ($activeLanguages as $activeLang)
                        <a href="{{ route('courses.editTranslate', ['id' => $course->id, 'lang' => $activeLang->locale]) }}"
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
