@extends('admin.layouts.app')

@section('page-banner')
    <div class="flex items-center gap-4">
        <a href="{{ route('users.index') }}"
           class="p-2 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300
                  rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kullanıcı Düzenle</h1>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                <span class="font-semibold text-fuchsia-600 dark:text-fuchsia-400">{{ $user->name }}</span>
                hesabını düzenleyin
            </p>
        </div>
    </div>
@endsection

@section('content')
@php
    $userRoles = old('role', $user->roles->pluck('name')->toArray());
@endphp

<form action="{{ route('users.update', $user->id) }}" method="POST"
      x-data="{
          name: '{{ addslashes(old('name', $user->name)) }}',
          showPass: false,
          selectedRoles: {{ json_encode($userRoles) }},
          get initials() {
              const parts = this.name.trim().split(' ').filter(Boolean);
              if (parts.length >= 2) return (parts[0][0] + parts[parts.length-1][0]).toUpperCase();
              if (parts.length === 1) return parts[0].slice(0,2).toUpperCase();
              return '??';
          },
          toggleRole(val) {
              const idx = this.selectedRoles.indexOf(val);
              if (idx === -1) this.selectedRoles.push(val);
              else this.selectedRoles.splice(idx, 1);
          },
          hasRole(val) { return this.selectedRoles.includes(val); }
      }">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── Sol kolon ──────────────────────── --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Kişisel Bilgiler --}}
            <div class="relative bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-fuchsia-50/50 via-transparent to-purple-50/30 dark:from-fuchsia-950/20 dark:to-purple-950/10 pointer-events-none"></div>

                <div class="relative flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-fuchsia-500 to-purple-600 flex items-center justify-center shadow-md shadow-fuchsia-500/20 flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Kişisel Bilgiler</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Ad, e-posta ve telefon bilgileri</p>
                    </div>
                </div>

                <div class="relative p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Ad Soyad --}}
                    <div class="sm:col-span-2 space-y-1">
                        <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Ad Soyad <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                          d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                                </svg>
                            </span>
                            <input type="text" name="name" id="name"
                                   x-model="name"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                          text-slate-900 dark:text-white placeholder-slate-400
                                          ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                   placeholder="örn: Ahmet Yılmaz" value="{{ old('name', $user->name) }}">
                        </div>
                        @error('name')
                            <p class="text-sm text-red-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- E-posta --}}
                    <div class="space-y-1">
                        <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            E-posta <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                                </svg>
                            </span>
                            <input type="email" name="email" id="email"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                          text-slate-900 dark:text-white placeholder-slate-400
                                          ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                   placeholder="ornek@parosis.com" value="{{ old('email', $user->email) }}">
                        </div>
                        @error('email')
                            <p class="text-sm text-red-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Telefon --}}
                    <div class="space-y-1">
                        <label for="phone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                            Telefon <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
                                </svg>
                            </span>
                            <input type="tel" name="phone" id="phone"
                                   pattern="[0-9]*" inputmode="numeric"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                   maxlength="13"
                                   class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                          text-slate-900 dark:text-white placeholder-slate-400
                                          ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-fuchsia-500/60 transition-all"
                                   placeholder="05551234567" value="{{ old('phone', $user->phone) }}">
                        </div>
                        @error('phone')
                            <p class="text-sm text-red-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Güvenlik --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Şifre Değiştir</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Boş bırakırsanız mevcut şifre korunur</p>
                    </div>
                </div>

                <div class="p-6 space-y-1">
                    <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                        Yeni Şifre
                        <span class="text-xs font-normal text-slate-400 ml-1">(opsiyonel)</span>
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                            <svg class="w-4.5 h-4.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z"/>
                            </svg>
                        </span>
                        <input :type="showPass ? 'text' : 'password'"
                               name="password" id="password" maxlength="230"
                               class="w-full pl-10 pr-12 py-3 bg-slate-50 dark:bg-slate-700/70 border-0 rounded-xl text-sm
                                      text-slate-900 dark:text-white placeholder-slate-400
                                      ring-1 ring-slate-200 dark:ring-slate-600 focus:ring-2 focus:ring-emerald-500/50 transition-all"
                               placeholder="Yeni şifre giriniz...">
                        <button type="button" @click="showPass = !showPass"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                            <svg x-show="!showPass" class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                            <svg x-show="showPass" class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-sm text-red-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            {{-- Roller --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50">
                <div class="flex items-center gap-3 px-6 pt-6 pb-4 border-b border-slate-100 dark:border-slate-700/50">
                    <div class="w-9 h-9 rounded-xl bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4.5 h-4.5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-base font-semibold text-slate-900 dark:text-white">Roller</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Kullanıcının sahip olacağı roller</p>
                    </div>
                    <span class="text-xs font-medium px-2.5 py-1 rounded-lg bg-violet-50 dark:bg-violet-900/20 text-violet-600 dark:text-violet-400 border border-violet-100 dark:border-violet-800/40"
                          x-text="selectedRoles.length + ' seçili'"></span>
                </div>

                <div class="p-6">
                    <template x-for="r in selectedRoles" :key="r">
                        <input type="hidden" name="role[]" :value="r">
                    </template>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($roles as $role)
                        <button type="button"
                                @click="toggleRole('{{ $role->name }}')"
                                class="relative flex items-start gap-3.5 p-4 rounded-xl border-2 text-left transition-all duration-200 cursor-pointer"
                                :class="hasRole('{{ $role->name }}')
                                    ? 'border-violet-400 dark:border-violet-500 bg-violet-50 dark:bg-violet-900/20'
                                    : 'border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-700/30 hover:border-slate-300 dark:hover:border-slate-600'">
                            <div class="flex-shrink-0 mt-0.5 w-5 h-5 rounded-md border-2 flex items-center justify-center transition-all duration-200"
                                 :class="hasRole('{{ $role->name }}')
                                     ? 'bg-violet-500 border-violet-500'
                                     : 'border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700'">
                                <svg x-show="hasRole('{{ $role->name }}')" class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold transition-colors"
                                   :class="hasRole('{{ $role->name }}') ? 'text-violet-700 dark:text-violet-300' : 'text-slate-700 dark:text-slate-300'">
                                    {{ $role->name }}
                                </p>
                                @if($role->permissions->count())
                                <p class="text-xs text-slate-400 mt-0.5 truncate">{{ $role->permissions->pluck('name')->join(', ') }}</p>
                                @else
                                <p class="text-xs text-slate-400 mt-0.5">İzin tanımlanmamış</p>
                                @endif
                            </div>
                        </button>
                        @endforeach
                    </div>

                    @error('role')
                        <p class="mt-3 text-sm text-red-500 flex items-center gap-1.5">
                            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0v-4.5A.75.75 0 0 1 10 5Zm0 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- ── Sağ kolon ──────────────────────── --}}
        <div class="space-y-5 sticky top-24 self-start">

            {{-- Avatar önizleme --}}
            <div class="bg-gradient-to-br from-fuchsia-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl shadow-fuchsia-500/20 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-28 h-28 bg-white/10 rounded-full -translate-y-8 translate-x-8"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/5 rounded-full translate-y-6 -translate-x-4"></div>
                <div class="relative flex flex-col items-center text-center gap-3">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-sm border border-white/30 flex items-center justify-center shadow-inner">
                        <span x-text="initials" class="text-xl font-extrabold tracking-wider"></span>
                    </div>
                    <div>
                        <p class="font-semibold text-base leading-tight" x-text="name || 'Kullanıcı Adı'"></p>
                        <div class="flex flex-wrap justify-center gap-1 mt-2">
                            @foreach($user->roles as $r)
                                <span class="text-xs px-2 py-0.5 bg-white/20 rounded-full font-medium">{{ $r->name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Meta bilgiler --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200/50 dark:border-slate-700/50 p-5">
                <h3 class="text-sm font-semibold text-slate-900 dark:text-white mb-3">Hesap Bilgileri</h3>
                <div class="space-y-2.5">
                    <div class="flex items-center gap-2.5">
                        <span class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                            </svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Kullanıcı ID</p>
                            <p class="text-sm font-mono font-semibold text-slate-700 dark:text-slate-300">#{{ $user->id }}</p>
                        </div>
                    </div>
                    @if($user->created_at)
                    <div class="flex items-center gap-2.5">
                        <span class="w-7 h-7 rounded-lg bg-slate-100 dark:bg-slate-700 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                            </svg>
                        </span>
                        <div class="min-w-0">
                            <p class="text-xs text-slate-400">Kayıt Tarihi</p>
                            <p class="text-sm font-semibold text-slate-700 dark:text-slate-300">
                                {{ $user->created_at->format('d.m.Y') }}
                            </p>
                        </div>
                    </div>
                    @endif
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
                    Güncelle
                </button>
                <a href="{{ route('users.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                          bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700
                          text-slate-600 dark:text-slate-400 font-medium text-sm rounded-xl
                          border border-slate-200/60 dark:border-slate-600/50 transition-all duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    İptal
                </a>

                @can('user_delete')
                <form action="{{ route('users.delete', $user->id) }}" method="POST"
                      x-data @submit.prevent="$dispatch('confirm-dialog', {
                          title: 'Kullanıcıyı Sil',
                          message: '{{ addslashes($user->name) }} adlı kullanıcıyı silmek istediğinize emin misiniz?',
                          form: $el
                      })">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3
                                   bg-red-50 dark:bg-red-900/10 hover:bg-red-100 dark:hover:bg-red-900/20
                                   text-red-600 dark:text-red-400 font-medium text-sm rounded-xl
                                   border border-red-200/60 dark:border-red-800/30
                                   transition-all duration-200 cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                        Kullanıcıyı Sil
                    </button>
                </form>
                @endcan
            </div>

        </div>
    </div>
</form>
@endsection
