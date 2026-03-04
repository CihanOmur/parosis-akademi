@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('products.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Yeni Ürün</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Yeni bir ürün ekleyin</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Sol kolon --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Ürün Bilgileri --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Ürün Bilgileri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Ürünün temel bilgilerini girin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <x-text-input name="name" label="Ürün Adı" placeholder="Ürün adını yazın..." required />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-textarea name="short_description" label="Kısa Açıklama" placeholder="Ürünün kısa açıklaması..." rows="3" />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-textarea name="description" label="Açıklama" placeholder="Ürün açıklaması (HTML destekler)..." rows="8" />

                </div>
            </div>

            {{-- Ürün Özellikleri --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50"
                 x-data="{ features: [{key: '', value: ''}] }">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Ürün Özellikleri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Başlık ve değer olarak özellik ekleyin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-3">
                    <template x-for="(feature, index) in features" :key="index">
                        <div class="flex items-center gap-3">
                            <input type="text" x-model="feature.key"
                                   class="flex-1 px-3 py-2 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                   placeholder="Başlık (ör: Malzeme)">
                            <input type="text" x-model="feature.value"
                                   class="flex-1 px-3 py-2 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                   placeholder="Değer (ör: %100 Pamuk)">
                            <button type="button" @click="features.splice(index, 1)"
                                    x-show="features.length > 1"
                                    class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer flex-shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </template>

                    <button type="button" @click="features.push({key: '', value: ''})"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-fuchsia-600 dark:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-xl transition-all cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Özellik Ekle
                    </button>

                    <input type="hidden" name="features" :value="JSON.stringify(features.filter(f => f.key.trim() !== ''))">
                </div>
            </div>

            {{-- Kategoriler --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Kategoriler</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Ürünün kategorilerini seçin</p>
                    </div>
                </div>

                <div class="relative p-6">
                    <x-checkbox-dropdown
                        name="category_ids[]"
                        :items="$categories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])->values()->toArray()"
                        :selected="old('category_ids', [])"
                        placeholder="Kategori seçin"
                        singularLabel="Kategori"
                        pluralLabel="Kategori Seçildi"
                        dropdownId="categories"
                        :maxVisible="5"
                        :maxSelect="10"
                    />
                </div>
            </div>

            {{-- Fiyat ve Stok --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Fiyat ve Stok</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Fiyat, indirim ve stok bilgileri</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <x-text-input type="number" name="price" label="Fiyat (₺)" placeholder="0.00" step="0.01" min="0" required />
                        <x-text-input type="number" name="sale_price" label="İndirimli Fiyat (₺)" placeholder="0.00" step="0.01" min="0" />
                        <x-text-input name="sku" label="SKU" placeholder="Stok kodu..." />
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-text-input type="number" name="stock" label="Stok Miktarı" placeholder="0" min="0" />
                        <div class="flex items-end pb-1">
                            <div class="flex items-center gap-3">
                                <input type="hidden" name="manage_stock" value="0">
                                <input type="checkbox" name="manage_stock" id="manage_stock" value="1"
                                       class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-fuchsia-500 focus:ring-fuchsia-500/60"
                                       {{ old('manage_stock') ? 'checked' : '' }}>
                                <label for="manage_stock" class="text-sm font-medium text-slate-700 dark:text-slate-300">Stok Takibi Yap</label>
                            </div>
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
                    Kaydet
                </button>
                <a href="{{ route('products.index') }}"
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

            {{-- Ürün Görseli --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M2.25 18V6a2.25 2.25 0 0 1 2.25-2.25h15A2.25 2.25 0 0 1 21.75 6v12A2.25 2.25 0 0 1 19.5 20.25H4.5A2.25 2.25 0 0 1 2.25 18Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Ürün Görseli</h3>
                </div>
                <div class="p-5">
                    <x-image-upload name="image" />
                </div>
            </div>

            {{-- Galeri --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="flex items-center gap-3 px-5 pt-5 pb-3 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z"/>
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Galeri Resimleri</h3>
                </div>
                <div class="p-5">
                    <label class="block">
                        <div class="flex items-center justify-center w-full border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl px-4 py-6 cursor-pointer hover:border-fuchsia-400 dark:hover:border-fuchsia-500 transition-colors group">
                            <div class="text-center">
                                <svg class="w-8 h-8 text-slate-300 dark:text-slate-600 group-hover:text-fuchsia-400 mx-auto mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                                </svg>
                                <span class="text-xs text-slate-400 dark:text-slate-500">Birden fazla resim seçebilirsiniz</span>
                            </div>
                        </div>
                        <input type="file" name="gallery[]" multiple accept="image/*" class="sr-only">
                    </label>
                </div>
            </div>

            {{-- İpucu --}}
            <div class="bg-amber-50 dark:bg-amber-900/10 border border-amber-200/60 dark:border-amber-800/30 rounded-2xl p-4">
                <div class="flex gap-3">
                    <svg class="w-4.5 h-4.5 text-amber-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd"/>
                    </svg>
                    <div class="space-y-1.5">
                        <p class="text-xs font-semibold text-amber-800 dark:text-amber-400">Bilgi</p>
                        <p class="text-xs text-amber-700 dark:text-amber-500">
                            Ürün varsayılan dilde kaydedilir. Diğer dillerdeki çevirilerini düzenleme sayfasından ekleyebilirsiniz. Varyantlar ve galeri düzenleme sayfasından yönetilir.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
