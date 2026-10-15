{{-- Üye kayıt formu — başlıktaki pencerede ($inModal = true) ve /uye/kayit sayfasında kullanılır --}}
@php
    $inModal = $inModal ?? false;
    $idSuffix = $inModal ? '-modal' : '';
    $registerErrors = $errors->getBag('memberRegister');
    $inputClass = 'w-full rounded border px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue';
    $borderFor = fn ($field) => $registerErrors->has($field) ? 'border-colorJasper' : 'border-[#D7D7D7]';
@endphp
<form action="{{ route('front.member.register.post') }}" method="post" class="relative grid w-80 grid-cols-1 gap-y-[22px] sm:w-[374px]">
    @csrf
    @if($inModal)
        <input type="hidden" name="from" value="modal" />
    @endif

    {{-- Bot tuzağı: kullanıcı görmez, doldurulursa kayıt yapılmaz --}}
    <div aria-hidden="true" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">
        <label for="member-website{{ $idSuffix }}">{{ __('member.website_label') }}</label>
        <input type="text" name="website" id="member-website{{ $idSuffix }}" tabindex="-1" autocomplete="off" />
    </div>

    @if($registerErrors->any())
        <div class="rounded bg-colorJasper/10 px-4 py-3 text-sm text-colorJasper">
            @foreach($registerErrors->all() as $error)<p>{{ $error }}</p>@endforeach
        </div>
    @endif

    <input type="text" name="name" value="{{ old('name') }}" required maxlength="150" autocomplete="name" placeholder="{{ __('member.name_placeholder') }}"
           class="{{ $inputClass }} {{ $borderFor('name') }}" />
    <input type="email" name="email" value="{{ old('email') }}" required maxlength="190" autocomplete="email" placeholder="{{ __('member.email_placeholder') }}"
           class="{{ $inputClass }} {{ $borderFor('email') }}" />
    <input type="tel" name="phone" value="{{ old('phone') }}" required maxlength="30" inputmode="tel" autocomplete="tel" placeholder="{{ __('member.phone_placeholder') }}"
           class="{{ $inputClass }} {{ $borderFor('phone') }}" />
    <input type="password" name="password" required minlength="8" maxlength="255" autocomplete="new-password" placeholder="{{ __('member.new_password_placeholder') }}"
           class="{{ $inputClass }} {{ $borderFor('password') }}" />
    <input type="password" name="password_confirmation" required minlength="8" maxlength="255" autocomplete="new-password" placeholder="{{ __('member.password_confirm_placeholder') }}"
           class="{{ $inputClass }} {{ $borderFor('password') }}" />
    <label for="member-privacy{{ $idSuffix }}" class="mt-3.5 flex items-center gap-x-3 text-sm text-[#8D8D8D]">
        <span class="relative">
            <input type="checkbox" name="privacy" value="1" id="member-privacy{{ $idSuffix }}" class="peer opacity-0" required @checked(old('privacy')) />
            <span class="absolute left-0 top-1/2 inline-block h-4 w-4 -translate-y-1/2 rounded-[50%] border border-colorBlackPearl/75 peer-checked:bg-colorBlackPearl/75"></span>
        </span>
        <span>{!! __('member.privacy_accept', ['link' => '<a href="'.e(route('front.privacy')).'" target="_blank" rel="noopener" class="font-medium text-colorPurpleBlue underline underline-offset-2 hover:text-colorBlackPearl">'.e(__('member.privacy_policy')).'</a>']) !!}</span>
    </label>
    <div>
        <button type="submit" class="btn btn-primary is-icon group">
            {{ __('member.register') }}
            <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
            </span>
            <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
            </span>
        </button>
    </div>
</form>
