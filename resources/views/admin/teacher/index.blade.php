@extends('admin.layouts.app')

@section('page-banner')
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Eğitmen Yönetimi</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Eğitmenleri yönetin</p>
    </div>
    <a href="{{ route('teachers.create') }}"
       class="inline-flex items-center gap-2 px-6 py-3
              bg-gradient-to-r from-fuchsia-500 to-purple-500
              hover:from-fuchsia-600 hover:to-purple-600
              text-white font-semibold rounded-xl
              shadow-lg shadow-fuchsia-500/25 transition-all duration-200">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Yeni Eğitmen Ekle
    </a>
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 dark:bg-slate-700/50">
                    <tr>
                        <th class="w-10 px-3 py-4"></th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-16">Resim</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">İsim</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Unvan</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-28">Durum</th>
                        <th class="px-6 py-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider w-48">İşlem</th>
                    </tr>
                </thead>
                <tbody id="sortable-body" class="divide-y divide-slate-100 dark:divide-slate-700/50">
                    @forelse ($teachers as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors" data-id="{{ $item->id }}" id="row-{{ $item->id }}">
                            <td class="px-3 py-4 cursor-grab active:cursor-grabbing sortable-handle">
                                <svg class="w-5 h-5 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </td>
                            <td class="px-6 py-4">
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('teachers.edit', $item->id) }}"
                                   class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400 transition-colors">
                                    {{ $item->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-slate-500 dark:text-slate-400">{{ $item->title }}</td>
                            <td class="px-6 py-4">
                                <label class="inline-flex items-center gap-2.5 cursor-pointer">
                                    <div class="relative">
                                        <input type="checkbox" class="sr-only peer status-toggle" data-id="{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-slate-200 dark:bg-slate-600 rounded-full peer peer-checked:bg-fuchsia-500 after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full transition-colors duration-200"></div>
                                    </div>
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300" id="status-label{{ $item->id }}">
                                        {{ $item->is_active ? 'Aktif' : 'Pasif' }}
                                    </span>
                                </label>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('teachers.edit', $item->id) }}"
                                       class="p-2 text-slate-400 hover:text-fuchsia-600 dark:hover:text-fuchsia-400 hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20 rounded-lg transition-all" title="Düzenle">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z"/>
                                        </svg>
                                    </a>

                                    {{-- Çeviriler dropdown --}}
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" type="button"
                                                class="p-2 text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-lg transition-all cursor-pointer" title="Çeviriler">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/>
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="opacity-0 scale-95"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-75"
                                             x-transition:leave-start="opacity-100 scale-100"
                                             x-transition:leave-end="opacity-0 scale-95"
                                             class="absolute right-0 mt-1 w-48 z-20 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-200/50 dark:border-slate-700/50 py-1 overflow-hidden">
                                            @foreach ($activeLanguages as $activeLang)
                                                <a href="{{ route('teachers.editTranslate', ['id' => $item->id, 'lang' => $activeLang->locale]) }}"
                                                   class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-medium
                                                          text-slate-600 dark:text-slate-300
                                                          hover:bg-fuchsia-50 dark:hover:bg-fuchsia-900/20
                                                          hover:text-fuchsia-600 dark:hover:text-fuchsia-400
                                                          transition-all">
                                                    <span class="w-6 h-6 rounded-md bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-[10px] font-bold text-slate-500 dark:text-slate-400 flex-shrink-0">
                                                        {{ strtoupper(substr($activeLang->locale, 0, 2)) }}
                                                    </span>
                                                    {{ $activeLang->name ?: $activeLang->locale }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>

                                    <form action="{{ route('teachers.delete', $item->id) }}" method="POST"
                                          x-data @submit.prevent="$dispatch('confirm-dialog', { title: 'Eğitmeni Sil', message: 'Bu eğitmeni silmek istediğinize emin misiniz?', form: $el })">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all cursor-pointer" title="Sil">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                                    </svg>
                                    <p class="text-slate-500 dark:text-slate-400">Henüz eğitmen eklenmemiş.</p>
                                    <a href="{{ route('teachers.create') }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline text-sm font-medium">
                                        İlk eğitmeni ekleyin
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    const sortableBody = document.getElementById('sortable-body');
    if (sortableBody) {
        Sortable.create(sortableBody, {
            handle: '.sortable-handle',
            animation: 150,
            ghostClass: 'bg-fuchsia-50',
            chosenClass: 'shadow-lg',
            onEnd: function () {
                const order = Array.from(sortableBody.querySelectorAll('tr[data-id]'))
                    .map(function (row) { return parseInt(row.dataset.id); });

                axios.post('{{ route("teachers.updateOrder") }}', {
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

    document.querySelectorAll('.status-toggle').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            const itemId    = this.dataset.id;
            const label     = document.getElementById('status-label' + itemId);
            const prevState = !this.checked;
            const self      = this;

            axios.post('/panel/teachers/' + itemId + '/toggle', { _token: csrfToken })
            .then(function (response) {
                if (response.data.status === 1) {
                    showToast('success', response.data.message);
                    if (label) label.textContent = response.data.action;
                } else {
                    showToast('error', response.data.message);
                    self.checked = prevState;
                }
            })
            .catch(function () {
                showToast('error', 'Bir hata oluştu.');
                self.checked = prevState;
            });
        });
    });
</script>
@endsection
