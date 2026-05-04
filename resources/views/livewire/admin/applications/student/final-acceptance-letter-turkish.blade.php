<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Öğrenci Belgesi - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 10mm 12mm 10mm 12mm;
            size: A4;
        }

        body {
            font-family: 'DejaVu Sans', 'Helvetica', Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.45;
            color: #1a1a1a;
            margin: 0;
            padding: 0;
            padding-bottom: 155px;
            background: #fff;
            position: relative;
            min-height: 100vh;
        }

        /* Watermark */
        body::before {
            content: 'Radom University';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-family: Georgia, 'DejaVu Serif', 'Times New Roman', serif;
            font-size: 40pt;
            font-weight: bold;
            color: #1a2744;
            opacity: 0.05;
            z-index: -1;
            pointer-events: none;
            white-space: nowrap;
            letter-spacing: 0.06em;
        }

        /* ── Header ── */
        .header-wrapper {
            border-bottom: 3px solid #1a2744;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .header-top-accent {
            height: 4px;
            background: linear-gradient(90deg, #1a2744 0%, #c5a55a 50%, #1a2744 100%);
            margin-bottom: 12px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
        }

        .logo-cell {
            width: 92px;
            text-align: left;
            vertical-align: middle;
        }

        .logo {
            max-width: 22mm;
            height: auto;
        }

        .brand-wordmark-compact {
            line-height: 1.05;
        }

        .brand-wordmark-compact .brand-wordmark-primary {
            display: block;
            font-family: Georgia, 'DejaVu Serif', 'Times New Roman', serif;
            font-size: 11pt;
            font-weight: bold;
            color: #1a2744;
            letter-spacing: 0.1em;
        }

        .brand-wordmark-compact .brand-wordmark-secondary {
            display: block;
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 6pt;
            font-weight: normal;
            color: #3d5a80;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            margin-top: 1px;
        }

        .title-cell {
            text-align: center;
            padding: 0 10px;
        }

        .university-name {
            font-size: 13pt;
            font-weight: bold;
            color: #1a2744;
            letter-spacing: 0.8px;
            margin: 0;
        }

        .department-name {
            font-size: 7.5pt;
            color: #555;
            margin-top: 3px;
            letter-spacing: 0.5px;
        }

        .date-cell {
            width: 90px;
            text-align: right;
            font-size: 8pt;
            color: #444;
        }

        /* ── Document Title ── */
        .document-title {
            text-align: center;
            margin: 16px 0 14px 0;
        }

        .document-title h1 {
            font-size: 12pt;
            font-weight: bold;
            color: #1a2744;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
            padding: 6px 0;
            display: inline-block;
            border-bottom: 2px solid #c5a55a;
        }

        /* ── Student Info ── */
        .content-wrapper {
            display: table;
            width: 100%;
            margin: 0;
            border-spacing: 15px 0;
        }

        .info-cell {
            display: table-cell;
            vertical-align: top;
            width: auto;
        }

        .photo-cell {
            display: table-cell;
            vertical-align: top;
            width: 130px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7.5pt;
        }

        .info-table tr {
            border-bottom: 1px solid #e8e8e8;
        }

        .info-table tr:last-child {
            border-bottom: none;
        }

        .info-table td {
            padding: 4.5px 6px;
            vertical-align: top;
        }

        .info-table .label-col {
            font-weight: bold;
            color: #1a2744;
            width: 38%;
            white-space: nowrap;
        }

        .info-table .value-col {
            color: #222;
        }

        /* ── Photo ── */
        .photo-frame {
            width: 130px;
            height: 155px;
            border: none;
            border-radius: 0;
            overflow: hidden;
            background-color: transparent;
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #aaa;
            font-size: 9pt;
        }

        /* ── Body Text ── */
        .body-text {
            margin-top: 16px;
            font-size: 8pt;
            line-height: 1.7;
            color: #222;
            text-align: justify;
            padding: 0 4px;
        }

        /* ── Signature + Stamp ── */
        .signature-stamp-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .signature-stamp-table td {
            vertical-align: bottom;
        }

        .sig-cell {
            position: relative;
            text-align: right;
            padding: 6px 20px 8px 20px;
            min-height: 52px;
        }

        .sig-stamp-overlay {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-58%);
            width: 72px;
            height: auto;
            max-height: 76px;
            object-fit: contain;
            opacity: 0.82;
            z-index: 2;
            pointer-events: none;
        }

        .sig-cell .sig-name {
            position: relative;
            z-index: 1;
            font-weight: bold;
            font-size: 8pt;
            color: #1a2744;
        }

        .sig-cell .sig-title {
            position: relative;
            z-index: 1;
            font-size: 7.5pt;
            color: #555;
            margin-top: 2px;
        }

        /* ── Verification Footer ── */
        .verification-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 0;
        }

        .verification-pdf {
            font-size: 7.5pt;
            line-height: 1.35;
            color: #000;
            text-align: left;
            margin-bottom: 8px;
        }

        .verification-pdf-title {
            margin: 0 0 5px 0;
            font-weight: bold;
        }

        .verification-pdf-url {
            margin: 0 0 8px 0;
            font-family: 'DejaVu Sans Mono', 'Courier New', monospace;
            font-size: 7pt;
            word-break: break-all;
        }

        .verification-pdf-layout {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .verification-pdf-qr-cell {
            width: 72px;
            padding: 0 10px 0 0;
            vertical-align: top;
        }

        .verification-pdf-text-cell {
            vertical-align: top;
            text-align: justify;
            font-size: 7.5pt;
            line-height: 1.35;
        }

        .verification-pdf-text-cell p {
            margin: 0;
        }

        .bottom-divider {
            height: 1px;
            background: #000;
            margin: 8px 0 6px 0;
            opacity: 0.25;
        }

        .address-block {
            font-size: 5.5pt;
            line-height: 1.2;
            color: #555;
            text-align: center;
        }

        .address-block p {
            margin: 1px 0;
        }

        .address-block .institution-line {
            font-weight: bold;
            color: #1a2744;
            font-size: 6pt;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Top Accent Line -->
    <div class="header-top-accent"></div>

    <!-- Header -->
    <div class="header-wrapper">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <div class="brand-wordmark-compact">
                        <span class="brand-wordmark-primary">Radom</span>
                        <span class="brand-wordmark-secondary">University</span>
                    </div>
                </td>
                <td class="title-cell">
                    <div class="university-name">
                        RADOM UNIVERSITY
                    </div>
                    <div class="department-name">
                        Öğrenci İşleri Daire Başkanlığı
                    </div>
                </td>
                <td class="date-cell">
                    {{ now()->format('d/m/Y') }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Document Title -->
    <div class="document-title">
        <h1>{{ tr_upper('Öğrenci Belgesi') }}</h1>
    </div>

    <!-- Student Information -->
    <div class="content-wrapper">
        <div class="info-cell">
            <table class="info-table">
                <tr>
                    <td class="label-col">Öğrenci No</td>
                    <td class="value-col">{{ $student->student_number ?? $student->id }}</td>
                </tr>
                <tr>
                    <td class="label-col">Pasaport No</td>
                    <td class="value-col">{{ $student->passport_number ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td class="label-col">Adı</td>
                    <td class="value-col">{{ tr_upper($student->first_name) }}</td>
                </tr>
                <tr>
                    <td class="label-col">Soyadı</td>
                    <td class="value-col">{{ tr_upper($student->last_name) }}</td>
                </tr>
                <tr>
                    <td class="label-col">Doğum Yeri & Tarihi</td>
                    <td class="value-col">
                        {{ tr_upper($student->place_of_birth ?? ($student->nationality ?? 'N/A')) }} -
                        {{ $student->date_of_birth ? $student->date_of_birth->format('d/m/Y') : 'N/A' }}
                    </td>
                </tr>
                <tr>
                    <td class="label-col">Ata Adı</td>
                    <td class="value-col">{{ tr_upper($student->father_name ?? 'N/A') }}</td>
                </tr>
                <tr>
                    <td class="label-col">Uyruk</td>
                    <td class="value-col">{{ tr_upper($student->nationality ?? 'N/A') }}</td>
                </tr>
                <tr>
                    <td class="label-col">Eğitim Düzeyi</td>
                    <td class="value-col">
                        {{ tr_upper($student->application->program?->degree?->getDescription('TR') ?: $student->application->program?->degree?->name ?? 'N/A') }}
                    </td>
                </tr>
                <tr>
                    <td class="label-col">Enstitü / Fakülte</td>
                    <td class="value-col">
                        {{ tr_upper($student->application->program?->faculty?->getName('TR') ?: $student->application->program?->faculty?->name ?? 'GRADUATE SCHOOL') }}
                    </td>
                </tr>
                <tr>
                    <td class="label-col">Bölüm</td>
                    <td class="value-col">
                        {{ tr_upper($student->application->program?->getName('TR') ?: $student->application->program?->name ?? 'N/A') }}
                    </td>
                </tr>
                <tr>
                    <td class="label-col">Eğitim Dili</td>
                    <td class="value-col">{{ $student->study_language === 'EN' ? 'İngilizce' : 'Türkçe' }}</td>
                </tr>
                <tr>
                    <td class="label-col">Eğitim Tipi</td>
                    <td class="value-col">Örğün</td>
                </tr>
                <tr>
                    <td class="label-col">Bursluluk Statüsü</td>
                    <td class="value-col">{{ $student->scholarship_status . ' Burslu' ?? '75% Burslu' }}</td>
                </tr>
                <tr>
                    <td class="label-col">Sınıf</td>
                    <td class="value-col">DERS AŞAMASI ({{ $student->current_course ?? 1 }} SINIF)</td>
                </tr>
                <tr>
                    <td class="label-col">Kayıt Tarihi</td>
                    <td class="value-col">{{ now()->format('d/m/Y') }}</td>
                </tr>
            </table>
        </div>
        <div class="photo-cell">
            @php
                $photoData = null;
                $photoMime = 'image/jpeg';

                if ($student->profile_photo_path && Storage::exists($student->profile_photo_path)) {
                    try {
                        $photoContent = Storage::get($student->profile_photo_path);
                        if ($photoContent) {
                            $photoData = base64_encode($photoContent);
                            $extension = strtolower(pathinfo($student->profile_photo_path, PATHINFO_EXTENSION));
                            $photoMime = match ($extension) {
                                'jpg', 'jpeg' => 'image/jpeg',
                                'png' => 'image/png',
                                'gif' => 'image/gif',
                                'webp' => 'image/webp',
                                default => 'image/jpeg',
                            };
                        }
                    } catch (\Exception $e) {
                        // Şəkil yüklənə bilmədi
                    }
                }
            @endphp

            @if ($photoData)
                <div class="photo-frame">
                    <img src="data:{{ $photoMime }};base64,{{ $photoData }}" alt="Student Photo">
                </div>
            @else
                <div class="photo-frame">
                    <div class="photo-placeholder">
                        No Photo
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Body Text -->
    @php
        $startYear = $student->graduation_year;
        $endYear = $student->graduation_year + 1;
        $programName = tr_upper(
            $student->application->program?->getName('TR') ?: $student->application->program?->name ?? 'N/A',
        );
        $degreeName = tr_upper(
            $student->application->program?->degree?->getName('TR') ?:
            $student->application->program?->degree?->description ??
                ($student->application->program?->degree?->name ?? 'N/A'),
        );
    @endphp
    <div class="body-text">
        Yukarıda açık kimliği yazılı <strong>{{ tr_upper($student->first_name) }}
            {{ tr_upper($student->last_name) }}</strong>,
        {{ $programName }} {{ $degreeName }} Programı kayıtlı öğrencisidir.
        {{ $startYear }}-{{ $endYear }} eğitim - öğretim yılı Güz yarıyılında ders kaydı yaptırmış olup
        öğrencilik haklarından yararlanır. Herhangi bir disiplin cezası bulunmamaktadır.
    </div>

    <!-- Signature + Stamp -->
    @php
        $stampPath = public_path('images/radom-möhür.png');
        $stampData = file_exists($stampPath) ? base64_encode(file_get_contents($stampPath)) : '';
    @endphp
    <table class="signature-stamp-table">
        <tr>
            <td class="sig-cell">
                @if ($stampData)
                    <img
                        class="sig-stamp-overlay"
                        src="data:image/png;base64,{{ $stampData }}"
                        alt="RADOM Möhür"
                    >
                @endif
                <div class="sig-name">Prof. Dr. hab. Tomasz Żelazowski-Krępski</div>
                <div class="sig-title">Rektör</div>
            </td>
        </tr>
    </table>

    <!-- Verification Footer -->
    <div class="verification-footer">
        @php
            $verificationCodeForUrl = $verificationCode ?? null;
            $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
            $codeForEntry = $verificationCode ? strtoupper(trim($verificationCode)) : '—';
            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                ->size(70)
                ->generate($verificationUrl);
            $qrCodeBase64 = base64_encode($qrCode);
        @endphp
        <div class="verification-pdf">
            <p class="verification-pdf-title">Belgenin doğruluğunu kontrol edin:</p>
            <p class="verification-pdf-url">{{ $verificationUrl }}</p>
            <table class="verification-pdf-layout">
                <tr>
                    <td class="verification-pdf-qr-cell">
                        <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                            style="width: 64px; height: 64px; display: block;" />
                    </td>
                    <td class="verification-pdf-text-cell">
                        <p>
                            Belgenin doğruluğunu kontrol etmek için QR kodu tarayın veya bağlantıyı manuel açın.
                            İstendiğinde bu doğrulama kodunu girin:
                            <strong>{{ $codeForEntry }}</strong>
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Bottom Divider -->
        <div class="bottom-divider"></div>

        <!-- Address Block -->
        <div class="address-block">
            <p>Aleja Józefa Piłsudskiego 35, 09-407 Płock / Poland [ RADOM ]</p>
            <p style="margin-top: 3px;">
                <strong>Tel:</strong>+48579277493
            </p>
            <p>
                <strong>e-mail:</strong> info@radomuniversity.pl | rectorate@radomuniversity.pl |
            </p>
        </div>
    </div>

</body>

</html>
