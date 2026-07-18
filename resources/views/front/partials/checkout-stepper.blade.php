{{-- Ödeme Süreci Stepper: Sepet → Ödeme → Onay --}}
@php
    $currentStep = $currentStep ?? 1; // 1: Sepet, 2: Ödeme, 3: Onay
    $steps = [
        ['label' => 'Sepet',  'href' => route('front.cart', app()->getLocale())],
        ['label' => 'Ödeme',  'href' => route('front.checkout', app()->getLocale())],
        ['label' => 'Onay',   'href' => null], // Confirm sadece POST sonrası
    ];
@endphp

<div class="mb-8 lg:mb-10">
    <ol class="mx-auto flex max-w-2xl items-center justify-between">
        @foreach($steps as $i => $step)
            @php
                $stepNo = $i + 1;
                $isDone = $stepNo < $currentStep;
                $isCurrent = $stepNo === $currentStep;
                $isPending = $stepNo > $currentStep;

                $circleClasses = $isDone
                    ? 'bg-colorPurpleBlue text-white'
                    : ($isCurrent
                        ? 'bg-colorPurpleBlue text-white ring-4 ring-colorPurpleBlue/20'
                        : 'bg-slate-200 text-slate-500');

                $labelClasses = $isDone || $isCurrent
                    ? 'text-colorBlackPearl font-semibold'
                    : 'text-slate-400';

                $lineClasses = $isDone
                    ? 'bg-colorPurpleBlue'
                    : 'bg-slate-200';
            @endphp
            <li class="flex flex-1 items-center @if($i === count($steps) - 1) flex-none @endif">
                <div class="flex flex-col items-center gap-2">
                    @if($step['href'] && ($isDone || $isCurrent))
                        <a href="{{ $step['href'] }}" class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-bold transition-all {{ $circleClasses }}">
                            @if($isDone)
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            @else
                                {{ $stepNo }}
                            @endif
                        </a>
                    @else
                        <div class="flex h-10 w-10 items-center justify-center rounded-full text-sm font-bold {{ $circleClasses }}">
                            @if($isDone)
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                            @else
                                {{ $stepNo }}
                            @endif
                        </div>
                    @endif
                    <span class="text-xs md:text-sm {{ $labelClasses }}">{{ $step['label'] }}</span>
                </div>
                @if($i < count($steps) - 1)
                    <div class="mx-2 mb-6 h-0.5 flex-1 {{ $lineClasses }}"></div>
                @endif
            </li>
        @endforeach
    </ol>
</div>
