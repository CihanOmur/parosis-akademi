@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('productAttributes.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Nitelik Düzenle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ $attribute->name }} niteliğini düzenleyin</p>
        </div>
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Sol kolon --}}
    <div class="lg:col-span-2 space-y-5">

        {{-- Nitelik Bilgisi --}}
        <form action="{{ route('productAttributes.update', $attribute->id) }}" method="POST" id="attribute-form">
            @csrf
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/60 via-transparent to-purple-50/40 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Nitelik Bilgisi</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Varsayılan dilde nitelik adını düzenleyin</p>
                    </div>
                </div>

                <div class="relative p-6">
                    <x-text-input name="name" label="Nitelik Adı" placeholder="ör: Beden, Renk" :value="$attribute->name" required />
                </div>
            </div>
        </form>

        {{-- Nitelik Değerleri --}}
        <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden"
             x-data="attributeValues()">
            <div class="absolute inset-0 bg-gradient-to-br from-violet-50/60 via-transparent to-purple-50/40 dark:from-violet-950/20 dark:to-purple-950/10 pointer-events-none"></div>

            <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center shadow-md shadow-violet-500/20 flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">Nitelik Değerleri</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Bu niteliğe ait seçenek değerlerini yönetin</p>
                </div>
                <div class="ml-auto flex items-center gap-2">
                    <label class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-lg cursor-pointer transition-all"
                           :class="showColors ? 'bg-pink-50 dark:bg-pink-900/20 text-pink-700 dark:text-pink-300 ring-1 ring-pink-200 dark:ring-pink-800/50' : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 ring-1 ring-slate-200 dark:ring-slate-600'">
                        <input type="checkbox" x-model="showColors" class="sr-only">
                        <span class="w-3 h-3 rounded-sm" :style="showColors ? 'background: linear-gradient(135deg, #ec4899, #8b5cf6)' : 'background: #94a3b8'"></span>
                        Renk kodu
                    </label>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-violet-50 dark:bg-violet-900/20 text-violet-700 dark:text-violet-300 text-xs font-semibold rounded-lg"
                          x-text="values.length + ' değer'"></span>
                </div>
            </div>

            <div class="relative p-6 space-y-3">

                {{-- Mevcut değerler listesi --}}
                <template x-if="values.length > 0">
                    <div class="space-y-2" id="values-list">
                        <template x-for="value in values" :key="value.id">
                            <div class="flex items-center gap-3 p-3 bg-slate-50 dark:bg-slate-700/40 rounded-xl border border-slate-200/60 dark:border-slate-600/40 group">
                                {{-- Renk --}}
                                <div class="relative flex-shrink-0" x-show="showColors" x-cloak>
                                    <input type="color"
                                           :value="value.color_code || '#6366f1'"
                                           @change="value.color_code = $event.target.value; updateValue(value)"
                                           class="w-9 h-9 rounded-lg border border-slate-300 dark:border-slate-600 cursor-pointer p-0.5 bg-white dark:bg-slate-700"
                                           title="Renk Kodu">
                                </div>

                                {{-- Ad --}}
                                <input type="text"
                                       :value="value.name"
                                       @change="value.name = $event.target.value"
                                       @blur="updateValue(value)"
                                       @keydown.enter.prevent="updateValue(value)"
                                       class="flex-1 px-3 py-2 bg-white dark:bg-slate-700/70 border-0 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-violet-500/60 rounded-lg text-sm text-slate-900 dark:text-white placeholder-slate-400 transition-all"
                                       placeholder="Değer adı...">

                                {{-- Aktif toggle --}}
                                <button type="button"
                                        @click="toggleValue(value)"
                                        :class="value.is_active
                                            ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 ring-emerald-200 dark:ring-emerald-800/50'
                                            : 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 ring-slate-200 dark:ring-slate-600'"
                                        class="flex-shrink-0 inline-flex items-center gap-1.5 px-2.5 py-1.5 text-xs font-medium rounded-lg ring-1 transition-all cursor-pointer">
                                    <span class="w-1.5 h-1.5 rounded-full"
                                          :class="value.is_active ? 'bg-emerald-500' : 'bg-slate-400'"></span>
                                    <span x-text="value.is_active ? 'Aktif' : 'Pasif'"></span>
                                </button>

                                {{-- Sil --}}
                                <button type="button"
                                        @click="deleteValue(value)"
                                        class="flex-shrink-0 p-1.5 text-slate-300 dark:text-slate-600 hover:text-red-500 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer opacity-0 group-hover:opacity-100">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                    </svg>
                                </button>
                            </div>
                        </template>
                    </div>
                </template>

                <template x-if="values.length === 0">
                    <div class="py-8 text-center">
                        <svg class="w-10 h-10 text-slate-300 dark:text-slate-600 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                        </svg>
                        <p class="text-sm text-slate-400 dark:text-slate-500">Henüz değer eklenmemiş.</p>
                    </div>
                </template>

                {{-- Yeni Değer Ekle --}}
                <div class="pt-3 border-t border-dashed border-slate-200 dark:border-slate-700/60">
                    <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-3">Değer Ekle</p>
                    <div class="flex items-center gap-3">
                        {{-- Renk --}}
                        <div class="flex-shrink-0" x-show="showColors" x-cloak>
                            <input type="color"
                                   x-model="newValue.color_code"
                                   class="w-9 h-9 rounded-lg border border-slate-300 dark:border-slate-600 cursor-pointer p-0.5 bg-white dark:bg-slate-700"
                                   title="Renk Kodu">
                        </div>

                        {{-- Ad --}}
                        <input type="text"
                               x-model="newValue.name"
                               @keydown.enter.prevent="storeValue()"
                               class="flex-1 px-3 py-2 bg-slate-50 dark:bg-slate-700/70 border-0 ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-violet-500/60 rounded-lg text-sm text-slate-900 dark:text-white placeholder-slate-400 transition-all"
                               placeholder="ör: S, M, L veya Kırmızı, Mavi...">

                        {{-- Ekle butonu --}}
                        <button type="button"
                                @click="storeValue()"
                                :disabled="!newValue.name.trim()"
                                class="flex-shrink-0 inline-flex items-center gap-1.5 px-4 py-2 bg-gradient-to-r from-violet-500 to-purple-600 hover:from-violet-600 hover:to-purple-700 disabled:opacity-50 disabled:cursor-not-allowed text-white text-sm font-semibold rounded-lg shadow-sm shadow-violet-500/20 transition-all cursor-pointer">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Ekle
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Sağ kolon --}}
    <div class="space-y-5 sticky top-24 self-start">

        {{-- Aksiyonlar --}}
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5 space-y-3">
            <button type="submit" form="attribute-form"
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
            <a href="{{ route('productAttributes.index') }}"
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

        {{-- Çeviriler --}}
        @if ($activeLanguages->count() > 0)
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
            <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Çeviriler</h3>
            <div class="space-y-2">
                @foreach ($activeLanguages as $activeLang)
                    <a href="{{ route('productAttributes.editTranslate', ['id' => $attribute->id, 'lang' => $activeLang->locale]) }}"
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

        {{-- Bilgi --}}
        <div class="bg-violet-50 dark:bg-violet-900/10 border border-violet-200/60 dark:border-violet-800/30 rounded-2xl p-4">
            <div class="flex gap-3">
                <svg class="w-4.5 h-4.5 text-violet-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-7-4a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM9 9a.75.75 0 0 0 0 1.5h.253a.25.25 0 0 1 .244.304l-.459 2.066A1.75 1.75 0 0 0 10.747 15H11a.75.75 0 0 0 0-1.5h-.253a.25.25 0 0 1-.244-.304l.459-2.066A1.75 1.75 0 0 0 9.253 9H9Z" clip-rule="evenodd"/>
                </svg>
                <div class="space-y-1.5">
                    <p class="text-xs font-semibold text-violet-800 dark:text-violet-400">Değer Değişiklikleri</p>
                    <p class="text-xs text-violet-700 dark:text-violet-500">
                        Değer adı veya rengi değiştirildiğinde otomatik olarak kaydedilir. Renk kodu isteğe bağlıdır.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@php
    $hasColorCodes = $attribute->values->contains(function ($v) {
        return !empty($v->color_code);
    });
    $valuesJson = $attribute->values->map(function ($v) {
        return [
            'id' => $v->id,
            'name' => $v->name,
            'color_code' => $v->color_code,
            'is_active' => (bool) $v->is_active,
        ];
    });
