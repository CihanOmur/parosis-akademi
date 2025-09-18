<!doctype html>
<html lang="tr_TR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>PAROSİS {{ $student->lessonClass->name }} Kayıt Formu</title>
    <style>
        :root {
            --red: #ff0000;
            --muted: #555;
            --border: #222;
            --paper: #fff;
            --field-height: 22px;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            font-family: "Times New Roman", Times, serif;
            background: #fff;
        }

        .paper {
            position: relative;

            margin: 0 auto;
            padding: 10mm;
            background: var(--paper);
            box-sizing: border-box;
            overflow: hidden;
        }

        .watermark {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) rotate(-40deg);
            font-size: 120px;
            font-weight: 900;
            color: rgba(160, 160, 160, 0.06);
            pointer-events: none;
            user-select: none;
            letter-spacing: 8px;
            white-space: nowrap;
        }

        h1 {
            text-align: center;
            margin: 4px 0 6px;
            color: var(--red);
            font-size: 18px;
        }

        table.form {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            word-break: break-word;

        }

        table.form td,
        table.form th {
            border: 1px solid var(--border);
            padding: 6px 8px;
            vertical-align: middle;
            font-size: 10px;
            hyphens: auto;
        }

        .section-title {
            font-weight: 700;
            color: var(--red);
            text-transform: uppercase;
            font-size: 13px;
        }

        .field-line {
            display: inline-block;
            border-bottom: 1px solid #000;
            min-width: 80px;
            height: var(--field-height);
            vertical-align: middle;
            margin-left: 6px;
        }

        .long-line {
            min-width: 220px;
        }

        .xlong {
            min-width: 420px;
        }

        .box {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 1px solid #000;
            vertical-align: middle;
            margin-left: 6px;
        }

        .note {
            font-size: 12px;
            color: var(--muted);
        }

        .consent {
            margin-top: 8px;
            font-size: 11px;
        }

        .signature {
            position: absolute;
            /* kesin pozisyon */
            bottom: 10mm;
            /* alt kenardan boşluk */
            right: 10mm;
            /* sağ kenardan boşluk */
            width: 220px;
            /* imza kutusu genişliği */
            text-align: center;
            /* kutu içi yazı ortala */
        }

        .sig-box {
            border-top: 1px solid #000;
            padding-top: 8px;
            font-size: 13px;
            color: #555;
        }


        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .paper {
                width: 210mm;
                height: 297mm;
                padding: 10mm;
                box-shadow: none;
            }

            table.form td,
            table.form th {
                font-size: 12px;
                padding: 6px 10px;
            }

            .sig-box {
                font-size: 11px;
                padding-top: 6px;
            }

            .watermark {
                font-size: 110px;
            }
        }
    </style>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
    </style>
</head>

