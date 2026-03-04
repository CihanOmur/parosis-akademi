@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('roles.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Yeni Rol Ekle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Yeni bir rol oluşturun ve izinleri belirleyin</p>
        </div>
    </div>
@endsection

@section('content')
@php
    $permissionGroups = [
        'Kullanıcı Yönetimi' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>',
            'color' => 'blue',
            'perms' => ['user' => 'Kullanıcıları Görüntüle', 'user_delete' => 'Kullanıcı Sil'],
        ],
        'Sınıf Yönetimi' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>',
            'color' => 'emerald',
            'perms' => ['class' => 'Sınıfları Yönet', 'class_delete' => 'Sınıf Sil'],
        ],
        'Öğrenci Yönetimi' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/>',
            'color' => 'violet',
            'perms' => ['student' => 'Öğrencileri Yönet', 'student_delete' => 'Öğrenci Sil'],
        ],
        'Muhasebe' => [
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>',
            'color' => 'amber',
            'perms' => ['accounting' => 'Ödeme & Muhasebe Yönetimi'],
        ],
    ];

    $colorMap = [
        'blue'    => ['bg' => 'bg-blue-100 dark:bg-blue-900/30',    'icon' => 'text-blue-500',    'sel' => 'border-blue-400 dark:border-blue-500 bg-blue-50 dark:bg-blue-900/20',    'check' => 'bg-blue-500 border-blue-500',    'text' => 'text-blue-700 dark:text-blue-300'],
        'emerald' => ['bg' => 'bg-emerald-100 dark:bg-emerald-900/30', 'icon' => 'text-emerald-500', 'sel' => 'border-emerald-400 dark:border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20', 'check' => 'bg-emerald-500 border-emerald-500', 'text' => 'text-emerald-700 dark:text-emerald-300'],
        'violet'  => ['bg' => 'bg-violet-100 dark:bg-violet-900/30',  'icon' => 'text-violet-500',  'sel' => 'border-violet-400 dark:border-violet-500 bg-violet-50 dark:bg-violet-900/20',  'check' => 'bg-violet-500 border-violet-500',  'text' => 'text-violet-700 dark:text-violet-300'],
        'amber'   => ['bg' => 'bg-amber-100 dark:bg-amber-900/30',   'icon' => 'text-amber-500',   'sel' => 'border-amber-400 dark:border-amber-500 bg-amber-50 dark:bg-amber-900/20',   'check' => 'bg-amber-500 border-amber-500',   'text' => 'text-amber-700 dark:text-amber-300'],
    ];

    $allPermNames = collect($permissionGroups)->flatMap(fn($g) => array_keys($g['perms']))->values()->toArray();
    $oldPerms     = old('permissions', []);
@endphp

