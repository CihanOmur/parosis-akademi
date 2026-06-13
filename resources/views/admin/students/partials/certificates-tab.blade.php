{{--
    Öğrenci profili → Sertifikalar sekmesi
    - Üstte: filtre (tür) + "Sertifika Ekle" butonu
    - Tablo: tür badge, ad, veren kurum, branş, tarih, işlemler (indir/düzenle/sil)
    - Modal: aynı modal hem ekleme hem düzenleme için kullanılır (Alpine state ile dinamik)
--}}

@php
    $typeBadgeMap = [
        'kurumsal'    => 'bg-slate-100 text-slate-700 dark:bg-slate-700/50 dark:text-slate-300',
        'danismanlik' => 'bg-blue-50 text-blue-700 dark:bg-blue-900/20 dark:text-blue-400',
        'yarisma'     => 'bg-amber-50 text-amber-700 dark:bg-amber-900/20 dark:text-amber-400',
    ];
@endphp

<div x-data="certificateManager({
        types: {{ \Illuminate\Support\Js::from($certificateTypes) }},
        institutions: {{ \Illuminate\Support\Js::from($consultingInstitutions->map(fn($i) => ['id' => $i->id, 'name' => $i->name])) }},
        categories: {{ \Illuminate\Support\Js::from($courseCategories->map(fn($c) => ['id' => $c->id, 'name' => $c->name])) }},
        siteName: {{ \Illuminate\Support\Js::from($siteName) }},
        storeUrl: {{ \Illuminate\Support\Js::from(route('students.certificates.store', $student->id)) }},
        updateUrlBase: {{ \Illuminate\Support\Js::from(url('panel/students/' . $student->id . '/certificates')) }}
     })"
     class="space-y-5">

    {{-- Filtre + Ekle butonu --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="inline-flex p-1 bg-slate-100 dark:bg-slate-800 rounded-xl">
            <button type="button" @click="filterType = ''"
                    :class="filterType === '' ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-white shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                    class="px-4 py-1.5 rounded-lg text-xs font-medium transition-all cursor-pointer">Tümü</button>
            @foreach($certificateTypes as $key => $label)
                <button type="button" @click="filterType = '{{ $key }}'"
                        :class="filterType === '{{ $key }}' ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-white shadow-sm' : 'text-slate-500 hover:text-slate-700'"
                        class="px-4 py-1.5 rounded-lg text-xs font-medium transition-all cursor-pointer">{{ $label }}</button>
            @endforeach
        </div>

        <div class="flex items-center gap-2 no-print">
            @if(!$student->certificates->isEmpty())
                <button type="button" @click="window.print()"
                        class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                               bg-white dark:bg-slate-700 border border-slate-200 dark:border-slate-600
                               text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600
                               font-semibold text-sm rounded-xl transition-all duration-200 cursor-pointer"
                        title="Filtrelenmiş sertifikaları CV / başarı özeti olarak yazdırın">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                    </svg>
                    Yazdır / CV
                </button>
            @endif

            <button type="button" @click="openCreate()"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                           bg-gradient-to-r from-fuchsia-500 to-purple-600
                           hover:from-fuchsia-600 hover:to-purple-700
                           text-white font-semibold text-sm rounded-xl
                           shadow-lg shadow-fuchsia-500/25 transition-all duration-200 active:scale-[.98] cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Sertifika Ekle
            </button>
        </div>
    </div>

    {{-- Print başlığı: sadece yazdırılırken görünür --}}
    <div class="hidden print-only mb-6">
        <h1 class="text-2xl font-bold mb-1">{{ $student->full_name }} — Sertifika Özeti</h1>
        <div class="text-sm text-slate-600">
            <span x-show="filterType === ''">Tüm sertifikalar</span>
            <template x-for="(label, key) in types" :key="key">
                <span x-show="filterType === key" x-text="label + ' sertifikalar'"></span>
            </template>
            <span> · Çıktı tarihi: {{ now()->format('d.m.Y') }}</span>
        </div>
    </div>

    {{-- Liste --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        @if($student->certificates->isEmpty())
            <div class="p-16 text-center">
                <svg class="w-14 h-14 mx-auto text-slate-300 dark:text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>
                </svg>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Bu öğrenci için henüz sertifika eklenmemiş.</p>
                <button type="button" @click="openCreate()" class="mt-3 text-fuchsia-600 dark:text-fuchsia-400 hover:underline text-sm font-medium cursor-pointer">
                    İlk sertifikayı ekle
                </button>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32">Tür</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sertifika Adı</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Veren Kurum</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Branş</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-32">Tarih</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-40 no-print">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @foreach($student->certificates as $cert)
                            @php
                                $certPayload = [
                                    'id' => $cert->id,
                                    'type' => $cert->type,
                                    'name' => $cert->name,
                                    'consulting_institution_id' => $cert->consulting_institution_id,
                                    'issuer_text' => $cert->issuer_text,
                                    'category_id' => $cert->category_id,
                                    'issue_date' => optional($cert->issue_date)->format('Y-m-d'),
                                    'certificate_number' => $cert->certificate_number,
                                    'notes' => $cert->notes,
                                    'has_file' => (bool) $cert->file_path,
                                ];
                            @endphp
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors"
                                x-show="filterType === '' || filterType === '{{ $cert->type }}'">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold {{ $typeBadgeMap[$cert->type] ?? 'bg-slate-100 text-slate-700' }}">
                                        {{ $cert->type_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">
                                    {{ $cert->name }}
                                    @if($cert->certificate_number)
                                        <p class="text-xs text-slate-400 font-normal mt-0.5">No: {{ $cert->certificate_number }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    {{ $cert->issuer_name }}
                                </td>
                                <td class="px-6 py-4 text-slate-500 dark:text-slate-400 text-xs">
                                    {{ $cert->category?->name ?: '—' }}
                                </td>
                                <td class="px-6 py-4 text-slate-500 dark:text-slate-400 text-xs">
                                    {{ $cert->issue_date?->format('d.m.Y') }}
                                </td>
                                <td class="px-6 py-4 no-print">
                                    <div class="flex items-center gap-1">
                                        @if($cert->file_path)
                                            <a href="{{ route('students.certificates.download', [$student->id, $cert->id]) }}"
                                               class="p-2 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all" title="İndir">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                                </svg>
                                            </a>
                                        @endif

                                        <button type="button"
                                                data-cert='@json($certPayload)'
                                                @click="openEdit(JSON.parse($event.currentTarget.dataset.cert))"
                                                class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all cursor-pointer" title="Düzenle">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                            </svg>
                                        </button>

                                        <form action="{{ route('students.certificates.destroy', [$student->id, $cert->id]) }}" method="POST"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Sertifikayı Sil', message: '{{ addslashes($cert->name) }} sertifikasını silmek istediğinize emin misiniz?', form: $el })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer" title="Sil">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- ────────── Modal: Sertifika Ekle / Düzenle ────────── --}}
    <div x-show="modalOpen" x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="closeModal()"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="height: 100dvh;">

        <div @click.outside="closeModal()"
             x-transition:enter="transition ease-out duration-200 delay-75"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl border border-slate-200/50 dark:border-slate-700/50 w-full max-w-2xl flex flex-col overflow-hidden"
             style="max-height: calc(100dvh - 2rem);">

            <form :action="form.id ? updateUrlBase + '/' + form.id + '/update' : storeUrl"
                  method="POST" enctype="multipart/form-data"
                  class="flex flex-col flex-1 min-h-0 overflow-hidden">
                @csrf

                {{-- Header (sabit) --}}
                <div class="flex-shrink-0 flex items-center justify-between px-6 py-5 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white" x-text="form.id ? 'Sertifikayı Düzenle' : 'Yeni Sertifika'"></h3>
                            <p class="text-xs text-slate-400">{{ $student->full_name }}</p>
                        </div>
                    </div>
                    <button type="button" @click="closeModal()" class="p-2 text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition-all cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Body (scroll edilebilir) --}}
                <div class="flex-1 overflow-y-auto p-6 space-y-5" style="min-height: 0;">

                    {{-- Sertifika Türü --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                            Sertifika Türü <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach($certificateTypes as $key => $label)
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="{{ $key }}" x-model="form.type" class="sr-only peer" required>
                                    <div :class="form.type === '{{ $key }}' ? 'border-fuchsia-500 bg-fuchsia-50 dark:bg-fuchsia-900/20 text-fuchsia-700 dark:text-fuchsia-400' : 'border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-slate-300'"
                                         class="px-4 py-2.5 border-2 rounded-xl text-center text-sm font-medium transition-all">
                                        {{ $label }}
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Veren Kurum (tipe göre değişir) --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Veren Kurum <span class="text-red-500" x-show="form.type !== 'kurumsal'">*</span>
                        </label>

                        {{-- Kurumsal: otomatik (readonly bilgi) --}}
                        <div x-show="form.type === 'kurumsal'" x-cloak
                             class="flex items-center gap-2 px-4 py-3 bg-slate-50 dark:bg-slate-700/30 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-600 dark:text-slate-300">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>
                            </svg>
                            <span>Otomatik olarak <strong x-text="siteName"></strong> kaydedilir</span>
                        </div>

                        {{-- Danışmanlık: dropdown --}}
                        <select x-show="form.type === 'danismanlik'" x-cloak
                                name="consulting_institution_id" x-model="form.consulting_institution_id"
                                class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                            <option value="">— Kurum seçin —</option>
                            <template x-for="inst in institutions" :key="inst.id">
                                <option :value="inst.id" x-text="inst.name" :selected="form.consulting_institution_id == inst.id"></option>
                            </template>
                        </select>

                        {{-- Yarışma: serbest metin --}}
                        <input x-show="form.type === 'yarisma'" x-cloak
                               type="text" name="issuer_text" x-model="form.issuer_text"
                               placeholder="Örn: Robotex Türkiye 2026, FRC Bursa Bölgesi..."
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                    </div>

                    {{-- Sertifika Adı --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Sertifika / Başarı Adı <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" x-model="form.name" required maxlength="200"
                               placeholder="Örn: Robotik Eğitimi Tamamlama Belgesi"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        {{-- Branş --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                Branş / Kategori
                            </label>
                            <select name="category_id" x-model="form.category_id"
                                    class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                                <option value="">— Branş seçin —</option>
                                <template x-for="cat in categories" :key="cat.id">
                                    <option :value="cat.id" x-text="cat.name" :selected="form.category_id == cat.id"></option>
                                </template>
                            </select>
                        </div>

                        {{-- Tarih --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                                Veriliş Tarihi <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="issue_date" x-model="form.issue_date" required
                                   class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                        </div>
                    </div>

                    {{-- Sertifika No --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Sertifika Numarası <span class="text-xs text-slate-400 font-normal ml-1">(opsiyonel)</span>
                        </label>
                        <input type="text" name="certificate_number" x-model="form.certificate_number" maxlength="100"
                               placeholder="Belgenin seri / referans numarası"
                               class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all">
                    </div>

                    {{-- Dosya (drop-zone) --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Sertifika Dosyası
                        </label>

                        <label
                            @dragover.prevent="dragging = true"
                            @dragleave.prevent="dragging = false"
                            @drop.prevent="dragging = false; if ($event.dataTransfer.files.length) { $refs.certFileInput.files = $event.dataTransfer.files; handleFileSelect($event.dataTransfer.files); }"
                            :class="dragging
                                ? 'border-fuchsia-500 bg-fuchsia-50/60 dark:bg-fuchsia-900/20 scale-[1.01]'
                                : (fileName
                                    ? 'border-emerald-300 dark:border-emerald-700 bg-emerald-50/40 dark:bg-emerald-900/10'
                                    : 'border-slate-200 dark:border-slate-700 hover:border-fuchsia-400 dark:hover:border-fuchsia-500 hover:bg-fuchsia-50/40 dark:hover:bg-fuchsia-900/10')"
                            class="group block w-full border-2 border-dashed rounded-xl cursor-pointer transition-all duration-200">

                            {{-- Boş hal --}}
                            <template x-if="!fileName">
                                <div class="flex flex-col items-center justify-center text-center px-4 py-7 gap-2.5">
                                    <div :class="dragging ? 'bg-fuchsia-100 dark:bg-fuchsia-900/40 scale-110' : 'bg-slate-100 dark:bg-slate-700 group-hover:bg-fuchsia-100 dark:group-hover:bg-fuchsia-900/30'"
                                         class="w-12 h-12 rounded-xl flex items-center justify-center transition-all">
                                        <svg :class="dragging ? 'text-fuchsia-600' : 'text-slate-400 group-hover:text-fuchsia-500'"
                                             class="w-6 h-6 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p :class="dragging ? 'text-fuchsia-600 dark:text-fuchsia-400' : 'text-slate-700 dark:text-slate-300 group-hover:text-fuchsia-600 dark:group-hover:text-fuchsia-400'"
                                           class="text-sm font-medium transition-colors">
                                            <span x-text="dragging ? 'Bırakın' : 'Dosya seçin ya da sürükleyin'"></span>
                                        </p>
                                        <p class="text-xs text-slate-400 mt-0.5">PDF, PNG, JPEG, WEBP &bull; Maks 10MB</p>
                                    </div>
                                </div>
                            </template>

                            {{-- Seçili hal --}}
                            <template x-if="fileName">
                                <div class="flex items-center justify-between gap-3 px-4 py-3">
                                    <div class="flex items-center gap-3 min-w-0 flex-1">
                                        <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>
                                            </svg>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-slate-900 dark:text-white truncate" x-text="fileName"></p>
                                            <p class="text-xs text-slate-400 mt-0.5" x-text="fileSize"></p>
                                        </div>
                                    </div>
                                    <button type="button"
                                            @click.stop.prevent="clearFile()"
                                            class="flex-shrink-0 p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            <input type="file" name="file" accept=".pdf,.png,.jpg,.jpeg,.webp"
                                   x-ref="certFileInput"
                                   @change="handleFileSelect($event.target.files)"
                                   class="sr-only">
                        </label>

                        {{-- Mevcut dosya bilgisi (sadece düzenleme modunda, yeni dosya seçilmemişken) --}}
                        <p x-show="!fileName && form.id && form.has_file" x-cloak
                           class="mt-2 flex items-center gap-1.5 text-xs text-blue-600 dark:text-blue-400">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                            </svg>
                            Mevcut dosya var — yeni dosya seçerseniz değiştirilir
                        </p>
                    </div>

                    {{-- Notlar --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">
                            Notlar <span class="text-xs text-slate-400 font-normal ml-1">(opsiyonel)</span>
                        </label>
                        <textarea name="notes" x-model="form.notes" rows="3" maxlength="5000"
                                  placeholder="Sertifikaya dair özel bir not ya da başarı detayı..."
                                  class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all resize-y"></textarea>
                    </div>
                </div>

                {{-- Footer (sabit) --}}
                <div class="flex-shrink-0 flex items-center justify-end gap-3 px-6 py-4 border-t border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-800/50">
                    <button type="button" @click="closeModal()"
                            class="px-5 py-2.5 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-colors cursor-pointer">
                        İptal
                    </button>
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700 text-white font-semibold text-sm rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200 active:scale-[.98] cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span x-text="form.id ? 'Güncelle' : 'Kaydet'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    {{-- /Modal --}}
</div>

<script>
    function certificateManager(initial) {
        return {
            ...initial,
            filterType: '',
            modalOpen: false,
            // Drop-zone state
            fileName: '',
            fileSize: '',
            dragging: false,
            init() {
                // Modal açık iken arka plandaki sayfa scroll'unu kilitle
                this.$watch('modalOpen', (value) => {
                    document.body.style.overflow = value ? 'hidden' : '';
                });
            },
            formatFileSize(bytes) {
                if (!bytes && bytes !== 0) return '';
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / 1024 / 1024).toFixed(2) + ' MB';
            },
            handleFileSelect(files) {
                if (files && files.length > 0) {
                    this.fileName = files[0].name;
                    this.fileSize = this.formatFileSize(files[0].size);
                }
            },
            clearFile() {
                this.fileName = '';
                this.fileSize = '';
                if (this.$refs.certFileInput) this.$refs.certFileInput.value = '';
            },
            form: {
                id: null,
                type: 'kurumsal',
                name: '',
                consulting_institution_id: '',
                issuer_text: '',
                category_id: '',
                issue_date: '',
                certificate_number: '',
                notes: '',
                has_file: false,
            },
            blankForm() {
                return {
                    id: null,
                    type: 'kurumsal',
                    name: '',
                    consulting_institution_id: '',
                    issuer_text: '',
                    category_id: '',
                    issue_date: new Date().toISOString().slice(0, 10),
                    certificate_number: '',
                    notes: '',
                    has_file: false,
                };
            },
            openCreate() {
                this.form = this.blankForm();
                this.fileName = '';
                this.fileSize = '';
                this.modalOpen = true;
            },
            openEdit(data) {
                this.form = {
                    id: data.id,
                    type: data.type,
                    name: data.name ?? '',
                    consulting_institution_id: data.consulting_institution_id ?? '',
                    issuer_text: data.issuer_text ?? '',
                    category_id: data.category_id ?? '',
                    issue_date: data.issue_date ?? '',
                    certificate_number: data.certificate_number ?? '',
                    notes: data.notes ?? '',
                    has_file: !!data.has_file,
                };
                this.fileName = '';
                this.fileSize = '';
                this.modalOpen = true;
            },
            closeModal() {
                this.modalOpen = false;
            },
        };
    }
</script>

<style>
    .print-only { display: none; }
    @media print {
        @page { size: A4; margin: 14mm 12mm; }
        body { background: #fff !important; }
        /* Aside, navbar, footer, banner butonları gizle */
        aside, nav, header, .no-print, [x-data] form button[type="submit"].bg-red-50,
        .tab-menu-student, .sidebar, .navbar-wrapper { display: none !important; }
        /* Tüm tabs, page-banner ayarla */
        main, .content-wrapper { padding: 0 !important; margin: 0 !important; box-shadow: none !important; }
        .print-only { display: block !important; }
        /* Tabloyu temizle */
        table { border-collapse: collapse; width: 100%; font-size: 11pt; }
        table thead { background: #f1f5f9 !important; }
        table th, table td { padding: 8px 10px !important; border-bottom: 1px solid #e5e7eb; }
        .shadow-sm, .shadow-lg { box-shadow: none !important; }
        .rounded-2xl, .rounded-xl { border-radius: 0 !important; }
        /* Filtre chipleri, modallar gizle */
        [x-data] [x-show="modalOpen"], [x-cloak] { display: none !important; }
        /* Genel arka plan ve renkler */
        * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    }
</style>
