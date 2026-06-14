{{--
    Öğrenci profili → Yarışmalar sekmesi
    - Üstte: "Yarışmaya Ekle" select + buton
    - Tablo: yarışma adı, statü chip'leri (veli izin/pasaport/vize/ödeme), sonuç, aksiyonlar
    - Alpine state ile statü ve sonuç modalı
--}}

@php
    $statusBadge = [
        'parent_consent' => [
            'bekliyor'      => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
            'alindi'        => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'teslim_edildi' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
        ],
        'passport' => [
            'yok'            => 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300',
            'var'            => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
            'kontrol_edildi' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
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
@endphp

<div x-data="competitionManager()" class="space-y-5">

    {{-- Sertifika önerisi (yarışma sonucu girildikten sonra flash ile gelir) --}}
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
                    {{ $sg['result_label'] }} sonucuyla otomatik bir "Yarışma" tipi sertifika ekleyebiliriz.
                </div>
            </div>
            <form action="{{ route('students.competitions.createCertificate', [$student->id, $sg['entry_id']]) }}" method="POST" class="flex-shrink-0">
                @csrf
                <button type="submit"
                        class="inline-flex items-center gap-2 px-4 py-2 text-xs font-semibold text-white
                               bg-gradient-to-r from-fuchsia-500 to-purple-600
                               hover:from-fuchsia-600 hover:to-purple-700 rounded-lg
                               shadow-md shadow-fuchsia-500/25 transition-all">
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
            <form action="{{ route('students.competitions.attach', $student->id) }}" method="POST" class="flex flex-col sm:flex-row sm:items-end gap-3">
                @csrf
                <div class="flex-1">
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Yarışmaya Ekle</label>
                    <select name="competition_id" required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm text-slate-700 dark:text-slate-200 focus:ring-2 focus:ring-fuchsia-500/30 focus:border-fuchsia-500">
                        <option value="">Yarışma seçin...</option>
                        @foreach($availableCompetitions as $c)
                            <option value="{{ $c->id }}">
                                {{ $c->name }}
                                @if($c->start_date) — {{ $c->start_date->format('d.m.Y') }} @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5
                               bg-gradient-to-r from-fuchsia-500 to-purple-600
                               hover:from-fuchsia-600 hover:to-purple-700
                               text-white font-semibold text-sm rounded-xl
                               shadow-lg shadow-fuchsia-500/25 transition-all cursor-pointer whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Yarışmaya Ekle
                </button>
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
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Yarışma</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Veli İzin</th>
                            <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pasaport</th>
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
                                $entryPayload = [
                                    'entry_id'              => $p->id,
                                    'competition_name'      => $comp->name,
                                    'parent_consent_status' => $p->parent_consent_status,
                                    'passport_status'       => $p->passport_status,
                                    'visa_status'           => $p->visa_status,
                                    'payment_status'        => $p->payment_status,
                                    'payment_amount'        => $p->payment_amount,
                                    'payment_currency'      => $p->payment_currency ?: 'TRY',
                                    'joined_at'             => $p->joined_at ? \Carbon\Carbon::parse($p->joined_at)->format('Y-m-d') : null,
                                    'result_rank'           => $p->result_rank,
                                    'result_label'          => $p->result_label,
                                    'result_notes'          => $p->result_notes,
                                ];
                            @endphp
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                                <td class="px-6 py-4">
                                    <a href="{{ route('competitions.show', $comp->id) }}" class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                        {{ $comp->name }}
                                    </a>
                                    @if($comp->organizer || $comp->start_date)
                                        <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                                            {{ $comp->organizer }}
                                            @if($comp->start_date)
                                                <span class="ml-1">· {{ $comp->start_date->format('d.m.Y') }}</span>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['parent_consent'][$p->parent_consent_status] ?? '' }}">
                                        {{ \App\Models\CompetitionStudent::PARENT_CONSENT[$p->parent_consent_status] ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusBadge['passport'][$p->passport_status] ?? '' }}">
                                        {{ \App\Models\CompetitionStudent::PASSPORT[$p->passport_status] ?? '—' }}
                                    </span>
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
                                        <div class="text-[10px] text-slate-400 mt-0.5">
                                            {{ number_format($p->payment_amount, 2, ',', '.') }} {{ $p->payment_currency }}
                                        </div>
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
                                                class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all cursor-pointer" title="Sonuç Gir / Düzenle">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172"/>
                                            </svg>
                                        </button>
                                        <form action="{{ route('students.competitions.detach', [$student->id, $p->id]) }}" method="POST"
                                              x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Yarışmadan Çıkar', message: '{{ addslashes($comp->name) }} yarışmasından öğrenciyi çıkartmak istediğinize emin misiniz?', form: $el })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer" title="Yarışmadan Çıkar">
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

    {{-- Statü Modalı --}}
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
                    <button type="button" @click="statusOpen = false" class="p-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-5" style="min-height: 0;">
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
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Pasaport</label>
                            <select name="passport_status" x-model="form.passport_status"
                                    class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                                @foreach($statusOptions['passport'] as $key => $label)
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
                    </div>

                    <div class="border-t border-dashed border-slate-200 dark:border-slate-700/60"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Kayıt Ücreti (opsiyonel)</label>
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

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Katılım Tarihi (opsiyonel)</label>
                        <input type="date" name="joined_at" x-model="form.joined_at"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-2 flex-shrink-0">
                    <button type="button" @click="statusOpen = false" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all">İptal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700 rounded-xl shadow-md shadow-fuchsia-500/25 transition-all">Kaydet</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Sonuç Modalı --}}
    <div x-show="resultOpen" x-cloak
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm"
         style="height: 100dvh"
         @keydown.escape.window="resultOpen = false">
        <div @click.outside="resultOpen = false"
             class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl w-full max-w-lg flex flex-col"
             style="max-height: calc(100dvh - 2rem);">
            <form :action="resultActionUrl()" method="POST" class="flex flex-col flex-1 min-h-0 overflow-hidden">
                @csrf
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex-shrink-0">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Yarışma Sonucu</h3>
                        <p class="text-xs text-slate-400 mt-0.5" x-text="form.competition_name"></p>
                    </div>
                    <button type="button" @click="resultOpen = false" class="p-1.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto p-6 space-y-5" style="min-height: 0;">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Sıralama (opsiyonel)</label>
                        <input type="number" name="result_rank" x-model="form.result_rank" min="1" max="9999" placeholder="Örn: 3"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Sonuç Etiketi (opsiyonel)</label>
                        <input type="text" name="result_label" x-model="form.result_label" maxlength="100" placeholder="Örn: Gold Medal, Yarı Final, Katılım"
                               class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 mb-1.5">Notlar (opsiyonel)</label>
                        <textarea name="result_notes" x-model="form.result_notes" rows="4" maxlength="5000"
                                  class="w-full px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-900 text-sm"
                                  placeholder="Performans hakkında notlar..."></textarea>
                    </div>
                </div>

                <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700 flex items-center justify-end gap-2 flex-shrink-0">
                    <button type="button" @click="resultOpen = false" class="px-4 py-2 text-sm font-medium text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition-all">İptal</button>
                    <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700 rounded-xl shadow-md shadow-fuchsia-500/25 transition-all">Kaydet</button>
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
            form: {
                entry_id: null,
                competition_name: '',
                parent_consent_status: 'bekliyor',
                passport_status: 'yok',
                visa_status: 'gerekli_degil',
                payment_status: 'bekliyor',
                payment_amount: '',
                payment_currency: 'TRY',
                joined_at: '',
                result_rank: '',
                result_label: '',
                result_notes: '',
            },
            init() {
                this.$watch('statusOpen', (v) => { document.body.style.overflow = (v || this.resultOpen) ? 'hidden' : ''; });
                this.$watch('resultOpen', (v) => { document.body.style.overflow = (v || this.statusOpen) ? 'hidden' : ''; });
            },
            openStatusModal(data) {
                this.form = {
                    ...this.form,
                    entry_id:             data.entry_id,
                    competition_name:     data.competition_name,
                    parent_consent_status: data.parent_consent_status,
                    passport_status:      data.passport_status,
                    visa_status:          data.visa_status,
                    payment_status:       data.payment_status,
                    payment_amount:       data.payment_amount ?? '',
                    payment_currency:     data.payment_currency ?? 'TRY',
                    joined_at:            data.joined_at ?? '',
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
                };
                this.resultOpen = true;
            },
            statusActionUrl() {
                return this.urlBase + '/' + this.form.entry_id + '/statuses';
            },
            resultActionUrl() {
                return this.urlBase + '/' + this.form.entry_id + '/result';
            },
        };
    }
</script>
