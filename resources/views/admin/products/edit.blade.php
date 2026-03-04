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
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Ürün Düzenle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Ürünü düzenleyin</p>
        </div>
    </div>
@endsection

@section('content')
<form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="product-form">
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
                        <p class="text-xs text-slate-400 mt-0.5">Ürünün bilgilerini düzenleyin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">
                    <x-text-input name="name" label="Ürün Adı" placeholder="Ürün adını yazın..." :value="$product->name" required />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-textarea name="short_description" label="Kısa Açıklama" placeholder="Ürünün kısa açıklaması..." rows="3" :value="$product->short_description" />

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <x-textarea name="description" label="Açıklama" placeholder="Ürün açıklaması (HTML destekler)..." rows="8" :value="$product->description" />

                </div>
            </div>

            {{-- Ürün Özellikleri --}}
            @php
                $featuresData = [];
                if ($product->features) {
                    $decoded = json_decode($product->features, true);
                    if (is_array($decoded)) {
                        $featuresData = $decoded;
                    }
                }
            @endphp
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50"
                 x-data="{ features: {{ json_encode($featuresData ?: [['key' => '', 'value' => '']]) }} }">
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

                    {{-- Hidden input to serialize features as JSON --}}
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
                        :selected="old('category_ids', $product->categories->pluck('id')->toArray())"
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
                        <x-text-input type="number" name="price" label="Fiyat (₺)" placeholder="0.00" step="0.01" min="0" :value="$product->price" required />
                        <x-text-input type="number" name="sale_price" label="İndirimli Fiyat (₺)" placeholder="0.00" step="0.01" min="0" :value="$product->sale_price" />
                        <x-text-input name="sku" label="SKU" placeholder="Stok kodu..." :value="$product->sku" />
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-text-input type="number" name="stock" label="Stok Miktarı" placeholder="0" min="0" :value="$product->stock" />
                        <div class="flex items-end pb-1">
                            <div class="flex items-center gap-3">
                                <input type="hidden" name="manage_stock" value="0">
                                <input type="checkbox" name="manage_stock" id="manage_stock" value="1"
                                       class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-fuchsia-500 focus:ring-fuchsia-500/30 dark:bg-slate-700"
                                       {{ old('manage_stock', $product->manage_stock) ? 'checked' : '' }}>
                                <label for="manage_stock" class="text-sm font-medium text-slate-700 dark:text-slate-300">Stok Takibi Yap</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Varyantlar --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50"
                 x-data="{
                     selectedAttributes: [],
                     generating: false,
                     savingVariants: false,

                     generateVariants() {
                         if (this.selectedAttributes.length === 0) {
                             showToast('error', 'Lütfen en az bir özellik seçin.');
                             return;
                         }
                         this.generating = true;
                         axios.post('{{ route('products.generateVariants', $product->id) }}', {
                             _token: '{{ csrf_token() }}',
                             attribute_ids: this.selectedAttributes
                         })
                         .then(response => {
                             if (response.data.status === 1) {
                                 showToast('success', response.data.message);
                                 window.location.reload();
                             } else {
                                 showToast('error', response.data.message ?? 'Bir hata oluştu.');
                             }
                         })
                         .catch(() => showToast('error', 'Varyantlar oluşturulurken bir hata oluştu.'))
                         .finally(() => this.generating = false);
                     },

                     deleteVariant(variantId) {
                         axios.delete('/panel/products/variants/' + variantId, {
                             data: { _token: '{{ csrf_token() }}' }
                         })
                         .then(response => {
                             if (response.data.status === 1) {
                                 showToast('success', response.data.message);
                                 document.getElementById('variant-row-' + variantId)?.remove();
                             } else {
                                 showToast('error', response.data.message ?? 'Bir hata oluştu.');
                             }
                         })
                         .catch(() => showToast('error', 'Varyant silinirken bir hata oluştu.'));
                     },

                     saveVariants() {
                         window.saveVariantsAjax(this);
                     }
                 }">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Varyantlar</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Ürün varyantlarını yönetin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">

                    {{-- Özellik seçici --}}
                    @if($attributes->count() > 0)
                    <div>
                        <p class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Varyant Oluşturmak İçin Özellik Seçin</p>
                        <div class="flex flex-wrap gap-3 mb-4">
                            @foreach($attributes as $attr)
                                <label class="inline-flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox"
                                           :value="{{ $attr->id }}"
                                           x-model="selectedAttributes"
                                           class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-fuchsia-500 focus:ring-fuchsia-500/30 dark:bg-slate-700">
                                    <span class="text-sm text-slate-700 dark:text-slate-300">{{ $attr->name }}</span>
                                    @if($attr->values->count())
                                        <span class="text-xs text-slate-400">({{ $attr->values->pluck('name')->join(', ') }})</span>
                                    @endif
                                </label>
                            @endforeach
                        </div>
                        <button type="button" @click="generateVariants()" :disabled="generating"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold
                                       bg-gradient-to-r from-fuchsia-500 to-purple-600
                                       hover:from-fuchsia-600 hover:to-purple-700
                                       text-white rounded-xl shadow-md shadow-fuchsia-500/20
                                       disabled:opacity-60 disabled:cursor-not-allowed
                                       transition-all duration-200 cursor-pointer">
                            <svg class="w-4 h-4" :class="{ 'animate-spin': generating }" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                            </svg>
                            <span x-text="generating ? 'Oluşturuluyor...' : 'Varyant Oluştur'"></span>
                        </button>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>
                    @endif

                    {{-- Mevcut varyantlar --}}
                    @if($product->variants->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm">
                                    <thead>
                                        <tr class="border-b border-slate-200 dark:border-slate-700">
                                            <th class="pb-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Varyant</th>
                                            <th class="pb-3 px-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32">SKU</th>
                                            <th class="pb-3 px-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32">Fiyat</th>
                                            <th class="pb-3 px-3 text-left text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-24">Stok</th>
                                            <th class="pb-3 px-3 text-center text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-16">Aktif</th>
                                            <th class="pb-3 text-center text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-12">Sil</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50" id="variants-tbody">
                                        @foreach($product->variants as $variant)
                                            <tr id="variant-row-{{ $variant->id }}" class="group">
                                                <td class="py-3 pr-3">
                                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                                        {{ $variant->attributeValues->pluck('name')->join(' / ') ?: 'Varyant #' . $variant->id }}
                                                    </span>
                                                </td>
                                                <td class="py-3 px-3">
                                                    <input type="text"
                                                           name="variants[{{ $variant->id }}][sku]"
                                                           value="{{ $variant->sku }}"
                                                           class="w-full px-3 py-1.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-lg
                                                                  text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                                                  ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                                           placeholder="SKU">
                                                </td>
                                                <td class="py-3 px-3">
                                                    <input type="number"
                                                           name="variants[{{ $variant->id }}][price]"
                                                           value="{{ $variant->price }}"
                                                           step="0.01" min="0"
                                                           class="w-full px-3 py-1.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-lg
                                                                  text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                                                  ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                                           placeholder="Ürün fiyatı">
                                                </td>
                                                <td class="py-3 px-3">
                                                    <input type="number"
                                                           name="variants[{{ $variant->id }}][stock]"
                                                           value="{{ $variant->stock }}"
                                                           min="0"
                                                           class="w-full px-3 py-1.5 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-lg
                                                                  text-slate-900 dark:text-white placeholder-slate-400 text-sm
                                                                  ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                                           placeholder="0">
                                                </td>
                                                <td class="py-3 px-3 text-center">
                                                    <input type="hidden" name="variants[{{ $variant->id }}][is_active]" value="0">
                                                    <input type="checkbox"
                                                           name="variants[{{ $variant->id }}][is_active]"
                                                           value="1"
                                                           class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-fuchsia-500 focus:ring-fuchsia-500/30 dark:bg-slate-700"
                                                           {{ $variant->is_active ? 'checked' : '' }}>
                                                </td>
                                                <td class="py-3 text-center">
                                                    <button type="button"
                                                            @click="deleteVariant({{ $variant->id }})"
                                                            class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                        </svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="pt-4">
                                <button type="button" @click="saveVariants()" :disabled="savingVariants"
                                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold
                                               bg-gradient-to-r from-fuchsia-500 to-purple-600
                                               hover:from-fuchsia-600 hover:to-purple-700
                                               text-white rounded-xl shadow-md shadow-fuchsia-500/20
                                               disabled:opacity-60 disabled:cursor-not-allowed
                                               transition-all duration-200 cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span x-text="savingVariants ? 'Kaydediliyor...' : 'Varyantları Kaydet'"></span>
                                </button>
                            </div>
                    @else
                        <div class="flex items-center justify-center gap-2 py-8 text-sm text-slate-400 dark:text-slate-500 border-2 border-dashed border-slate-200 dark:border-slate-700 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
                            </svg>
                            Henüz varyant eklenmemiş. Yukarıdan özellik seçerek varyant oluşturun.
                        </div>
                    @endif
                </div>
            </div>

            {{-- Galeri Resimleri --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50"
                 x-data="{ uploading: false }">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none rounded-2xl"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Galeri Resimleri</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Ürün galeri resimlerini yönetin</p>
                    </div>
                </div>

                <div class="relative p-6 space-y-5">

                    {{-- Mevcut galeri resimleri --}}
                    @if($product->images->count() > 0)
                        <div id="gallery-grid" class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            @foreach($product->images as $galleryItem)
                                <div class="relative group rounded-xl overflow-hidden bg-slate-100 dark:bg-slate-700 aspect-square sortable-gallery-item"
                                     data-id="{{ $galleryItem->id }}" id="gallery-item-{{ $galleryItem->id }}">
                                    <img src="{{ asset($galleryItem->image) }}" alt="" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                                        <button type="button"
                                                onclick="deleteGalleryImage({{ $galleryItem->id }})"
                                                class="p-1.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="absolute top-1.5 left-1.5 cursor-grab active:cursor-grabbing sortable-gallery-handle">
                                        <svg class="w-4 h-4 text-white drop-shadow" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                                        </svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Yeni resim yükle --}}
                    <div>
                        <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-2">Yeni Resimler Ekle</p>
                        <label class="block cursor-pointer" x-data>
                            <div class="flex items-center justify-center w-full border-2 border-dashed border-slate-200 dark:border-slate-600 rounded-xl px-4 py-6
                                        hover:border-fuchsia-400 dark:hover:border-fuchsia-500 transition-colors group"
                                 :class="{ 'opacity-60 cursor-not-allowed': uploading }">
                                <div class="text-center">
                                    <svg class="w-8 h-8 text-slate-300 dark:text-slate-600 group-hover:text-fuchsia-400 mx-auto mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                                    </svg>
                                    <span class="text-xs text-slate-400 dark:text-slate-500">
                                        <span x-text="uploading ? 'Yükleniyor...' : 'Birden fazla resim seçebilirsiniz'"></span>
                                    </span>
                                </div>
                            </div>
                            <input type="file"
                                   id="gallery-upload-input"
                                   multiple accept="image/*,.svg"
                                   class="sr-only"
                                   :disabled="uploading"
                                   @change="
                                       uploading = true;
                                       const fd = new FormData();
                                       Array.from($event.target.files).forEach(f => fd.append('images[]', f));
                                       fd.append('_token', '{{ csrf_token() }}');
                                       axios.post('{{ route('products.uploadGallery', $product->id) }}', fd)
                                           .then(r => {
                                               if (r.data.status === 1) {
                                                   showToast('success', r.data.message);
                                                   window.location.reload();
                                               } else {
                                                   showToast('error', r.data.message ?? 'Yükleme başarısız.');
                                               }
                                           })
                                           .catch(err => {
                                               let msg = 'Resimler yüklenirken bir hata oluştu.';
                                               if (err.response && err.response.data) {
                                                   const d = err.response.data;
                                                   if (d.errors) {
                                                       msg = Object.values(d.errors).flat().join(' ');
                                                   } else if (d.message) {
                                                       msg = d.message;
                                                   }
                                               }
                                               showToast('error', msg);
                                           })
                                           .finally(() => { uploading = false; $event.target.value = ''; });
                                   ">
                        </label>
                    </div>
                </div>
            </div>

        </div>

        {{-- Sağ kolon --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Aksiyonlar --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5 space-y-3">
                <button type="submit" form="product-form"
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
                    <x-image-upload name="image" :existing="$product->image ? asset($product->image) : null" />
                </div>
            </div>

            {{-- Çeviriler --}}
            @if ($activeLanguages->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Çeviriler</h3>
                <div class="space-y-2">
                    @foreach ($activeLanguages as $activeLang)
                        <a href="{{ route('products.editTranslate', ['id' => $product->id, 'lang' => $activeLang->locale]) }}"
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    // Save variants via AJAX
    window.saveVariantsAjax = function(component) {
        component.savingVariants = true;
        const rows = document.querySelectorAll('#variants-tbody tr[id^="variant-row-"]');
        const variants = {};
        rows.forEach(function(row) {
            const id = row.id.replace('variant-row-', '');
            variants[id] = {
                sku: row.querySelector('input[name$="[sku]"]')?.value ?? '',
                price: row.querySelector('input[name$="[price]"]')?.value ?? '',
                stock: row.querySelector('input[name$="[stock]"]')?.value ?? '0',
                is_active: row.querySelector('input[type="checkbox"][name$="[is_active]"]')?.checked ? '1' : '0',
            };
        });
        axios.post('{{ route("products.updateVariants", $product->id) }}', {
            _token: csrfToken,
            variants: variants
        })
        .then(function(response) {
            if (response.data.status === 1) {
                showToast('success', response.data.message);
            } else {
                showToast('error', response.data.message ?? 'Bir hata oluştu.');
            }
        })
        .catch(function() { showToast('error', 'Varyantlar kaydedilirken bir hata oluştu.'); })
        .finally(function() { component.savingVariants = false; });
    };

    // Gallery SortableJS
    const galleryGrid = document.getElementById('gallery-grid');
    if (galleryGrid) {
        Sortable.create(galleryGrid, {
            handle: '.sortable-gallery-handle',
            animation: 150,
            ghostClass: 'opacity-40',
            chosenClass: 'shadow-xl',
            onEnd: function () {
                const order = Array.from(galleryGrid.querySelectorAll('[data-id]'))
                    .map(function (el) { return parseInt(el.dataset.id); });

                axios.post('{{ route("products.images.updateOrder") }}', {
                    order: order,
                    _token: csrfToken
                })
                .then(function (response) {
                    if (response.data.status === 1) {
                        showToast('success', response.data.message);
                    }
                })
                .catch(function () {
                    showToast('error', 'Sıralama güncellenirken bir hata oluştu.');
                });
            }
        });
    }

    function deleteGalleryImage(imageId) {
        axios.delete('/panel/products/images/' + imageId, {
            data: { _token: csrfToken }
        })
        .then(function (response) {
            if (response.data.status === 1) {
                showToast('success', response.data.message);
                const el = document.getElementById('gallery-item-' + imageId);
                if (el) el.remove();
            } else {
                showToast('error', response.data.message ?? 'Bir hata oluştu.');
            }
        })
        .catch(function () {
            showToast('error', 'Resim silinirken bir hata oluştu.');
        });
    }
</script>
@endsection
