@extends('emails.layout')

@section('body')
<h2>Siparişiniz Alındı!</h2>
<p>Sayın {{ $order->customer_name }}, siparişiniz başarıyla oluşturuldu. Detaylar aşağıdadır:</p>

<table class="info-table">
    <tr>
        <td>Sipariş No</td>
        <td><strong>{{ $order->order_number }}</strong></td>
    </tr>
    <tr>
        <td>Tarih</td>
        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
    </tr>
    <tr>
        <td>Durum</td>
        <td><span class="badge badge-pending">{{ $order->status_label }}</span></td>
    </tr>
    @if($order->customer_phone)
    <tr>
        <td>Telefon</td>
        <td>{{ $order->customer_phone }}</td>
    </tr>
    @endif
    <tr>
        <td>Teslimat Adresi</td>
        <td>{{ $order->shipping_address }}, {{ $order->shipping_district ? $order->shipping_district . ', ' : '' }}{{ $order->shipping_city }}</td>
    </tr>
</table>

<h2 style="margin-top: 28px;">Sipariş Detayları</h2>
<table class="items-table">
    <thead>
        <tr>
            <th>Ürün</th>
            <th class="text-right">Adet</th>
            <th class="text-right">Fiyat</th>
            <th class="text-right">Toplam</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>
                {{ $item->product_name }}
                @if($item->variant_info)
                    <br><span style="color: #9ca3af; font-size: 12px;">
                        @foreach((array) $item->variant_info as $k => $v)
                            {{ $v }}@if(!$loop->last), @endif
                        @endforeach
                    </span>
                @endif
            </td>
            <td class="text-right">{{ $item->quantity }}</td>
            <td class="text-right">{{ number_format($item->unit_price, 2, ',', '.') }} TL</td>
            <td class="text-right">{{ number_format($item->total_price, 2, ',', '.') }} TL</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="text-right" style="color: #6b7280;">Ara Toplam</td>
            <td class="text-right">{{ number_format($order->subtotal, 2, ',', '.') }} TL</td>
        </tr>
        @if($order->discount_amount > 0)
        <tr>
            <td colspan="3" class="text-right" style="color: #059669;">İndirim ({{ $order->coupon_code }})</td>
            <td class="text-right" style="color: #059669;">-{{ number_format($order->discount_amount, 2, ',', '.') }} TL</td>
        </tr>
        @endif
        <tr class="total-row">
            <td colspan="3" class="text-right">Toplam</td>
            <td class="text-right">{{ number_format($order->total, 2, ',', '.') }} TL</td>
        </tr>
    </tfoot>
</table>

@if($order->customer_note)
<div class="message-box">
    <strong style="display: block; margin-bottom: 4px; color: #6b7280; font-size: 13px;">Müşteri Notu:</strong>
    {!! nl2br(e($order->customer_note)) !!}
</div>
@endif

<p style="color: #9ca3af; font-size: 13px; margin-top: 24px;">Siparişinizle ilgili gelişmeler için size e-posta göndereceğiz.</p>
@endsection
