<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurs Kayıt Sözleşmesi</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            margin: 0;
            padding: 0;
            color: #000;
            background: #fff;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .container {

            margin: 0 auto;

            /* standart A4 boşluğu */
            box-sizing: border-box;
        }

        h1,
        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        h1 {
            font-size: 16pt;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 14pt;
            margin-bottom: 5px;
        }

        h3 {
            font-size: 12pt;
            margin-bottom: 10px;
        }

        p {
            margin: 10px 0;
        }

        table.form {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            page-break-inside: auto;
        }

        table.form td {
            border: none;
            /* tüm çizgiler kaldırıldı */
            padding: 6px 8px;
            vertical-align: top;
            font-size: 10pt;
        }

        .section-title {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 10pt;
            padding: 4px 0;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            page-break-inside: avoid;
        }

        .sig-box {
            width: 48%;
            padding-top: 8px;
            text-align: left;
            font-size: 12pt;
            color: #000;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .container {
                padding: 15mm;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="margin-bottom: 30px;">
            <h1>PAROSİS AKADEMİ</h1>
            <h2>{{ Str::upperTr($student->lessonClass->name) }}</h2>
            <h3>KURS KAYIT SÖZLEŞMESİ</h3>
        </div>
        <!-- Giriş metni -->
        <p>Bu sözleşme, <strong>Parosis Pamukkale Robotik Sistemler ARGE A.Ş.</strong> ile katılımcı arasında
            <strong>{{ now()->format('d.m.Y') ?? '' }}</strong>
            tarihinde aşağıda belirtilen şartlarda akdedilmiştir.
        </p>

        <!-- Katılımcı Bilgileri -->
        <table class="form">
            <tr>
                <td><strong>Kurum Adı</strong></td>
                <td>: Parosis Pamukkale Robotik Sistemler ARGE A.Ş.</td>
            </tr>
            <tr>
                <td style="width:30%"><strong>Öğrenci Adı Soyadı</strong></td>
                <td>: {{ $student->full_name }}</td>
            </tr>
            <tr>
                <td><strong>Öğrenci Kimlik No</strong></td>
                <td>: {{ $student->national_id }}</td>
            </tr>
            <tr>
                <td><strong>Veli Adı Soyadı</strong></td>

                <td>: {{ $student->guardians->first()->full_name ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Veli Kimlik No</strong></td>
                <td>: {{ $student->guardians->first()->national_id ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Kurs Süresi ve Tarihleri</strong></td>
                <td>:
                    {{ $student->lessonClass->course_time . ' - ' . ($student->lessonClass->start_date ? \Carbon\Carbon::parse($student->lessonClass->start_date)->format('d.m.Y') : '') . ' - ' . ($student->lessonClass->end_date ? \Carbon\Carbon::parse($student->lessonClass->end_date)->format('d.m.Y') : '') }}
                </td>
            </tr>
            <tr>
                <td><strong>Ücret ve Ödeme Şartları</strong></td>
                <td>: Kurs ücreti toplam {{ $student->payments->last()->total_price }} Türk Lirası olup, aşağıda
                    belirlenen ödeme planına göre ödenecektir.
                </td>
            </tr>
        </table>

        <!-- Katılımcı Yükümlülükleri -->
        <table class="form">
            <tr>
                <td colspan="2" class="section-title">Katılımcı Yükümlülüklerİ</td>
            </tr>
            <tr>
                <td colspan="2">Katılımcı, kursa düzenli olarak katılmayı, verilen ödevleri zamanında tamamlamayı ve
                    kurs materyallerini yalnızca kişisel eğitim amacıyla kullanmayı taahhüt eder.</td>
            </tr>
        </table>

        <!-- Gizlilik -->
        <table class="form">
            <tr>
                <td colspan="2" class="section-title">Gİzlİlİk</td>
            </tr>
            <tr>
                <td colspan="2">Taraflar, kurs süresince ve sonrasında birbirlerine ait kişisel ve ticari bilgileri
                    gizli tutacak ve üçüncü şahıslarla paylaşmayacaktır.</td>
            </tr>
        </table>

        <!-- Onay -->
        <table class="form">
            <tr>
                <td colspan="2"><strong>Bu sözleşme, taraflarca imzalandığı tarihte yürürlüğe girer ve kurs süresi
                        boyunca geçerli olur.</strong></td>
            </tr>
        </table>

        <!-- İmza Alanı -->
        <table class="form">
            <tr style="text-align: center;">
                <td colspan="2" class="section-title">KURS VEREN</td>
            </tr>
            <tr style="text-align: start;">

                <td colspan="2" class="section-title">KURUM:Parosİs Pamukkale Robotİk Sİstemler ARGE A.Ş.</td>
            </tr>
            <tr style="text-align: start;">
                <td colspan="2" class="section-title">
                    TARİH:
                    {{ now()->format('d.m.Y') ?? '' }}
                </td>
            </tr>
            <tr style="text-align: start;">
                <td colspan="2" class="section-title">İMZA KAŞE:</td>
            </tr>
            <tr style="text-align: start;">
                <td colspan="2" class="section-title"></td>

            </tr>
            <tr style="text-align: center;">
                <td colspan="2" class="section-title">KATILIMCI</td>
            </tr>
            <tr style="text-align: start;">

                <td colspan="2" class="section-title">AD SOYAD: {{ $student->full_name }}</td>
            </tr>
            <tr style="text-align: start;">
                <td colspan="2" class="section-title">VELİ AD SOYAD:
                    {{ Str::upperTr($student->guardians->first()->full_name ?? '') }}
                </td>
            </tr>
            <tr style="text-align: start;">
                <td colspan="2" class="section-title">TARİH:{{ now()->format('d.m.Y') ?? '' }}</td>
            </tr>
            <tr style="text-align: start;">
                <td colspan="2" class="section-title">İMZA:</td>
            </tr>
        </table>
    </div>
</body>

</html>
