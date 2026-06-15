@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Yarışmalar</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Öğrencilerin katılabileceği yarışmaları yönetin</p>
    </div>
    <a href="{{ route('competitions.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Yeni Yarışma Ekle
    </a>
@endsection

@section('content')
    {{-- Kategori filtresi --}}
    @if($allCategories->isNotEmpty())
        <div class="mb-5 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-4">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider mr-1">Kategori Filtresi:</span>
                <a href="{{ route('competitions.index') }}"
                   class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-all
                          {{ !request('category_id') ? 'bg-slate-900 dark:bg-slate-700 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600' }}">
                    Tümü
                </a>
                @foreach($allCategories as $cat)
                    <a href="{{ route('competitions.index', ['category_id' => $cat->id]) }}"
                       class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-all
                              {{ (int) request('category_id') === $cat->id ? 'bg-slate-900 dark:bg-slate-700 text-white shadow-sm' : 'bg-slate-100 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-600' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    @if($competitions->isEmpty())
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-16 text-center">
            <svg class="w-14 h-14 mx-auto text-slate-300 dark:text-slate-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872"/>
            </svg>
            <p class="text-slate-500 dark:text-slate-400 text-sm">
                @if(request('category_id'))
                    Bu kategoriye ait yarışma bulunamadı.
                @else
                    Henüz yarışma eklenmemiş.
                @endif
            </p>
            <a href="{{ route('competitions.create') }}" class="inline-block mt-3 text-fuchsia-600 dark:text-fuchsia-400 hover:underline text-sm font-medium">
                İlk yarışmayı ekleyin
            </a>
        </div>
    @else
        <div id="cards-grid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
            @foreach($competitions as $item)
                <div data-id="{{ $item->id }}"
                     class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-lg transition-all duration-200 border border-slate-200/50 dark:border-slate-700/50 overflow-hidden flex flex-col">

                    {{-- Header gradient --}}
                    <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 p-5 text-white relative">
                        <div class="absolute top-3 right-3 sortable-handle cursor-grab active:cursor-grabbing opacity-50 hover:opacity-100 transition-opacity">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </div>

                        <div class="flex items-start gap-3 pr-8">
                            <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center flex-shrink-0 backdrop-blur-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-.871M7.5 18.75v-3.375c0-.621.504-1.125 1.125-1.125h.872m5.007 0H9.497m5.007 0a7.454 7.454 0 0 1-.982-3.172M9.497 14.25a7.454 7.454 0 0 0 .981-3.172"/>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="font-bold text-base leading-tight">
                                    <a href="{{ route('competitions.edit', $item->id) }}" class="hover:underline">{{ $item->name }}</a>
                                </h3>
                                @if($item->organizer)
                                    <p class="text-xs text-white/80 mt-1 truncate">{{ $item->organizer }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="p-5 space-y-3 flex-1">
                        {{-- Ülke / Şehir --}}
                        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/>
                            </svg>
                            <span>{{ $item->country_city ?: '—' }}</span>
                        </div>

                        {{-- Tarih aralığı --}}
                        <div class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-300">
                            <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                            </svg>
                            <span>{{ $item->date_range ?: '—' }}</span>
                        </div>

                        {{-- Kurum içi son kayıt tarihi (varsa) --}}
                        @if($item->internal_deadline)
                            <div class="flex items-center gap-2 text-sm">
                                <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                <span class="text-amber-700 dark:text-amber-400 font-medium">Son kayıt: {{ $item->internal_deadline->format('d.m.Y') }}</span>
                            </div>
                        @endif

                        {{-- Kategoriler --}}
                        @if($item->categories->isNotEmpty())
                            <div class="flex flex-wrap gap-1 pt-1">
                                @foreach($item->categories as $cat)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-medium bg-fuchsia-50 dark:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400">
                                        {{ $cat->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        @if($item->website_url)
                            <a href="{{ $item->website_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1 text-xs text-blue-600 dark:text-blue-400 hover:underline">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/>
                                </svg>
                                Yarışma sitesi
                            </a>
                        @endif
                    </div>

                    {{-- Footer --}}
                    <div class="px-5 py-3 bg-slate-50 dark:bg-slate-900/40 border-t border-slate-100 dark:border-slate-700/50 flex items-center justify-between">
                        <x-count-badge
                            :count="$item->participants_count"
                            label="öğrenci"
                            :href="route('competitions.show', $item->id)"
                            color="fuchsia">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/></svg>
                        </x-count-badge>

                        <div class="flex items-center gap-2">
                            <label class="inline-flex items-center gap-2 cursor-pointer" title="Aktif/Pasif">
                                <div class="relative">
                                    <input type="checkbox" class="sr-only peer status-toggle" data-id="{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                    <div class="w-9 h-5 bg-slate-300 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:after:translate-x-full transition-colors"></div>
                                </div>
                            </label>

                            <a href="{{ route('competitions.edit', $item->id) }}"
                               class="p-1.5 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all" title="Düzenle">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                </svg>
                            </a>

                            <form action="{{ route('competitions.delete', $item->id) }}" method="POST"
                                  x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Yarışmayı Sil', message: '{{ addslashes($item->name) }} yarışmasını silmek istediğinize emin misiniz?', form: $el })">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer" title="Sil">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    const grid = document.getElementById('cards-grid');
    if (grid) {
        Sortable.create(grid, {
            handle: '.sortable-handle',
            animation: 150,
            chosenClass: 'shadow-2xl',
            onEnd: function () {
                const order = Array.from(grid.querySelectorAll('[data-id]'))
                    .map(function (el) { return parseInt(el.dataset.id); });
                axios.post('{{ route("competitions.updateOrder") }}', { order: order, _token: csrfToken })
                    .then(function (r) { if (r.data.status === 1) showToast('success', r.data.message); })
                    .catch(function () { showToast('error', 'Sıralama güncellenirken bir hata oluştu.'); });
            }
        });
    }

    document.querySelectorAll('.status-toggle').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const id = this.dataset.id;
            const prev = !this.checked;
            const self = this;
            axios.post('/panel/competitions/' + id + '/toggle', { _token: csrfToken })
                .then(function (r) {
                    if (r.data.status === 1) showToast('success', r.data.message);
                    else { showToast('error', r.data.message); self.checked = prev; }
                })
                .catch(function () { showToast('error', 'Bir hata oluştu.'); self.checked = prev; });
        });
    });
</script>
@endsection
