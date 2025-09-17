<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <title>Eğitim Ücreti Ödeme Planı</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12pt;
            margin: 5mm;
            color: black;
        }

        h2 {
            text-align: center;
            font-size: 14pt;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        .footer-text {
            margin-top: 0px;
            text-align: justify;
        }

        .signature {
            margin-top: 10px;
            text-align: right;
        }

        .signature p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

    <h2>EĞİTİM ÜCRETİ ÖDEME PLANI</h2>

    <table>
        <tr>
            <th>Taksitler</th>
            <th>Tarih</th>
            <th>Ödenecek Tutar</th>
        </tr>

        @foreach ($payment->installments as $installment)
            <tr>
                <td>{{ $loop->iteration }}. Taksit</td>
                <td>{{ \Carbon\Carbon::parse($installment->payment_date)->format('d/m/Y') }}</td>
                <td>{{ $installment->installment_price }}TL</td>
            </tr>
        @endforeach
        <tr>
            <th>TOPLAM</th>
            <td>{{ $payment->total_price }}</td>
            <td>{{ $payment->total_price - $payment->payed_price }}TL</td>
        </tr>
    </table>

    <div class="footer-text">
        Yukarıda belirtilen ödeme planına tam olarak uyacağımı, {{ $payment->total_price }} Türk Lirası toplam tutarı
        <b>Parosis Pamukkale Robotik Sistemler ARGE A.Ş.</b>'ye ödemeyi gerçekleştireceğimi taahhüt ederim.
    </div>

    <table>
        <tr>
            <td style="width: 70%; border: none;"></td>
            <td style="width: 30%; border: none;">
                <p>{{ $student->guardians->first()->full_name ?? '' }}</p>
            </td>
        </tr>
        <tr>
            <td style="width: 70%; border: none; padding:0"></td>
            <td style="width: 30%; border: none;padding:0">
                <p>İmza:</p>
            </td>
        </tr>
    </table>

</body>

</html>
