@extends('emails.layout')

@section('body')
<h2>Sipariş Durumu Güncellendi</h2>
<p>Sayın {{ $order->customer_name }}, <strong>#{{ $order->order_number }}</strong> numaralı siparişinizin durumu güncellendi.</p>

<table class="info-table">
    <tr>
        <td>Sipariş No</td>
        <td><strong>{{ $order->order_number }}</strong></td>
    </tr>
    <tr>
        <td>Önceki Durum</td>
        <td>{{ $oldStatusLabel }}</td>
    </tr>
    <tr>
        <td>Yeni Durum</td>
        <td><span class="badge badge-{{ $newStatus }}">{{ $statusLabel }}</span></td>
    </tr>
    <tr>
        <td>Toplam</td>
        <td><strong>{{ number_format($order->total, 2, ',', '.') }} TL</strong></td>
    </tr>
</table>

@if($order->admin_note)
<div class="message-box">
    <strong style="display: block; margin-bottom: 4px; color: #6b7280; font-size: 13px;">Yönetici Notu:</strong>
    {!! nl2br(e($order->admin_note)) !!}
</div>
@endif

<p style="color: #9ca3af; font-size: 13px; margin-top: 24px;">Sipariş tarih: {{ $order->created_at->format('d.m.Y H:i') }}</p>
@endsection
