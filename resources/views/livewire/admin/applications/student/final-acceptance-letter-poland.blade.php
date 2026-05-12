<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaświadczenie o statusie studenta - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 8.5mm;
            size: A4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 7pt;
            line-height: 1.32;
            color: #111;
            margin: 0;
            padding: 0;
            background: #fff;
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
            padding: 6px 9px;
            margin: 9px 0 0 0;
            color: #1a237e;
            text-align: center;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 6.85pt;
            margin-bottom: 7px;
        }

        .data-table td {
            border: 1px solid #ccc;
            padding: 4px 7px;
            vertical-align: top;
        }

        .data-table td.label {
            font-weight: bold;
            width: 40%;
            background: #fafafa;
            color: #1a237e;
        }

        .body-columns {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0 7px 0;
            font-size: 7pt;
            line-height: 1.34;
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
            margin: 0 0 4px 0;
        }

        .signature-block {
            margin-top: 8px;
            margin-bottom: 7px;
            font-size: 6.75pt;
        }

        .signature-inner {
            margin-left: auto;
            border-collapse: collapse;
        }

        .signature-inner td {
            vertical-align: bottom;
            padding: 0;
        }

        .sig-line {
            border-top: 1px solid #333;
            padding-top: 4px;
            margin-top: 18px;
            text-align: center;
            line-height: 1.25;
            min-width: 168px;
        }

        .sig-stamp-overlay {
            width: 56px;
            height: auto;
            max-height: 58px;
            object-fit: contain;
            opacity: 0.85;
            display: block;
            margin-right: 10px;
            margin-bottom: 2px;
        }

        .verification-wrap {
            border: 1px solid #ccc;
            padding: 6px 8px;
            margin-top: 5px;
            font-size: 6.35pt;
        }

        .verification-wrap h4 {
            margin: 0 0 5px 0;
            font-size: 6.6pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            color: #1a237e;
        }

        .verification-inner {
            width: 100%;
            border-collapse: collapse;
        }

        .verification-inner td {
            vertical-align: top;
            padding: 0;
        }

        .verification-inner .qr-cell {
            width: 52px;
            padding-right: 6px;
        }

        .verification-url {
            word-break: break-all;
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 5.5pt;
            color: #1a237e;
            margin-top: 3px;
        }

        .verify-instruct {
            font-size: 6pt;
            line-height: 1.3;
            margin: 0 0 4px 0;
        }

        .footer-line {
            text-align: center;
            font-size: 6.25pt;
            color: #444;
            margin-top: 7px;
            padding-top: 6px;
            border-top: 1px solid #ddd;
            line-height: 1.35;
        }

        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>

