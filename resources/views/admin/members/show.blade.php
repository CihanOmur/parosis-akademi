@extends('admin.layouts.app')

@section('page-banner')
    <div class="w-full">
        <div class="flex items-center gap-3">
            <x-back-button :href="route('members.index')" />
            <div class="min-w-0">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $member->name }}</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Üye #{{ $member->id }}</p>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Sol: bilgiler --}}
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Üye Bilgileri</h3>
                @if($member->is_active)
                    <span class="inline-flex items-center rounded-full bg-emerald-50 dark:bg-emerald-900/40 px-2.5 py-1 text-xs font-medium text-emerald-700 dark:text-emerald-300">Aktif</span>
                @else
                    <span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-700 px-2.5 py-1 text-xs font-medium text-slate-600 dark:text-slate-300">Pasif</span>
                @endif
            </div>
            <dl class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <dt class="text-xs text-slate-400 uppercase">Ad soyad</dt>
                    <dd class="mt-1 text-sm text-slate-700 dark:text-slate-200">{{ $member->name }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-400 uppercase">E-posta</dt>
                    <dd class="mt-1 text-sm"><a href="mailto:{{ $member->email }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline break-all">{{ $member->email }}</a></dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-400 uppercase">Telefon</dt>
                    <dd class="mt-1 text-sm">
                        @if($member->phone)
                            <a href="tel:{{ $member->phone }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline">{{ $member->phone }}</a>
                        @else
                            <span class="text-slate-400">—</span>
                        @endif
                    </dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-400 uppercase">Kayıt tarihi</dt>
                    <dd class="mt-1 text-sm text-slate-700 dark:text-slate-200">{{ $member->created_at->format('d.m.Y H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-400 uppercase">Son giriş</dt>
                    <dd class="mt-1 text-sm text-slate-700 dark:text-slate-200">{{ $member->last_login_at ? $member->last_login_at->format('d.m.Y H:i') : '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-400 uppercase">Gizlilik Politikası onayı</dt>
                    <dd class="mt-1 text-sm text-slate-700 dark:text-slate-200">{{ $member->privacy_accepted_at ? $member->privacy_accepted_at->format('d.m.Y H:i') : '—' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Siparişler (üyeyken verilenler — orders.member_id) --}}
        <div id="uye-siparisleri" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Siparişler</h3>
                <span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-700 px-2.5 py-1 text-xs font-medium text-slate-600 dark:text-slate-300">{{ $orderCount }}</span>
            </div>
            @if($orders->isEmpty())
                <p class="px-6 py-5 text-sm text-slate-400">Bu üyenin hesabına bağlı sipariş yok.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Sipariş No</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tarih</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Toplam</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Durum</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                            @foreach($orders as $order)
                                <tr>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        @can('shop')
                                            <a href="{{ route('orders.show', $order->id) }}" class="font-semibold text-slate-900 dark:text-white hover:text-fuchsia-600 dark:hover:text-fuchsia-400">#{{ $order->order_number }}</a>
                                        @else
                                            <span class="font-semibold text-slate-900 dark:text-white">#{{ $order->order_number }}</span>
                                        @endcan
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-slate-500 dark:text-slate-400">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap font-medium text-slate-900 dark:text-white">{{ number_format($order->total, 2, ',', '.') }} ₺</td>
                                    <td class="px-6 py-3">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium {{ $order->status_color }}">{{ $order->status_label }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($orderCount > $orders->count())
                    <p class="px-6 py-3 text-xs text-slate-400">Son {{ $orders->count() }} sipariş gösteriliyor.</p>
                @endif
            @endif
        </div>

        {{-- Kurs başvuruları (üyeyken yapılanlar — course_applications.member_id) --}}
        <div id="uye-basvurulari" class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
            <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Başvurular</h3>
                <span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-700 px-2.5 py-1 text-xs font-medium text-slate-600 dark:text-slate-300">{{ $applicationCount }}</span>
            </div>
            @if($applications->isEmpty())
                <p class="px-6 py-5 text-sm text-slate-400">Bu üyenin hesabına bağlı kurs başvurusu yok.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kurs</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Öğrenci</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tarih</th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Durum</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/50">
                            @foreach($applications as $application)
                                <tr>
                                    <td class="px-6 py-3 text-slate-900 dark:text-white">{{ $application->course?->getTranslation('title', 'tr') ?: '—' }}</td>
                                    <td class="px-6 py-3 text-slate-700 dark:text-slate-200">{{ $application->student_name }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap text-slate-500 dark:text-slate-400">{{ $application->created_at->format('d.m.Y H:i') }}</td>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        @if($application->status === 'contacted')
                                            <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 dark:bg-emerald-900/40 px-2.5 py-1 text-xs font-medium text-emerald-700 dark:text-emerald-300">✓ Görüşüldü</span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-50 dark:bg-amber-900/40 px-2.5 py-1 text-xs font-medium text-amber-700 dark:text-amber-300">Bekliyor</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @canany(['course', 'course_delete'])
                    <p class="px-6 py-3 text-xs"><a href="{{ route('course-applications.index') }}" class="text-fuchsia-600 dark:text-fuchsia-400 hover:underline">Tüm kurs başvuruları →</a></p>
                @endcanany
            @endif
        </div>
    </div>

    {{-- Sağ: işlemler --}}
    <div class="space-y-5 sticky top-24 self-start">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5 space-y-3">
            <form action="{{ route('members.toggle', $member->id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 font-semibold text-sm rounded-xl transition-all duration-200 cursor-pointer
                               {{ $member->is_active
                                   ? 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 hover:bg-slate-200 dark:hover:bg-slate-600'
                                   : 'bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700 text-white shadow-lg shadow-fuchsia-500/25' }}">
                    {{ $member->is_active ? 'Pasifleştir' : 'Aktifleştir' }}
                </button>
            </form>
            <p class="text-xs text-slate-400">Pasif üye siteye giriş yapamaz; açık oturumu ilk sayfa geçişinde kapanır.</p>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
            <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Şifre Sıfırla</h3>
            <form action="{{ route('members.password', $member->id) }}" method="POST" class="space-y-3">
                @csrf
                <x-text-input name="password" type="text" placeholder="Yeni şifre (en az 8 karakter)" autocomplete="off" />
                <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                               bg-gradient-to-r from-fuchsia-500 to-purple-600 hover:from-fuchsia-600 hover:to-purple-700
                               text-white font-semibold text-sm rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200 cursor-pointer">
                    Şifreyi Değiştir
                </button>
                <p class="text-xs text-slate-400">Yeni şifreyi üyeye siz iletin. (E-postayla şifre sıfırlama, mail ayarları yapılınca eklenecek.)</p>
            </form>
        </div>

        @can('member_delete')
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-red-200/60 dark:border-red-900/40 p-5">
            <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Bu üyeyi silmek istediğinize emin misiniz? Bu işlem geri alınamaz.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full inline-flex items-center justify-center px-5 py-3 text-sm font-semibold text-red-600 dark:text-red-400 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors cursor-pointer">
                    Üyeyi Sil
                </button>
            </form>
        </div>
        @endcan
    </div>
</div>
@endsection
