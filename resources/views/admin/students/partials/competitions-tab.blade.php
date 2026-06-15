{{--
    Öğrenci profili → Yarışmalar sekmesi (v2)
    - Atama formu: yarışma + kategori + takım adı
    - Tablo: kategori/takım, statü chip'leri, sonuç, dosya, aksiyonlar
    - Modaller: statü (passport checkbox), sonuç (file upload)
--}}

@php
    $statusBadge = [
        'parent_consent' => [
            'bekliyor'      => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
            'alindi'        => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'teslim_edildi' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
        ],
        'visa' => [
            'gerekli_degil' => 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300',
            'basvuruldu'    => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
            'onaylandi'     => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
            'reddedildi'    => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
        ],
        'payment' => [
            'bekliyor' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
            'kismi'    => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'odendi'   => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
        ],
    ];

    // Tüm aktif yarışmalar için kategori listesi (atama formu seçim için)
    $allCompetitionsWithCategories = $availableCompetitions->load('categories');
@endphp

<div x-data="competitionManager()" class="space-y-5">

    {{-- Sertifika önerisi --}}
    @if(session('suggestCertificate'))
        @php $sg = session('suggestCertificate'); @endphp
        <div class="bg-gradient-to-r from-fuchsia-50 to-purple-50 dark:from-fuchsia-900/20 dark:to-purple-900/20 border border-fuchsia-200/60 dark:border-fuchsia-700/40 rounded-2xl p-5 flex items-start gap-4">
            <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/25">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <div class="text-sm font-semibold text-slate-900 dark:text-white">Sertifika oluşturulsun mu?</div>
                <div class="text-xs text-slate-600 dark:text-slate-300 mt-0.5">
                    <strong>{{ $sg['competition'] }}</strong> yarışması için
                    {{ $sg['result_rank'] ? '#' . $sg['result_rank'] . ' sırada' : '' }}
                    {{ $sg['result_label'] }} sonucuyla otomatik bir sertifika ekleyebiliriz.
                </div>
            </div>
            <form action="{{ route('students.competitions.createCertificate', [$student->id, $sg['entry_id']]) }}" method="POST" class="flex-shrink-0">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700 rounded-lg shadow-md shadow-fuchsia-500/25 transition-all">
                    Sertifika Oluştur
                </button>
            </form>
        </div>
    @endif

    {{-- Yarışmaya Ekle --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
        @if($availableCompetitions->isEmpty())
            <div class="flex items-center gap-3 text-sm text-slate-500 dark:text-slate-400">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                </svg>
                <span>Eklenebilecek başka yarışma yok. Önce <a href="{{ route('competitions.create') }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline font-medium">yeni yarışma ekleyin</a>.</span>
            </div>
        @else
            <form action="{{ route('students.competitions.attach', $student->id) }}" method="POST" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                @csrf
                <div class="sm:col-span-5">
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">İlgili Yarışma</label>
                    <select name="competition_id" required x-model="attachCompetitionId"
                            class="w-full px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                        <option value="">Yarışma seçin...</option>
                        @foreach($allCompetitionsWithCategories as $c)
                            <option value="{{ $c->id }}"
                                    data-categories='@json($c->categories->map(fn($cat) => ["id" => $cat->id, "name" => $cat->name]))'>
                                {{ $c->name }}@if($c->start_date) — {{ $c->start_date->format('d.m.Y') }} @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-3">
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Kategori</label>
                    <select name="competition_category_id" x-ref="attachCategorySelect"
                            class="w-full px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm"
                            :disabled="attachCategories.length === 0">
                        <option value="">— Yok / Hepsi —</option>
                        <template x-for="cat in attachCategories" :key="cat.id">
                            <option :value="cat.id" x-text="cat.name"></option>
                        </template>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Takım</label>
                    <input type="text" name="team_name" maxlength="200" placeholder="Opsiyonel"
                           class="w-full px-3 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                </div>
                <div class="sm:col-span-2 flex items-end">
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-2.5
                                   bg-gradient-to-r from-fuchsia-500 to-purple-600
                                   hover:from-fuchsia-600 hover:to-purple-700
                                   text-white font-semibold text-sm rounded-xl
                                   shadow-lg shadow-fuchsia-500/25 transition-all cursor-pointer whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Ekle
                    </button>
                </div>
            </form>
        @endif
    </div>

    {{-- Liste --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        @if($student->competitions->isEmpty())
            <div class="p-16 text-center">
                <svg class="w-14 h-14 mx-auto text-slate-300 dark:text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872"/>
                </svg>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Bu öğrenci henüz hiçbir yarışmaya katılmamış.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Yarışma / Kategori / Takım</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Veli İzin</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-24 text-center">Pasaport</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Vize</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Ödeme</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sonuç</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-44 text-right">İşlem</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                        @foreach($student->competitions as $comp)
                            @php
                                $p = $comp->pivot;
                                // Pivot relations için CompetitionStudent objesi al
                                $entry = \App\Models\CompetitionStudent::with('category')->find($p->id);
                                $categoryName = $entry?->category?->name;
                                $compCategories = $comp->categories ?? collect();
                                $entryPayload = [
                                    'entry_id'                => $p->id,
                                    'competition_id'          => $comp->id,
                                    'competition_name'        => $comp->name,
                                    'competition_categories'  => $compCategories->map(fn($cat) => ['id' => $cat->id, 'name' => $cat->name])->values(),
                                    'competition_category_id' => $p->competition_category_id,
                                    'team_name'               => $p->team_name,
                                    'parent_consent_status'   => $p->parent_consent_status,
                                    'passport_valid_6m'       => (bool) $p->passport_valid_6m,
                                    'visa_status'             => $p->visa_status,
                                    'payment_status'          => $p->payment_status,
                                    'payment_amount'          => $p->payment_amount,
                                    'payment_currency'        => $p->payment_currency ?: 'TRY',
                                    'joined_at'               => $p->joined_at ? \Carbon\Carbon::parse($p->joined_at)->format('Y-m-d') : null,
                                    'result_rank'             => $p->result_rank,
                                    'result_label'            => $p->result_label,
                                    'result_notes'            => $p->result_notes,
                                    'has_file'                => (bool) $p->result_file,
                                ];
                            @endphp
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <a href="{{ route('competitions.show', $comp->id) }}" class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                        {{ $comp->name }}
                                    </a>
                                    <div class="flex flex-wrap items-center gap-1.5 mt-1">
                                        @if($categoryName)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium bg-fuchsia-50 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400">{{ $categoryName }}</span>
                                        @endif
                                        @if($p->team_name)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">👥 {{ $p->team_name }}</span>
                                        @endif
                                        @if($comp->start_date)
                                            <span class="text-[10px] text-slate-400">{{ $comp->start_date->format('d.m.Y') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['parent_consent'][$p->parent_consent_status] ?? '' }}">
                                        {{ \App\Models\CompetitionStudent::PARENT_CONSENT[$p->parent_consent_status] ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($p->passport_valid_6m)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400" title="6 ay geçerli">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            OK
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['visa'][$p->visa_status] ?? '' }}">
                                        {{ \App\Models\CompetitionStudent::VISA[$p->visa_status] ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['payment'][$p->payment_status] ?? '' }}">
                                        {{ \App\Models\CompetitionStudent::PAYMENT[$p->payment_status] ?? '—' }}
                                    </span>
                                    @if($p->payment_amount)
                                        <div class="text-[10px] text-slate-400 mt-0.5">{{ number_format($p->payment_amount, 2, ',', '.') }} {{ $p->payment_currency }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-slate-600 dark:text-slate-300">
                                    @if($p->result_rank)
                                        <span class="inline-flex items-center gap-1">
                                            <span class="text-base font-bold text-fuchsia-600">{{ $p->result_rank }}.</span>
                                            {{ $p->result_label }}
                                        </span>
                                    @elseif($p->result_label)
                                        {{ $p->result_label }}
                                    @else
                                        <span class="text-slate-400 italic text-xs">—</span>
                                    @endif
                                    @if($p->result_file)
                                        <a href="{{ route('students.competitions.resultFile', [$student->id, $p->id]) }}" class="ml-1 inline-flex text-blue-600 hover:underline" title="Sertifika/madalya dosyası">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5.586a1 1 0 0 1 .707.293l5.414 5.414a1 1 0 0 1 .293.707V19a2 2 0 0 1-2 2Z"/></svg>
                                        </a>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="inline-flex items-center gap-1">
                                        <button type="button"
                                                data-entry='@json($entryPayload)'
                                                @click="openStatusModal(JSON.parse($event.currentTarget.dataset.entry))"
                                                class="p-2 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all cursor-pointer" title="Statüleri Düzenle">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75"/>
                                            </svg>
                                        </button>
                                        <button type="button"
                                                data-entry='@json($entryPayload)'
                                                @click="openResultModal(JSON.parse($event.currentTarget.dataset.entry))"
                                                class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all cursor-pointer" title="Sonuç Düzenle">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872"/>
                                            </svg>
                                        </button>
                                        <form action="{{ route('students.competitions.detach', [$student->id, $p->id]) }}" method="POST"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Yarışmadan Çıkar', message: '{{ addslashes($comp->name) }} yarışmasından öğrenciyi çıkartmak istediğinize emin misiniz?', form: $el })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer" title="Yarışmadan Çıkar">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79"/>
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

    {{-- STATÜ MODALI --}}
    <div x-show="statusOpen" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="height: 100dvh"
         @keydown.escape.window="statusOpen = false">
        <div @click.outside="statusOpen = false"
             class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-2xl flex flex-col"
             style="max-height: calc(100dvh - 2rem);">
            <form :action="statusActionUrl()" method="POST" class="flex flex-col flex-1 min-h-0 overflow-hidden">
                @csrf
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex-shrink-0">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Statüleri Düzenle</h3>
                        <p class="text-xs text-slate-400 mt-0.5" x-text="form.competition_name"></p>
                    </div>
                    <button type="button" @click="statusOpen = false" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-5" style="min-height: 0;">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Kategori</label>
                            <select name="competition_category_id" x-model="form.competition_category_id"
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                                <option value="">— Yok —</option>
                                <template x-for="cat in form.competition_categories" :key="cat.id">
                                    <option :value="cat.id" x-text="cat.name"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Takım Adı</label>
                            <input type="text" name="team_name" x-model="form.team_name" maxlength="200" placeholder="Opsiyonel"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                        </div>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Veli İzin Belgesi</label>
                            <select name="parent_consent_status" x-model="form.parent_consent_status"
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                                @foreach($statusOptions['parent_consent'] as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Vize</label>
                            <select name="visa_status" x-model="form.visa_status"
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                                @foreach($statusOptions['visa'] as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Ödeme Durumu</label>
                            <select name="payment_status" x-model="form.payment_status"
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                                @foreach($statusOptions['payment'] as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Katılım Tarihi</label>
                            <input type="date" name="joined_at" x-model="form.joined_at"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                        </div>
                    </div>

                    {{-- Pasaport checkbox --}}
                    <div class="bg-slate-50 dark:bg-slate-900/40 rounded-xl p-4">
                        <label class="inline-flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="passport_valid_6m" value="1" x-model="form.passport_valid_6m"
                                   class="w-5 h-5 mt-0.5 rounded border-slate-300 text-fuchsia-600 focus:ring-fuchsia-500">
                            <div>
                                <div class="text-sm font-medium text-slate-700 dark:text-slate-200">Pasaport Kontrolü</div>
                                <div class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Yarışma tarihi itibariyle pasaport +6 ay geçerli mi?</div>
                            </div>
                        </label>
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Kayıt Ücreti</label>
                            <input type="number" name="payment_amount" x-model="form.payment_amount" step="0.01" min="0" placeholder="0.00"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Para Birimi</label>
                            <select name="payment_currency" x-model="form.payment_currency"
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                                @foreach($statusOptions['currencies'] as $cur)
                                    <option value="{{ $cur }}">{{ $cur }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-2 flex-shrink-0">
                    <button type="button" @click="statusOpen = false" class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl">İptal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700 rounded-xl shadow-md shadow-fuchsia-500/25">Kaydet</button>
                </div>
            </form>
        </div>
    </div>

    {{-- SONUÇ MODALI --}}
    <div x-show="resultOpen" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="height: 100dvh"
         @keydown.escape.window="resultOpen = false">
        <div @click.outside="resultOpen = false"
             class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-lg flex flex-col"
             style="max-height: calc(100dvh - 2rem);">
            <form :action="resultActionUrl()" method="POST" enctype="multipart/form-data" class="flex flex-col flex-1 min-h-0 overflow-hidden">
                @csrf
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex-shrink-0">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Yarışma Sonucu</h3>
                        <p class="text-xs text-slate-400 mt-0.5" x-text="form.competition_name"></p>
                    </div>
                    <button type="button" @click="resultOpen = false" class="p-1.5 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-5" style="min-height: 0;">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Sıralama</label>
                            <input type="number" name="result_rank" x-model="form.result_rank" min="1" max="9999" placeholder="3"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Sonuç Etiketi</label>
                            <input type="text" name="result_label" x-model="form.result_label" maxlength="100" placeholder="Örn: Katılımcı, Dünya 1.si, Jüri Özel Ödülü"
                                   class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Notlar</label>
                        <textarea name="result_notes" x-model="form.result_notes" rows="3" maxlength="5000"
                                  class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm" placeholder="Performans hakkında notlar..."></textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Sertifika / Madalya Dosyası</label>

                        {{-- Gizli native input --}}
                        <input type="file" name="result_file" x-ref="resultFileInput" accept=".pdf,.png,.jpg,.jpeg,.webp"
                               @change="handleFileSelect($event.target.files)" class="sr-only">

                        {{-- Drop-zone --}}
                        <div @click="$refs.resultFileInput.click()"
                             @dragover.prevent="dragging = true"
                             @dragleave.prevent="dragging = false"
                             @drop.prevent="dragging = false; handleFileSelect($event.dataTransfer.files); $refs.resultFileInput.files = $event.dataTransfer.files"
                             :class="dragging ? 'border-fuchsia-500 bg-fuchsia-50 dark:bg-fuchsia-900/20' : (fileName ? 'border-emerald-400 bg-emerald-50 dark:bg-emerald-900/10' : 'border-slate-300 dark:border-slate-600 hover:border-fuchsia-400 hover:bg-fuchsia-50/30 dark:hover:bg-fuchsia-900/10')"
                             class="relative cursor-pointer border-2 border-dashed rounded-xl p-5 text-center transition-all">

                            {{-- Seçilmiş dosya görünümü --}}
                            <template x-if="fileName">
                                <div class="flex items-center gap-3 text-left">
                                    <div class="w-10 h-10 rounded-lg bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9-9 9 4.03 9 9Z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-semibold text-slate-900 dark:text-white truncate" x-text="fileName"></p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400" x-text="fileSize"></p>
                                    </div>
                                    <button type="button" @click.stop="clearFile()"
                                            class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all"
                                            title="Dosyayı kaldır">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                            </template>

                            {{-- Boş hâl --}}
                            <template x-if="!fileName">
                                <div class="flex flex-col items-center gap-2">
                                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-fuchsia-500/10 to-purple-500/10 dark:from-fuchsia-500/20 dark:to-purple-500/20 flex items-center justify-center"
                                         :class="dragging ? 'scale-110' : ''"
                                         style="transition: transform .15s ease">
                                        <svg class="w-6 h-6 text-fuchsia-600 dark:text-fuchsia-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-700 dark:text-slate-200">
                                            <span class="text-fuchsia-600 dark:text-fuchsia-400 font-semibold">Tıkla</span>
                                            veya dosyayı buraya sürükle
                                        </p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">PDF, PNG, JPG, WEBP — max 10MB</p>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <template x-if="form.has_file && !fileName">
                            <p class="text-[11px] text-emerald-600 dark:text-emerald-400 mt-1.5 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd"/></svg>
                                Önceden yüklenmiş bir dosya var. Yeni dosya seçimi eskisini değiştirir.
                            </p>
                        </template>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-2 flex-shrink-0">
                    <button type="button" @click="resultOpen = false" class="px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 rounded-xl">İptal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700 rounded-xl shadow-md shadow-fuchsia-500/25">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function competitionManager() {
        return {
            statusOpen: false,
            resultOpen: false,
            studentId: {{ $student->id }},
            urlBase: '{{ url('panel/students/' . $student->id . '/competitions') }}',
            attachCompetitionId: '',
            attachCategories: [],
            fileName: '',
            fileSize: '',
            dragging: false,
            form: {
                entry_id: null,
                competition_id: null,
                competition_name: '',
                competition_categories: [],
                competition_category_id: '',
                team_name: '',
                parent_consent_status: 'bekliyor',
                passport_valid_6m: false,
                visa_status: 'gerekli_degil',
                payment_status: 'bekliyor',
                payment_amount: '',
                payment_currency: 'TRY',
                joined_at: '',
                result_rank: '',
                result_label: '',
                result_notes: '',
                has_file: false,
            },
            init() {
                this.$watch('statusOpen', (v) => { document.body.style.overflow = (v || this.resultOpen) ? 'hidden' : ''; });
                this.$watch('resultOpen', (v) => { document.body.style.overflow = (v || this.statusOpen) ? 'hidden' : ''; });
                this.$watch('attachCompetitionId', (val) => {
                    const select = this.$el.querySelector('select[name="competition_id"]');
                    if (!select) return;
                    const opt = select.querySelector('option[value="' + val + '"]');
                    if (opt && opt.dataset.categories) {
                        try { this.attachCategories = JSON.parse(opt.dataset.categories); }
                        catch (e) { this.attachCategories = []; }
                    } else {
                        this.attachCategories = [];
                    }
                });
            },
            openStatusModal(data) {
                this.form = {
                    ...this.form,
                    entry_id:                data.entry_id,
                    competition_id:          data.competition_id,
                    competition_name:        data.competition_name,
                    competition_categories:  data.competition_categories ?? [],
                    competition_category_id: data.competition_category_id ?? '',
                    team_name:               data.team_name ?? '',
                    parent_consent_status:   data.parent_consent_status,
                    passport_valid_6m:       !!data.passport_valid_6m,
                    visa_status:             data.visa_status,
                    payment_status:          data.payment_status,
                    payment_amount:          data.payment_amount ?? '',
                    payment_currency:        data.payment_currency ?? 'TRY',
                    joined_at:               data.joined_at ?? '',
                };
                this.statusOpen = true;
            },
            openResultModal(data) {
                this.form = {
                    ...this.form,
                    entry_id:         data.entry_id,
                    competition_name: data.competition_name,
                    result_rank:      data.result_rank ?? '',
                    result_label:     data.result_label ?? '',
                    result_notes:     data.result_notes ?? '',
                    has_file:         !!data.has_file,
                };
                this.fileName = '';
                this.fileSize = '';
                this.dragging = false;
                this.resultOpen = true;
            },
            handleFileSelect(files) {
                if (!files || !files.length) return;
                const f = files[0];
                this.fileName = f.name;
                this.fileSize = this.formatFileSize(f.size);
            },
            clearFile() {
                this.fileName = '';
                this.fileSize = '';
                if (this.$refs.resultFileInput) this.$refs.resultFileInput.value = '';
            },
            formatFileSize(bytes) {
                if (bytes < 1024) return bytes + ' B';
                if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
                return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
            },
            statusActionUrl()  { return this.urlBase + '/' + this.form.entry_id + '/statuses'; },
            resultActionUrl()  { return this.urlBase + '/' + this.form.entry_id + '/result'; },
        };
    }
</script>
