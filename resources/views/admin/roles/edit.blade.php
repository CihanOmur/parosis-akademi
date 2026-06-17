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
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Rol Düzenle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                <span class="font-semibold text-fuchsia-600 dark:text-fuchsia-400">{{ $role->name }}</span>
                rolünü düzenleyin
            </p>
        </div>
    </div>
@endsection

@section('content')
@php
    // $permissionGroups + $colorMap controller'dan geliyor (App\Http\Controllers\Role\RoleController)
    $allPermNames    = collect($permissionGroups)->flatMap(fn($g) => array_keys($g['perms']))->values()->toArray();
    $rolePermissions = old('permissions', $role->permissions->pluck('name')->toArray());
@endphp

<form action="{{ route('roles.update', $role->id) }}" method="POST"
      x-data="{
          roleName: '{{ addslashes(old('name', $role->name)) }}',
          selectedPerms: {{ json_encode($rolePermissions) }},
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

    <template x-for="p in selectedPerms" :key="p">
        <input type="hidden" name="permissions[]" :value="p">
    </template>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── Sol: İzin Grupları ────────────────────── --}}
        <div class="lg:col-span-2 space-y-4">

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
                            : 'bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 hover:border-fuchsia-300 hover:text-fuchsia-600 dark:hover:text-fuchsia-400'">
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
                                ? '{{ $c['sel'] }} {{ $c['text'] }}'
                                : 'bg-slate-50 dark:bg-slate-700/40 border-slate-200 dark:border-slate-700 text-slate-500'">
                        <span x-text="groupAllOn({{ json_encode($permKeys) }}) ? 'Kaldır' : 'Tümünü Seç'"></span>
                    </button>
                </div>

                <div class="p-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($perms as $permName => $permLabel)
                        @if ($permissions->firstWhere('name', $permName))
                        <button type="button"
                                @click="toggle('{{ $permName }}')"
                                class="flex items-start gap-3 p-4 rounded-xl border-2 text-left transition-all duration-200 cursor-pointer w-full"
                                :class="has('{{ $permName }}')
                                    ? '{{ $c['sel'] }}'
                                    : 'border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-700/30 hover:border-slate-300 dark:hover:border-slate-600'">
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

            <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-2xl p-5 text-white shadow-xl shadow-fuchsia-500/20 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-28 h-28 bg-white/10 rounded-full -translate-y-8 translate-x-8"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-full translate-y-6 -translate-x-4"></div>
                <div class="relative">
                    <p class="text-fuchsia-100 text-xs font-medium uppercase tracking-wider mb-3">Canlı Önizleme</p>
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

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Rol Adı</h3>
                <x-text-input name="name" placeholder="örn: Muhasebeci, Koordinatör"
                    :value="$role->name"
                    x-model="roleName" />
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Aktif İzinler</h3>
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

            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Rol Bilgisi</h3>
                <div class="space-y-2.5">
                    <div class="flex items-center gap-2.5">
                        <span class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-xs text-slate-400">Rol ID</p>
                            <p class="text-sm font-mono font-semibold text-slate-700 dark:text-slate-300">#{{ $role->id }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <span class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"/>
                            </svg>
                        </span>
                        <div>
                            <p class="text-xs text-slate-400">Kullanıcı Sayısı</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ $role->users()->count() }} kullanıcı</p>
                        </div>
                    </div>
                </div>
            </div>

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
                    Güncelle
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

                <button type="submit" form="role-delete-form"
                        class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                               bg-red-50 dark:bg-red-900/10 hover:bg-red-100 dark:hover:bg-red-900/20
                               text-red-600 dark:text-red-400 font-medium text-sm rounded-xl
                               border border-red-200/60 dark:border-red-800/30
                               transition-all duration-200 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                    </svg>
                    Rolü Sil
                </button>
            </div>

        </div>
    </div>
</form>

{{-- Ana form'un DISINDA: nested form HTML standartlarinca yasak, browser ignore eder --}}
<form id="role-delete-form" action="{{ route('roles.delete', $role->id) }}" method="POST"
      x-data @submit.prevent="$dispatch('confirm-dialog', {
          title: 'Rolü Sil',
          message: '{{ addslashes($role->name) }} rolünü silmek istediğinize emin misiniz?',
          form: $el
      })">
    @csrf
    @method('DELETE')
</form>
@endsection