<body>

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
        $studyLangEn = match ($studyLangCode) {
            'EN' => 'English',
            'TR' => 'Turkish',
            'PL' => 'Polish',
            default => 'English',
        };
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
        $academicYearEn = "{$startYear}-{$endYear} academic year";
        $academicYearPl = "Rok akademicki {$startYear}-{$endYear}";
    @endphp

    {{-- Header (Biuro Spraw Studenckich / Student Affairs Office) --}}
    <table class="header-table">
        <tr>
            <td style="width: 55%;">
                <div class="uni-pl navy">UNIWERSYTET RADOMSKI</div>
                <div class="uni-en navy">RADOM UNIVERSITY</div>
                <p class="uni-sub">Biuro Spraw Studenckich / Student Affairs Office</p>
            </td>
            <td style="width: 45%;">
                <div class="contact-block">
                    <div>Aleja Józefa Piłsudskiego 35, 09-407 Płock, Poland</div>
                    <div>Tel: +48 579 277 493</div>
                    <div>E-mail: info@radomuniversity.pl</div>
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
            <td class="label">Imię i nazwisko / Full Name</td>
            <td>{{ strtoupper($student->first_name) }} {{ strtoupper($student->last_name) }}</td>
        </tr>
        <tr>
            <td class="label">Imię ojca / Father's Name</td>
            <td>{{ strtoupper($student->father_name ?? 'N/A') }}</td>
        </tr>
        <tr>
            <td class="label">Data urodzenia / Date of Birth</td>
            <td>{{ $student->date_of_birth ? $student->date_of_birth->format('d.m.Y') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Płeć / Gender</td>
            <td>
                {{ $student->gender ? (strtolower($student->gender) === 'male' ? 'Mężczyzna / Male' : (strtolower($student->gender) === 'female' ? 'Kobieta / Female' : ucfirst($student->gender))) : 'N/A' }}
            </td>
        </tr>
        <tr>
            <td class="label">Miejsce urodzenia / Place of Birth</td>
            <td>{{ $placeOfBirthDisplay }}</td>
        </tr>
        <tr>
            <td class="label">Numer studenta / Student ID Number</td>
            <td>{{ $student->student_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Obywatelstwo / Nationality</td>
            <td>{{ $nationalityDisplay }}</td>
        </tr>
        <tr>
            <td class="label">Adres e-mail / E-mail Address</td>
            <td>{{ $student->email ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Numer paszportu / Passport Number</td>
            <td>{{ $student->passport_number ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Numer telefonu / Phone Number</td>
            <td>{{ $student->phone ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-banner">Dane programu / Programme Information</div>
    <table class="data-table">
        <tr>
            <td class="label">Program studiów / Study Programme</td>
            <td>{{ $programNamePl }} / {{ $programNameEn }}</td>
        </tr>
        <tr>
            <td class="label">Wydział / Faculty</td>
            <td>{{ $facultyNamePl }} / {{ $facultyNameEn }}</td>
        </tr>
        <tr>
            <td class="label">Poziom studiów / Degree Level</td>
            <td>{{ $degreeNamePl }} / {{ $degreeNameEn }}</td>
        </tr>
        <tr>
            <td class="label">Rok studiów / Year of Study</td>
            <td>{{ $classPl }} / {{ $classEn }}</td>
        </tr>
        <tr>
            <td class="label">Forma studiów / Mode of Study</td>
            <td>{{ $educationTypePl }} / {{ $educationTypeEn }}</td>
        </tr>
        <tr>
            <td class="label">Rok akademicki / Academic Year</td>
            <td>{{ $academicYearPl }} / {{ $academicYearEn }}</td>
        </tr>
        <tr>
            <td class="label">Język nauczania / Language of Instruction</td>
            <td>{{ $studyLangDisplay }}</td>
        </tr>
        <tr>
            <td class="label">Status studenta / Student Status</td>
            <td>Aktywny student / Active student</td>
        </tr>
        <tr>
            <td class="label">Status stypendium / Scholarship Status</td>
            <td>{{ $scholarshipPl }} / {{ $scholarshipEn }}</td>
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

    @php
        $stampPath = public_path('images/radom-möhür.png');
        $stampData = file_exists($stampPath) ? base64_encode(file_get_contents($stampPath)) : '';
    @endphp
    <div class="signature-block">
        <table class="signature-inner" align="right">
            <tr>
                @if ($stampData)
                    <td>
                        <img class="sig-stamp-overlay" src="data:image/png;base64,{{ $stampData }}" alt="">
                    </td>
                @endif
                <td>
                    <div class="sig-line">
                        <strong>Prof. Dr. Tomasz Zieliński</strong><br />
                        REKTOR / RECTOR
                    </div>
                </td>
            </tr>
        </table>
    </div>

    @php
        $verificationCodeForUrl = $verificationCode ?? null;
        $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
        $codeForEntry = isset($digitCode) && $digitCode !== null ? trim((string) $digitCode) : '—';
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')->size(44)->generate($verificationUrl);
        $qrCodeBase64 = base64_encode($qrCode);
    @endphp

    <div class="verification-wrap">
        <h4>Weryfikacja autentyczności dokumentu / Document Verification</h4>
        <table class="verification-inner">
            <tr>
                <td class="qr-cell">
                    <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                        style="width: 42px; height: 42px; display: block;" />
                </td>
                <td>
                    <p class="verify-instruct">
                        Zeskanuj kod QR lub otwórz link, aby sprawdzić autentyczność dokumentu. Po wyświetleniu monitu
                        wpisz 4-cyfrowy kod: <strong>{{ $codeForEntry }}</strong>
                    </p>
                    <p class="verify-instruct">
                        Scan the QR code or open the link to verify this document. When prompted, enter the 4-digit
                        code:
                        <strong>{{ $codeForEntry }}</strong>
                    </p>
                    <div><strong>Kod weryfikacyjny / Verification Code:</strong> {{ $codeForEntry }}</div>
                    <div class="verification-url">{{ $verificationUrl }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer-line">
        Aleja Józefa Piłsudskiego 35, 09-407 Płock, Poland &nbsp;|&nbsp; Tel: +48 579 277 493 &nbsp;|&nbsp; E-mail:
        info@radomuniversity.pl
    </div>

</body>

</html>