@endphp

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    const attributeId = {{ $attribute->id }};

    function attributeValues() {
        return {
            showColors: {{ $hasColorCodes ? 'true' : 'false' }},
            values: @json($valuesJson),
            newValue: {
                name: '',
                color_code: '#6366f1',
            },

            storeValue() {
                if (!this.newValue.name.trim()) return;

                axios.post('/panel/product-attributes/' + attributeId + '/values/store', {
                    value_name: this.newValue.name,
                    color_code: this.showColors ? this.newValue.color_code : null,
                    _token: csrfToken,
                })
                .then((response) => {
                    if (response.data.status === 1) {
                        this.values.push(response.data.value);
                        this.newValue.name = '';
                        this.newValue.color_code = '#6366f1';
                        showToast('success', response.data.message);
                    } else {
                        showToast('error', response.data.message);
                    }
                })
                .catch(() => {
                    showToast('error', 'Değer eklenirken bir hata oluştu.');
                });
            },

            updateValue(value) {
                if (!value.name.trim()) return;

                axios.post('/panel/product-attributes/values/' + value.id + '/update', {
                    value_name: value.name,
                    color_code: this.showColors ? value.color_code : null,
                    _token: csrfToken,
                })
                .then((response) => {
                    if (response.data.status === 1) {
                        showToast('success', response.data.message);
                    } else {
                        showToast('error', response.data.message);
                    }
                })
                .catch(() => {
                    showToast('error', 'Değer güncellenirken bir hata oluştu.');
                });
            },

            toggleValue(value) {
                axios.post('/panel/product-attributes/values/' + value.id + '/toggle', {
                    _token: csrfToken,
                })
                .then((response) => {
                    if (response.data.status === 1) {
                        value.is_active = !value.is_active;
                        showToast('success', response.data.message);
                    } else {
                        showToast('error', response.data.message);
                    }
                })
                .catch(() => {
                    showToast('error', 'Durum değiştirilirken bir hata oluştu.');
                });
            },

            deleteValue(value) {
                if (!confirm('Bu değeri silmek istediğinize emin misiniz?')) return;

                axios.delete('/panel/product-attributes/values/' + value.id, {
                    data: { _token: csrfToken },
                })
                .then((response) => {
                    if (response.data.status === 1) {
                        this.values = this.values.filter(v => v.id !== value.id);
                        showToast('success', response.data.message);
                    } else {
                        showToast('error', response.data.message);
                    }
                })
                .catch(() => {
                    showToast('error', 'Değer silinirken bir hata oluştu.');
                });
            },
        };
    }
</script>
@endsection