<body>
    <div class="paper">
        <div class="watermark">PAROSİS</div>


        <h1>PAROSİS {{ Str::upperTr($student->lessonClass->name) }} EĞİTİMİ<br>KAYIT FORMU</h1>

        <!-- Buradaki HTML içeriği, form alanları, tablolar ve imzalar aynı kaldı -->
        <!-- ÖĞRENCİ BİLGİLERİ -->
        <table class="form" aria-label="Öğrenci Bilgileri">
            <tr>
                <td style="border: none;" class="section-title" colspan="3">Öğrencİ Bİlgİlerİ</td>

            </tr>
            <tr>
                <td style="width:18%"><strong>Adı - Soyadı</strong></td>
                <td style="width:32%">{{ $student->full_name }}</td>
                <td style="width:18%"><strong>T.C. Kimlik No</strong></td>
                <td style="width:32%">{{ $student->national_id }}</td>
            </tr>
            <tr>
                <td><strong>Cinsiyeti</strong></td>
                <td>{{ $student->gender }}</td>
                <td><strong>Kan Grubu</strong></td>
                <td>{{ $student->blood_type }}</td>
            </tr>
            <tr>
                <td><strong>Doğum Tarihi - Yeri</strong></td>

                <td>{{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d.m.Y') : '' }}</td>

                <td><strong>Sınıfı</strong></td>
                <td>{{ $student->lessonClass?->name }}</td>
            </tr>
            <tr>
                <td><strong>Okul Adı</strong></td>
                <td>{{ $student->school_name }}</td>
                <td><strong>Cep Telefonu</strong></td>
                <td>{{ $student->phone }}</td>
            </tr>
        </table>

        <!-- ANNE-BABA BİLGİLERİ -->
        <table class="form" aria-label="Anne Baba Bilgileri">
            <tr>
                <th style="width:24%; border:none; text-align:left;" class="section-title">Velİ Bİlgİlerİ</th>
                <th style="width:38%; border:none;" class="section-title"></th>
                <th style="width:38%; border:none;" class="section-title"></th>
            </tr>
            <tr>
                <td><strong>Yakınlık Derecesi</strong></td>
                <td>{{ $student->guardians->first()->relationship ?? '' }}</td>
                <td>{{ $student->guardians->skip(1)->first()->relationship ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>T.C. Kimlik No</strong></td>
                <td>{{ $student->guardians->first()->national_id ?? '' }}</td>
                <td>{{ $student->guardians->skip(1)->first()->national_id ?? '' }}</td>

            </tr>

            <tr>
                <td><strong>Adı - Soyadı</strong></td>
                <td>{{ $student->guardians->first()->full_name ?? '' }}</td>
                <td>{{ $student->guardians->skip(1)->first()->full_name ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Doğum Tarihi</strong></td>
                <td>{{ $student->guardians->first()->birth_date ? \Carbon\Carbon::parse($student->guardians->first()->birth_date ?? '')->format('d.m.Y') : '' }}
                </td>

                <td>{{ isset($student->guardians->skip(1)->first()->birth_date) ? \Carbon\Carbon::parse($student->guardians->skip(1)->first()->birth_date ?? '')->format('d.m.Y') : '' }}
                </td>
            </tr>
            <tr>
                <td><strong>Eğitim Düzeyi</strong></td>
                <td>{{ $student->guardians->first()->education_level ?? '' }}</td>
                <td>{{ $student->guardians->skip(1)->first()->education_level ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Mesleği</strong></td>
                <td>{{ $student->guardians->first()->job ?? '' }}</td>
                <td>{{ $student->guardians->skip(1)->first()->job ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Telefon</strong></td>
                <td>{{ $student->guardians->first()->phone_1 ?? '' }}</td>
                <td>{{ $student->guardians->skip(1)->first()->phone_1 ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Telefon</strong></td>
                <td>{{ $student->guardians->first()->phone_2 ?? '' }}</td>
                <td>{{ $student->guardians->skip(1)->first()->phone_2 ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>E-mail</strong></td>
                <td>{{ $student->guardians->first()->email ?? '' }}</td>
                <td>{{ $student->guardians->skip(1)->first()->email ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Ev Adresi</strong></td>
                <td colspan="2">{{ $student->guardians->first()->home_address ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>İş Adresi</strong></td>
                <td colspan="2">{{ $student->guardians->first()->work_address ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Veli İzni</strong></td>
                <td colspan="2" class="note">
                    Velisi bulunduğum {{ $student->full_name }} eğitim sırasında çekilen video veya fotoğrafların
                    yayınlanmasına izin veriyorum.
                    <div>
                        <div
                            style="display:inline-block; width:48%; vertical-align:middle; padding:12px 0; text-align:left;">
                            <strong>Veli: </strong> &nbsp;&nbsp;
                            <span>{{ $student->guardians->first()->full_name ?? '' }}</span>
                        </div>
                        <div
                            style="display:inline-block; width:48%; vertical-align:middle; padding:12px 0; text-align:left; white-space:nowrap;">
                            <strong>İmza:</strong>
                        </div>
                    </div>
                </td>
            </tr>
        </table>

        <!-- ACİL DURUM KİŞİLERİ -->
        <table class="form" aria-label="Acil Durum Kişileri">
            <tr>
                <td class="section-title" style="border:none;" colspan="4">
                    Acİl Durumlarda Aranacak 3. Kİşİler <small style="font-weight:400">(Anne-Baba dışında başvurulacak
                        kİşİ yazılması gerekmektedİr.)</small>
                </td>
            </tr>
            @dd($student->emergencyContact)
            <tr>
                <td style="width:18%"><strong>Yakınlık Derecesi</strong></td>
                <td style="width:32%">{{ $student->emergencyContact->relationship ?? '' }}</td>
                <td style="width:18%"><strong>Telefon</strong></td>
                <td style="width:32%">{{ $student->emergencyContact->phone ?? '' }}</td>
            </tr>
            <tr>
                <td style="width:18%"><strong>Adres</strong></td>
                <td style="width:82%" colspan="3">{{ $student->emergencyContact->address ?? '' }}</td>
            </tr>
        </table>

        <!-- Alerji ve Gün Seçimi -->
        <table class="form" aria-label="Alerji ve Gün Seçimi">
            <tr>
                <td colspan="2" class="section-title" style="border:none;">
                    <strong>Öğrencİnİn Alerjİk Durumu veya Kronİk Rahatsızlığı Var mı? Varsa Belİrtİn:</strong>
                </td>
            </tr>
            <tr>
                <td style="width:18%;"><strong>{{ $student->has_allergy ? 'Var' : 'Yok' }}</strong></td>
                <td style="width:82%;">{{ $student->allergy_detail ?? '' }}</td>
            </tr>
        </table>

        <div style="text-align:center; margin-top:22px; font-weight:700; letter-spacing:0.6px; font-size:13px;">
            PAROSİS PAMUKKALE ROBOTİK SİSTEMLER ARGE A.Ş. MÜDÜRLÜĞÜNE
        </div>

        <p class="consent">
            Velisi bulunduğum
            {{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d.m.Y') : '' }}
            doğumlu çocuğumun {{ $student->full_name }} hakkında vermiş
            olduğum
            bilgilerin
            doğruluğunu kabul ediyor ve {{ Str::upperTr($student->lessonClass->name) }} eğitimine kaydının yapılmasını
            istiyorum. Gereğini bilgilerinize
            rica ederim.
        </p>

        <div style="width:100%; text-align:right; margin-top:40px;">
            <div
                style="display:inline-block; width:220px; text-align:center; padding-top:8px; font-size:13px; color:#555;">
                <div><strong>{{ now()->format('d.m.Y') }}</strong></div>
                <div style="height:10px;"></div>
                <div><strong>{{ $student->guardians->first()->full_name ?? '' }}</strong></div>
                <div style="height:40px;"></div>
            </div>
        </div>


    </div>
</body>

</html>
