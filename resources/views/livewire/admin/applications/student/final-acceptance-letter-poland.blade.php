<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaświadczenie o statusie studenta - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 7mm 8.5mm 11mm 8.5mm;
            size: A4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 7pt;
            line-height: 1.3;
            color: #111;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        .page-content {
            padding-bottom: 58mm;
        }

        .page-bottom-fixed {
            position: fixed;
            left: 8.5mm;
            right: 8.5mm;
            bottom: 6mm;
            width: auto;
            page-break-inside: avoid;
        }

        .page-bottom-fixed .signature-block {
            margin-bottom: 3px;
        }

        .navy {
            color: #1a237e;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .header-table td {
            vertical-align: top;
            padding: 0;
        }

        .uni-pl {
            font-family: 'DejaVu Serif', Georgia, serif;
            font-size: 11pt;
            font-weight: bold;
            color: #1a237e;
            margin: 0;
            line-height: 1.1;
        }

        .uni-en {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9pt;
            font-weight: bold;
            color: #1a237e;
            margin: 2px 0 0 0;
        }

        .uni-sub {
            font-size: 6pt;
            color: #333;
            margin: 3px 0 0 0;
            line-height: 1.25;
        }

        .contact-block {
            text-align: right;
            font-size: 6.5pt;
            line-height: 1.4;
            color: #222;
        }

        .rule {
            border: none;
            border-top: 1px solid #bbb;
            margin: 6px 0 8px 0;
        }

        .doc-title {
            text-align: center;
            margin: 0 0 8px 0;
        }

        .doc-title .pl {
            font-size: 9.25pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #1a237e;
            margin: 0;
        }

        .doc-title .en {
            font-size: 8.75pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #1a237e;
            margin: 2px 0 0 0;
        }

        .meta-row {
            width: 100%;
            margin-bottom: 10px;
            font-size: 7pt;
        }

        .meta-row-table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta-row-table td {
            width: 50%;
            padding: 0;
            vertical-align: top;
        }

        .meta-right {
            text-align: right;
        }

        .section-banner {
            font-size: 7.25pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            background: #eef0fb;
            border: 1px solid #c5cae9;
            border-bottom: none;
            padding: 5px 8px;
            margin: 6px 0 0 0;
            color: #1a237e;
            text-align: center;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 6.85pt;
            margin-bottom: 5px;
            table-layout: fixed;
        }

        .data-table td {
            border: 1px solid #ccc;
            padding: 4px 7px;
            vertical-align: top;
            width: 50%;
        }

        .field-label {
            font-weight: normal;
            color: #333;
            line-height: 1.3;
            margin: 0 0 2px 0;
        }

        .field-value {
            font-weight: bold;
            color: #111;
            line-height: 1.3;
            margin: 0;
        }

        .body-columns {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0 2px 0;
            font-size: 7pt;
            line-height: 1.32;
        }

        .body-columns td {
            width: 50%;
            vertical-align: top;
            padding: 3px 8px 3px 0;
            text-align: justify;
            border: none;
        }

        .body-columns td.en-col {
            padding: 3px 0 3px 8px;
            border-left: 1px solid #ddd;
        }

        .body-columns p {
            margin: 0 0 2px 0;
        }

        .signature-block {
            margin-top: 0;
            margin-bottom: 4px;
            text-align: right;
        }

        .signature-inner {
            margin-left: auto;
            border-collapse: collapse;
        }

        .signature-inner td {
            vertical-align: bottom;
            padding: 0;
        }

        .sig-graphic-wrap {
            position: relative;
            min-height: 34px;
            margin-bottom: 2px;
            text-align: right;
        }

        .sig-handwritten {
            display: block;
            margin-left: auto;
            width: 155px;
            height: auto;
            max-height: 48px;
            object-fit: contain;
        }

        .sig-stamp-overlay {
            position: absolute;
            right: 88px;
            bottom: -4px;
            width: 52px;
            height: auto;
            max-height: 54px;
            object-fit: contain;
            opacity: 0.82;
        }

        .e-sign-box {
            border: 1px solid #333;
            padding: 5px 9px;
            text-align: center;
            line-height: 1.3;
            min-width: 168px;
            font-size: 6.65pt;
            background: #fafafa;
        }

        .e-sign-badge {
            font-weight: bold;
            font-size: 6.6pt;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a237e;
            margin-bottom: 5px;
            padding-bottom: 4px;
            border-bottom: 1px solid #ccc;
        }

        .e-sign-name {
            font-weight: bold;
            color: #111;
            font-size: 7pt;
            margin-top: 3px;
        }

        .e-sign-title {
            font-size: 6.35pt;
            color: #333;
            letter-spacing: 0.02em;
            line-height: 1.3;
        }

        .verification-wrap {
            border: 1px solid #bbb;
            margin-top: 0;
            margin-bottom: 0;
            font-size: 6.15pt;
            background: #fafafa;
        }

        .verification-header {
            background: #eef0fb;
            border-bottom: 1px solid #c5cae9;
            padding: 4px 8px;
            font-size: 6.3pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #1a237e;
            text-align: center;
        }

        .verification-body {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        .verification-body td {
            vertical-align: top;
            padding: 5px 6px;
        }

        .verification-body .qr-cell {
            width: 62px;
            border-right: 1px solid #ddd;
            text-align: center;
        }

        .verification-body .qr-cell img {
            width: 48px;
            height: 48px;
            display: block;
            margin: 0 auto;
        }

        .verification-body .text-cell {
            width: auto;
            border-right: 1px solid #ddd;
            font-size: 5.9pt;
            line-height: 1.35;
            color: #333;
            text-align: justify;
        }

        .verification-body .code-cell {
            width: 32%;
            font-size: 6pt;
            line-height: 1.4;
        }

        .verification-info-text {
            font-size: 5.9pt;
            line-height: 1.35;
            color: #333;
            margin-bottom: 5px;
            text-align: justify;
        }

        .verification-info-text p {
            margin: 0 0 4px 0;
        }

        .verification-info-text p:last-child {
            margin-bottom: 0;
        }

        .verification-url {
            word-break: break-all;
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 5.4pt;
            color: #1a237e;
        }

        .footer-line {
            text-align: center;
            font-size: 6.2pt;
            color: #444;
            margin: 3px 0 0 0;
            padding-top: 3px;
            border-top: 1px solid #ddd;
            line-height: 1.25;
            background: #fff;
        }

        /* --- Profile photo (added) --- */
        .header-table td.photo-cell {
            width: 22mm;
            text-align: right;
            vertical-align: top;
        }

        .photo-box {
            width: 22mm;
            height: 28mm;
            border: 1px solid #1a237e;
            padding: 1px;
            margin-left: auto;
            background: #fff;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-placeholder {
            width: 100%;
            height: 100%;
            text-align: center;
            font-size: 5.5pt;
            color: #999;
            border: 1px dashed #ccc;
            padding-top: 10px;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>

    <div class="page-content">

    @php
        $program = $student->application?->program;
        $degree = $program?->degree;
        $faculty = $program?->faculty;

        $programNameEn = $program?->getName('EN') ?: $program?->name ?? 'N/A';
        $programNamePl = $program?->getName('PL') ?: $programNameEn;
        $degreeNameEn = $degree?->getName('EN') ?: $degree?->name ?? 'N/A';
        $degreeNamePl = $degree?->getName('PL') ?: $degreeNameEn;
        $facultyNameEn = $faculty?->getName('EN') ?: $faculty?->name ?? 'Institute of Graduate Education';
        $facultyNamePl = $faculty?->getName('PL') ?: $facultyNameEn;

        $studyLangCode = strtoupper($student->study_language ?? 'EN');
        $studyLangEn = 'English';
        $studyLangDisplay = language_to_polish($studyLangEn);

        $nationalityDisplay = nationality_to_polish($student->nationality);
        $placeOfBirthDisplay = nationality_to_polish($student->place_of_birth ?? $student->nationality);

        $educationTypeEn = 'Full time';
        $educationTypePl = 'Studia stacjonarne';

        $classYear = $student->current_course ?? 1;
        $classEn = "Lesson stage ({$classYear}st year)";
        $classPl = "Etap zajęć ({$classYear}. rok studiów)";

        $scholarshipStatus = $student->scholarship_status ?? '75%';
        $scholarshipEn = "{$scholarshipStatus} Scholarship";
        $scholarshipPl = '%50 Stypendium';

        if (str_contains($scholarshipStatus, '100')) {
            $scholarshipPl = '100% Stypendium';
        } elseif (str_contains($scholarshipStatus, '75')) {
            $scholarshipPl = '%75 Stypendium';
        } elseif (str_contains($scholarshipStatus, '50')) {
            $scholarshipPl = '%50 Stypendium';
        } else {
            $scholarshipPl = $scholarshipStatus . ' Stypendium';
        }

        $startYear = $student->graduation_year ?? now()->year;
        $endYear = $startYear + 1;
        $academicYearEn = "{$startYear}-{$endYear} expected graduation";
        $academicYearPl = "Rok akademicki {$startYear}-{$endYear}";

        $genderDisplay = $student->gender
            ? (strtolower($student->gender) === 'male'
                ? 'Mężczyzna / Male'
                : (strtolower($student->gender) === 'female'
                    ? 'Kobieta / Female'
                    : ucfirst($student->gender)))
            : 'N/A';

        // --- Profile photo (added) ---
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
                $photoData = null;
            }
        }
    @endphp

    {{-- Header (Biuro Spraw Studenckich / Student Affairs Office) --}}
    <table class="header-table">
        <tr>
            <td style="width: 48%;">
                <div class="uni-pl navy">UNIWERSYTET RADOMSKI</div>
                <div class="uni-en navy">RADOM UNIVERSITY</div>
                <p class="uni-sub">Biuro Spraw Studenckich / Student Affairs Office</p>
            </td>
            <td style="width: 30%;">
                <div class="contact-block">
                    <div>Tel: +48 73 947 16 22</div>
                    <div>Radom, Poland</div>
                    <div>E-mail: admission@radomuniversity.pl</div>
                </div>
            </td>
            <td class="photo-cell">
                <div class="photo-box">
                    @if ($photoData)
                        <img src="data:{{ $photoMime }};base64,{{ $photoData }}" alt="">
                    @else
                        <div class="photo-placeholder">Foto<br>N/A</div>
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <hr class="rule" />

    <div class="doc-title navy">
        <p class="pl">Zaświadczenie o statusie studenta</p>
        <p class="en">Certificate of Student Status</p>
    </div>

    <table class="meta-row-table meta-row">
        <tr>
            <td>
                <strong>Nr dokumentu / Document Number:</strong>
                {{ $student->application_number ?? now()->format('d/m/Y') }}/{{ str_pad($student->id, 3, '0', STR_PAD_LEFT) }}
            </td>
            <td class="meta-right">
                <strong>Data wydania / Date of Issue:</strong> {{ now()->format('d.m.Y') }}
            </td>
        </tr>
    </table>

    <div class="section-banner">Dane studenta / Student Information</div>
    <table class="data-table">
        <tr>
            <td>
                <div class="field-label">Imię i nazwisko / Full Name:</div>
                <div class="field-value">{{ tr_upper($student->first_name) }} {{ tr_upper($student->last_name) }}</div>
            </td>
            <td>
                <div class="field-label">Imię ojca / Father's Name:</div>
                <div class="field-value">{{ tr_upper($student->father_name ?? 'N/A') }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="field-label">Data urodzenia / Date of Birth:</div>
                <div class="field-value">
                    {{ $student->date_of_birth ? $student->date_of_birth->format('d.m.Y') : 'N/A' }}</div>
            </td>
            <td>
                <div class="field-label">Płeć / Gender:</div>
                <div class="field-value">{{ $genderDisplay }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="field-label">Miejsce urodzenia / Place of Birth:</div>
                <div class="field-value">{{ $placeOfBirthDisplay }}</div>
            </td>
            <td>
                <div class="field-label">Numer albumu / Student ID Number:</div>
                <div class="field-value">{{ $student->student_number ?? 'N/A' }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="field-label">Obywatelstwo / Nationality:</div>
                <div class="field-value">{{ $nationalityDisplay }}</div>
            </td>
            <td>
                <div class="field-label">Adres e-mail / E-mail Address:</div>
                <div class="field-value">{{ $student->email ?? 'N/A' }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="field-label">Numer dokumentu / Passport Number:</div>
                <div class="field-value">{{ $student->passport_number ?? 'N/A' }}</div>
            </td>
            <td>
                <div class="field-label">Numer telefonu / Phone Number:</div>
                <div class="field-value">{{ $student->phone ?? 'N/A' }}</div>
            </td>
        </tr>
    </table>

    <div class="section-banner">Dane programu / Programme Information</div>
    <table class="data-table">
        <tr>
            <td>
                <div class="field-label">Kierunek studiów / Study Programme:</div>
                <div class="field-value">{{ $programNamePl }} / {{ $programNameEn }}</div>
            </td>
            <td>
                <div class="field-label">Wydział / Faculty:</div>
                <div class="field-value">{{ $facultyNamePl }} / {{ $facultyNameEn }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="field-label">Poziom studiów / Degree Level:</div>
                <div class="field-value">{{ $degreeNamePl }} / {{ $degreeNameEn }}</div>
            </td>
            <td>
                <div class="field-label">Rok studiów / Year of Study:</div>
                <div class="field-value">{{ $classYear }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="field-label">Forma studiów / Mode of Study:</div>
                <div class="field-value">{{ $educationTypePl }} / {{ $educationTypeEn }}</div>
            </td>
            <td>
                <div class="field-label">Przewidywany rok ukończenia studiów / Expected Graduation:</div>
                <div class="field-value">{{ $startYear }}/{{ $endYear }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="field-label">Język kształcenia / Language of Instruction:</div>
                <div class="field-value">{{ $studyLangDisplay }}</div>
            </td>
            <td>
                <div class="field-label">Status studenta / Student Status:</div>
                <div class="field-value">Aktywny / Active</div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="field-label">Forma studiów / Mode of Study:</div>
                <div class="field-value">Studia stacjonarne
                    Full-Time Study</div>
            </td>
            <td>
                <div class="field-label">Status stypendium / Scholarship Status:</div>
                <div class="field-value">{{ $scholarshipPl }} / {{ $scholarshipEn }}</div>
            </td>
        </tr>
    </table>

    @php
        $duration = $degree?->duration ?? 4;
        $durationPl = $duration === 1 ? 'rok' : ($duration < 5 ? 'lata' : 'lat');
    @endphp

    {{-- Two-column body: PL | EN --}}
    <table class="body-columns">
        <tr>
            <td>
                <p>Osoba, której dane wskazano powyżej, jest zarejestrowanym studentem naszej uczelni. Przewidywany
                    czas trwania programu wynosi {{ $duration }} {{ $durationPl }}. Zgodnie z odpowiednimi
                    przepisami
                    Regulaminu Studiów, student zobowiązany jest do spełniania wymogów programu. Niniejsze zaświadczenie
                    wydano na wniosek osoby, której dotyczy. Oczekuje się osiągnięcia etapu ukończenia studiów w roku
                    akademickim {{ $startYear }}-{{ $endYear }}.</p>
            </td>
            <td class="en-col">
                <p>The person named above is a registered student of our university. The foreseen duration of the
                    programme is {{ $duration }} years. In accordance with the Study Regulations, the
                    student must fulfil programme requirements. This certificate is issued upon the request of the
                    person concerned. Graduation is expected in the {{ $startYear }}-{{ $endYear }} academic
                    year.</p>
            </td>
        </tr>
    </table>

    </div>{{-- .page-content --}}

    @php
        $stampPath = public_path('images/radom-möhür.png');
        $stampData = file_exists($stampPath) ? base64_encode(file_get_contents($stampPath)) : '';

        $signaturePath = public_path('images/imza.png');

        $verificationCodeForUrl = $verificationCode ?? null;
        $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
        $codeForEntry = isset($digitCode) && $digitCode !== null ? trim((string) $digitCode) : '—';
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(48)->generate($verificationUrl);
        $qrCodeBase64 = base64_encode($qrCode);
    @endphp

    <div class="page-bottom-fixed">
        <div class="signature-block">
            <table class="signature-inner" align="right">
                <tr>
                    <td>
                        <div class="sig-graphic-wrap">
                            @if ($stampData)
                                <img class="sig-stamp-overlay" src="data:image/png;base64,{{ $stampData }}"
                                    alt="">
                            @endif
                        </div>
                        <div class="e-sign-box">
                            <div class="e-sign-badge">Podpis elektroniczny / E-Signed</div>
                            <div class="e-sign-name">Michał Kowalski</div>
                            <div class="e-sign-title">Dyrektor Działu Spraw Studenckich / Director of Student Affairs</div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="verification-wrap">
            <div class="verification-header">
                Weryfikacja autentyczności dokumentu / Document Verification
            </div>
            <table class="verification-body">
                <tr>
                    <td class="qr-cell">
                        <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt="" />
                    </td>
                    <td class="text-cell">
                        Zeskanuj kod QR lub otwórz link weryfikacyjny, aby potwierdzić autentyczność niniejszego dokumentu.
                        Po wyświetleniu monitu wpisz 4-cyfrowy kod: <strong>{{ $codeForEntry }}</strong><br />
                        Scan the QR code or open the verification link. Enter the 4-digit code:
                        <strong>{{ $codeForEntry }}</strong>
                    </td>
                    <td class="code-cell">
                        <div class="verification-url">{{ $verificationUrl }}</div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer-line">
            Radom, Poland &nbsp;|&nbsp; Tel: +48 73 947 16 22 &nbsp;|&nbsp; E-mail:
            admission@radomuniversity.pl
        </div>
    </div>

</body>

</html>