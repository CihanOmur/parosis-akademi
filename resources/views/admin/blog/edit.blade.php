@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('blogs.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Blog Düzenle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Blog yazısını düzenleyin</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Blog Bilgileri --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Blog Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Blog yazısının bilgilerini düzenleyin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <div class="space-y-1">
                        <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Başlık <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                      text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                               placeholder="Blog başlığını yazın..."
                               value="{{ old('title', $blog->title) }}" required>
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

                    <div class="space-y-1">
                        <label for="short_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Kısa Açıklama
                        </label>
                        <textarea name="short_description" id="short_description" rows="3"
                                  class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                         text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                         ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all resize-y"
                                  placeholder="Blog yazısının kısa açıklaması...">{{ old('short_description', $blog->short_description) }}</textarea>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <div class="space-y-1">
                        <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            İçerik
                        </label>
                        <textarea name="content" id="content" rows="10"
                                  class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl
                                         text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                         ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all resize-y"
                                  placeholder="Blog yazısının içeriği (HTML destekler)...">{{ old('content', $blog->content) }}</textarea>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Kategoriler --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Kategoriler</label>
                            <x-checkbox-dropdown
                                name="category_ids[]"
                                :items="$categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->values()->toArray()"
                                :selected="old('category_ids', $blog->categories->pluck('id')->toArray())"
                                placeholder="Kategori seçin..."
                                singularLabel="Kategori"
                                pluralLabel="Kategori Seçildi"
                                dropdownId="categories"
                                :maxVisible="3"
                                :maxSelect="3"
                            />
                        </div>

                        {{-- Etiketler --}}
                        <div class="space-y-1">
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Etiketler</label>
                            <x-checkbox-dropdown
                                name="tag_ids[]"
                                :items="$tags->map(fn($t) => ['id' => $t->id, 'name' => $t->name])->values()->toArray()"
                                :selected="old('tag_ids', $blog->blogTags->pluck('id')->toArray())"
                                placeholder="Etiket seçin..."
                                singularLabel="Etiket"
                                pluralLabel="Etiket Seçildi"
                                dropdownId="tags"
                                :maxVisible="3"
                                :maxSelect="5"
                            />
                        </div>
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
                <a href="{{ route('blogs.index') }}"
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
                           value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '') }}">
                </div>
            </div>

            {{-- Görsel --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Blog Görseli</h3>
                </div>
                <div class="p-5">
                    <x-image-upload name="image" :existing="$blog->image ? asset($blog->image) : null" />
                </div>
            </div>

            {{-- Çeviriler --}}
            @if ($activeLanguages->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Çeviriler</h3>
                <div class="space-y-2">
                    @foreach ($activeLanguages as $activeLang)
                        <a href="{{ route('blogs.editTranslate', ['id' => $blog->id, 'lang' => $activeLang->locale]) }}"
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
