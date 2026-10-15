{{-- Üye giriş formu — başlıktaki pencerede ($inModal = true) ve /uye/giris sayfasında kullanılır --}}
@php
    $inModal = $inModal ?? false;
    $idSuffix = $inModal ? '-modal' : '';
    $loginErrors = $errors->getBag('memberLogin');
    $inputClass = 'w-full rounded border px-5 py-4 text-sm text-colorBlackPearl outline-none transition-all placeholder:text-colorBlackPearl/55 focus-visible:border-colorPurpleBlue';
@endphp
<form action="{{ route('front.member.login.post') }}" method="post" class="grid w-80 grid-cols-1 gap-y-[22px] sm:w-[374px]">
    @csrf
    @if($inModal)
        <input type="hidden" name="from" value="modal" />
    @endif

    @if($loginErrors->any())
        <div class="rounded bg-colorJasper/10 px-4 py-3 text-sm text-colorJasper">
            @foreach($loginErrors->all() as $error)<p>{{ $error }}</p>@endforeach
        </div>
    @endif

    <input type="email" name="email" value="{{ old('email') }}" required maxlength="190" autocomplete="email" placeholder="{{ __('member.email_placeholder') }}"
           class="{{ $inputClass }} {{ $loginErrors->has('email') ? 'border-colorJasper' : 'border-[#D7D7D7]' }}" />
    <input type="password" name="password" required maxlength="255" autocomplete="current-password" placeholder="{{ __('member.password_placeholder') }}"
           class="{{ $inputClass }} {{ $loginErrors->has('password') ? 'border-colorJasper' : 'border-[#D7D7D7]' }}" />
    <label for="member-remember{{ $idSuffix }}" class="mt-3.5 flex items-center gap-x-3 text-sm text-[#8D8D8D]">
        <span class="relative">
            <input type="checkbox" name="remember" value="1" id="member-remember{{ $idSuffix }}" class="peer opacity-0" @checked(old('remember')) />
            <span class="absolute left-0 top-1/2 inline-block h-4 w-4 -translate-y-1/2 rounded-[50%] border border-colorBlackPearl/75 peer-checked:bg-colorBlackPearl/75"></span>
        </span>
        {{ __('member.remember') }}
    </label>
    <div>
        <button type="submit" class="btn btn-primary is-icon group">
            {{ __('member.login') }}
            <span class="btn-icon bg-white group-hover:right-0 group-hover:translate-x-full">
                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
            </span>
            <span class="btn-icon bg-white group-hover:left-[5px] group-hover:translate-x-0">
                <img src="{{ asset('assets-front/img/icons/icon-purple-arrow-right.svg') }}" alt="icon-purple-arrow-right" width="13" height="12" />
            </span>
        </button>
    </div>
</form>
