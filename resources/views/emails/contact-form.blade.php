@extends('emails.layout')

@section('body')
<h2>Yeni İletişim Formu Mesajı</h2>
<p>Web siteniz üzerinden yeni bir iletişim formu mesajı aldınız.</p>

<table class="info-table">
    <tr>
        <td>Ad Soyad</td>
        <td>{{ $contactName }}</td>
    </tr>
    <tr>
        <td>E-posta</td>
        <td><a href="mailto:{{ $contactEmail }}" style="color: #d946ef;">{{ $contactEmail }}</a></td>
    </tr>
</table>

<div class="message-box">
    {!! nl2br(e($contactMessage)) !!}
</div>

<p style="color: #9ca3af; font-size: 13px; margin-top: 24px;">Bu mesaj {{ $siteName }} iletişim formu aracılığıyla gönderilmiştir.</p>
@endsection
