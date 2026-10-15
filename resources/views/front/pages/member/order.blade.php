@extends('front.layouts.app')

@section('title', ($globalSettings['seo']['meta_title'] ?? 'Parosis Akademi') . ' | ' . __('member.order_title', ['number' => $order->order_number]))

@php
    $cardClass = 'rounded-lg bg-white p-6 shadow-[0_4px_30px_16px] shadow-[#070229]/5 lg:p-8';
    $money = fn ($amount) => number_format((float) $amount, 2, ',', '.') . ' ₺';
    $orderBadge = [
        'pending'    => 'bg-yellow-100 text-yellow-800',
        'processing' => 'bg-blue-100 text-blue-800',
        'shipped'    => 'bg-purple-100 text-purple-800',
        'delivered'  => 'bg-green-100 text-green-800',
        'cancelled'  => 'bg-red-100 text-red-800',
    ];
    $addressLine = implode(' / ', array_filter([$order->shipping_district, $order->shipping_city]));
@endphp

@section('content')
    @include('front.partials.member-breadcrumb', ['title' => __('member.order_title', ['number' => $order->order_number]), 'current' => __('member.order_details')])

    <section class="section-member">
        <div class="bg-white">
            <div class="section-space">
                <div class="container">
                    <div class="mx-auto max-w-[1000px]">

                        <div class="mb-8">
                            <a href="{{ route('front.account') }}#siparislerim" class="inline-flex items-center gap-2 text-sm font-medium text-colorPurpleBlue hover:text-colorBlackPearl">
                                <span aria-hidden="true">&larr;</span> {{ __('member.back_to_account') }}
                            </a>
                        </div>

                        {{-- Özet: sipariş no, tarih, durum --}}
                        <div class="{{ $cardClass }} mb-8">
                            <dl class="grid grid-cols-1 gap-5 text-sm sm:grid-cols-3">
                                <div class="min-w-0">
                                    <dt>{{ __('member.order_number') }}</dt>
                                    <dd class="mt-1 break-all font-semibold text-colorBlackPearl">{{ $order->order_number }}</dd>
                                </div>
                                <div>
                                    <dt>{{ __('member.date') }}</dt>
                                    <dd class="mt-1 font-semibold text-colorBlackPearl">{{ $order->created_at->format('d.m.Y') }}</dd>
                                </div>
                                <div>
                                    <dt>{{ __('member.status') }}</dt>
                                    <dd class="mt-1">
                                        <span class="member-order-status inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $orderBadge[$order->status] ?? 'bg-gray-100 text-gray-800' }}">{{ __('member.order_status.' . $order->status) }}</span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                            {{-- Kalemler + tutarlar --}}
                            <div class="{{ $cardClass }} lg:col-span-2">
                                <h3 class="mb-6 text-xl">{{ __('member.items') }}</h3>
                                <ul class="divide-y divide-[#EAEAEA]">
                                    @foreach($order->items as $item)
                                        <li class="member-order-item flex flex-wrap items-start justify-between gap-x-6 gap-y-2 py-4 text-sm">
                                            <div class="min-w-0 flex-1 basis-40">
                                                <p class="break-words font-semibold text-colorBlackPearl">{{ $item->product_name }}</p>
                                                @if(!empty($item->variant_info) && is_array($item->variant_info))
                                                    <p class="mt-0.5 break-words text-xs text-colorCarbonGrey/70">
                                                        @foreach($item->variant_info as $attrName => $valName)
                                                            {{ $attrName }}: {{ $valName }}@if(!$loop->last), @endif
                                                        @endforeach
                                                    </p>
                                                @endif
                                                <p class="mt-1 text-xs">{{ __('member.quantity') }}: {{ $item->quantity }} &times; {{ $money($item->unit_price) }}</p>
                                            </div>
                                            <div class="text-right">
                                                <span class="block text-xs">{{ __('member.line_total') }}</span>
                                                <span class="font-semibold text-colorBlackPearl">{{ $money($item->total_price) }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <dl class="mt-4 space-y-2 border-t border-[#EAEAEA] pt-4 text-sm">
                                    <div class="flex justify-between gap-4">
                                        <dt>{{ __('member.subtotal') }}</dt>
                                        <dd class="text-colorBlackPearl">{{ $money($order->subtotal) }}</dd>
                                    </div>
                                    @if($order->coupon_code)
                                        <div class="flex justify-between gap-4">
                                            <dt class="break-all">{{ __('member.discount', ['code' => $order->coupon_code]) }}</dt>
                                            <dd class="whitespace-nowrap text-green-700">-{{ $money($order->discount_amount) }}</dd>
                                        </div>
                                    @endif
                                    <div class="flex justify-between gap-4 text-base font-semibold text-colorBlackPearl">
                                        <dt>{{ __('member.total') }}</dt>
                                        <dd class="member-order-total">{{ $money($order->total) }}</dd>
                                    </div>
                                </dl>
                            </div>

                            {{-- Teslimat adresi --}}
                            <div class="{{ $cardClass }} self-start">
                                <h3 class="mb-6 text-xl">{{ __('member.shipping_address') }}</h3>
                                <address class="member-order-address space-y-1 break-words text-sm not-italic">
                                    <p class="font-semibold text-colorBlackPearl">{{ $order->customer_name }}</p>
                                    @if($order->customer_phone)<p>{{ $order->customer_phone }}</p>@endif
                                    <p class="whitespace-pre-line">{{ $order->shipping_address }}</p>
                                    @if($addressLine !== '')<p>{{ $addressLine }}</p>@endif
                                    @if($order->shipping_zip || $order->shipping_country)
                                        <p>{{ implode(' ', array_filter([$order->shipping_zip, $order->shipping_country])) }}</p>
                                    @endif
                                </address>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