<form action="{{ route('roles.store') }}" method="POST"
      x-data="{
          roleName: '{{ old('name') }}',
          selectedPerms: {{ json_encode($oldPerms) }},
          allPerms: {{ json_encode($allPermNames) }},
          get permCount() { return this.selectedPerms.length },
          get allSelected() { return this.allPerms.length > 0 && this.allPerms.every(p => this.selectedPerms.includes(p)) },
          toggle(perm) {
              const idx = this.selectedPerms.indexOf(perm);
              if (idx === -1) this.selectedPerms.push(perm);
              else this.selectedPerms.splice(idx, 1);
          },
          has(perm) { return this.selectedPerms.includes(perm); },
          toggleGroup(perms) {
              const allOn = perms.every(p => this.selectedPerms.includes(p));
              perms.forEach(p => {
                  const idx = this.selectedPerms.indexOf(p);
                  if (allOn && idx !== -1) this.selectedPerms.splice(idx, 1);
                  else if (!allOn && idx === -1) this.selectedPerms.push(p);
              });
          },
          groupAllOn(perms) { return perms.every(p => this.selectedPerms.includes(p)); },
          toggleAll() {
              if (this.allSelected) this.selectedPerms = [];
              else this.selectedPerms = [...this.allPerms];
          },
      }">
    @csrf

    {{-- Hidden inputs --}}
    <template x-for="p in selectedPerms" :key="p">
        <input type="hidden" name="permissions[]" :value="p">
    </template>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── Sol: İzin Grupları ────────────────────── --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- Başlık + Tümünü seç --}}
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-slate-700 dark:text-slate-300">İzin Grupları</h2>
                    <p class="text-xs text-slate-400 mt-0.5">
                        <span x-text="permCount"></span> / {{ count($allPermNames) }} izin seçildi
                    </p>
                </div>
                <button type="button" @click="toggleAll()"
                        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-semibold transition-all duration-200 cursor-pointer border"
                        :class="allSelected
                            ? 'bg-fuchsia-50 dark:bg-fuchsia-900/20 border-fuchsia-300 dark:border-fuchsia-700 text-fuchsia-700 dark:text-fuchsia-400'
                            : 'bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:border-fuchsia-300 dark:hover:border-fuchsia-700 hover:text-fuchsia-600 dark:hover:text-fuchsia-400'">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <span x-text="allSelected ? 'Tümünü Kaldır' : 'Tümünü Seç'"></span>
                </button>
            </div>

            @foreach ($permissionGroups as $groupName => $group)
            @php
                $color    = $group['color'];
                $c        = $colorMap[$color];
                $perms    = $group['perms'];
                $permKeys = array_keys($perms);
            @endphp
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">

                {{-- Grup başlığı --}}
                <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl {{ $c['bg'] }} flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 {{ $c['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $group['icon'] !!}
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $groupName }}</p>
                            <p class="text-xs text-slate-400">{{ count($perms) }} izin</p>
                        </div>
                    </div>
                    <button type="button"
                            @click="toggleGroup({{ json_encode($permKeys) }})"
                            class="text-xs font-semibold px-3 py-1.5 rounded-lg transition-all duration-200 cursor-pointer border"
                            :class="groupAllOn({{ json_encode($permKeys) }})
                                ? '{{ $c['sel'] }} border-current/30 {{ $c['text'] }}'
                                : 'bg-slate-50 dark:bg-slate-700/40 border-slate-200 dark:border-slate-700 text-slate-500 hover:{{ $c['text'] }}'">
                        <span x-text="groupAllOn({{ json_encode($permKeys) }}) ? 'Kaldır' : 'Tümünü Seç'"></span>
                    </button>
                </div>

                {{-- İzin kartları --}}
                <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($perms as $permName => $permLabel)
                        @if ($permissions->firstWhere('name', $permName))
                        <button type="button"
                                @click="toggle('{{ $permName }}')"
                                class="flex items-start gap-3 p-4 rounded-xl border-2 text-left transition-all duration-200 cursor-pointer w-full"
                                :class="has('{{ $permName }}')
                                    ? '{{ $c['sel'] }}'
                                    : 'border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-700/30 hover:border-slate-300 dark:hover:border-slate-600'">
                            {{-- Checkmark --}}
                            <div class="flex-shrink-0 mt-0.5 w-5 h-5 rounded-md border-2 flex items-center justify-center transition-all duration-200"
                                 :class="has('{{ $permName }}')
                                     ? '{{ $c['check'] }}'
                                     : 'border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700'">
                                <svg x-show="has('{{ $permName }}')" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold transition-colors"
                                   :class="has('{{ $permName }}') ? '{{ $c['text'] }}' : 'text-slate-700 dark:text-slate-300'">
                                    {{ $permLabel }}
                                </p>
                                <p class="text-xs font-mono text-slate-400 mt-0.5">{{ $permName }}</p>
                            </div>
                        </button>
                        @endif
                    @endforeach
                </div>
            </div>
            @endforeach

            @error('permissions')
                <p class="text-sm text-red-500 flex items-center gap-1.5">
                    <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- ── Sağ: Rol Bilgisi + Önizleme ─────────── --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Canlı önizleme --}}
            <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-2xl p-5 text-white shadow-xl shadow-fuchsia-500/20 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-28 h-28 bg-white/10 rounded-full -translate-y-8 translate-x-8"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-full translate-y-6 -translate-x-4"></div>
                <div class="relative">
                    <p class="text-fuchsia-100 text-xs font-medium uppercase tracking-wider mb-3">Önizleme</p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="font-semibold text-base leading-tight truncate" x-text="roleName || 'Rol Adı'"></p>
                            <p class="text-fuchsia-200 text-sm mt-0.5" x-text="permCount + ' izin atandı'"></p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Rol Adı --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Rol Adı</h3>
                <x-text-input name="name" placeholder="örn: Muhasebeci, Koordinatör"
                    x-model="roleName" />
            </div>

            {{-- İzin özeti --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Seçilen İzinler</h3>
                <div x-show="permCount === 0" class="text-sm text-slate-400 text-center py-2">
                    Henüz izin seçilmedi
                </div>
                <div class="flex flex-wrap gap-1.5">
                    <template x-for="p in selectedPerms" :key="p">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-xs font-medium
                                     bg-fuchsia-50 dark:bg-fuchsia-900/20 text-fuchsia-700 dark:text-fuchsia-400
                                     border border-fuchsia-200/60 dark:border-fuchsia-800/40">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd"/></svg>
                            <span x-text="p"></span>
                        </span>
                    </template>
                </div>
            </div>

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
                    Rolü Kaydet
                </button>
                <a href="{{ route('roles.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    İptal
                </a>
            </div>

        </div>
    </div>
</form>
@endsection
