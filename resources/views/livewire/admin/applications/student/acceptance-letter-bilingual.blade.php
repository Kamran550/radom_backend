<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warunkowy list przyjęcia / Conditional Acceptance Letter - {{ $student->first_name }}
        {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 9.5mm;
            size: A4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 7.25pt;
            line-height: 1.34;
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
            margin-bottom: 8px;
        }

        .header-table td {
            vertical-align: top;
            padding: 0;
        }

        .uni-pl {
            font-family: 'DejaVu Serif', Georgia, serif;
            font-size: 12pt;
            font-weight: bold;
            color: #1a237e;
            margin: 0;
            line-height: 1.1;
        }

        .uni-en {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9.5pt;
            font-weight: bold;
            color: #1a237e;
            margin: 2px 0 0 0;
        }

        .uni-sub {
            font-size: 6.5pt;
            color: #333;
            margin: 3px 0 0 0;
            line-height: 1.25;
        }

        .contact-block {
            text-align: right;
            font-size: 6.75pt;
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
            margin: 0 0 7px 0;
        }

        .doc-title .pl {
            font-size: 9.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a237e;
            margin: 0;
        }

        .doc-title .en {
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #1a237e;
            margin: 2px 0 0 0;
        }

        .meta-row {
            width: 100%;
            margin-bottom: 9px;
            font-size: 7.25pt;
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

        .greeting-pl {
            margin: 0 0 2px 0;
        }

        .greeting-en {
            margin: 0 0 4px 0;
        }

        .intro-pl {
            margin: 0 0 4px 0;
            text-align: justify;
            font-style: italic;
            color: #222;
        }

        .intro-en {
            margin: 0 0 10px 0;
            text-align: justify;
            font-style: italic;
            color: #222;
        }

        .section-heading {
            font-size: 7.25pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            margin: 9px 0 4px 0;
            padding-bottom: 3px;
            border-bottom: 1px solid #999;
            color: #000;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 7.5pt;
            margin-bottom: 3px;
        }

        .data-table td {
            border: 1px solid #ccc;
            padding: 4px 6px;
            vertical-align: top;
        }

        .data-table td.label {
            font-weight: bold;
            width: 42%;
            background: #f5f5f5;
            color: #111;
        }

        .conditions-intro-row td {
            border: none;
            padding: 3px 4px 2px 4px;
            vertical-align: top;
            font-size: 6.25pt;
            width: 50%;
            text-align: justify;
        }

        .conditions-table {
            width: 100%;
            border-collapse: collapse;
            margin: 3px 0 7px 0;
            font-size: 7pt;
        }

        .conditions-table td {
            border: none;
            padding: 0 4px 0 0;
            vertical-align: top;
            width: 50%;
            text-align: justify;
        }

        .conditions-table ul {
            margin: 3px 0 0 14px;
            padding: 0;
        }

        .conditions-table li {
            margin: 1px 0;
        }

        .highlight-box {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: center;
            font-size: 7pt;
            margin: 8px 0 12px 0;
            line-height: 1.32;
        }

        .footer-three {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
            margin-bottom: 6px;
        }

        .footer-three td {
            width: 33.33%;
            vertical-align: bottom;
            padding: 4px 3px;
            font-size: 6.75pt;
        }

        .sig-line {
            border-top: 1px solid #333;
            padding-top: 4px;
            margin-top: 22px;
            text-align: center;
            line-height: 1.25;
        }

        .seal-placeholder {
            width: 58px;
            height: 58px;
            margin: 0 auto;
            border: 2px dashed #999;
            border-radius: 50%;
            text-align: center;
            font-size: 6pt;
            color: #666;
            padding: 11px 4px 0 4px;
            line-height: 1.1;
        }

        .verification-box {
            border: 1px solid #999;
            padding: 5px 6px;
            font-size: 6.5pt;
        }

        .verification-box h4 {
            margin: 0 0 4px 0;
            font-size: 6.75pt;
            text-transform: uppercase;
            letter-spacing: 0.02em;
            text-align: center;
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
            width: 54px;
            padding-right: 6px;
        }

        .verification-url {
            word-break: break-all;
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 5.75pt;
            margin-top: 3px;
        }

        .doc-note {
            text-align: center;
            font-size: 6.5pt;
            color: #444;
            margin-top: 6px;
            padding-top: 5px;
            border-top: 1px solid #ddd;
            line-height: 1.3;
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
        $facultyName = $student->application->program?->faculty?->name ?? 'N/A';
        $programName = $student->application->program?->name ?? 'N/A';
        $durationStudies = $student->application->program?->degree?->duration ?? 'N/A';
        $beginStudiesYear = now()->month <= 8 ? now()->year : now()->addYear()->year;
        $priceYear = (float) ($student->application->program?->price_per_year ?? 4000);
        $tuitionSemesterEur = $priceYear > 0 ? round($priceYear / 2) : 3000;
        $studyLangLabel = $student->study_language === 'en' ? 'English' : 'Turkish';
        $citizenship = $student->nationality ?: ($student->country ?? 'N/A');
        $dobFormatted = $student->date_of_birth ? $student->date_of_birth->format('j F Y') : 'N/A';
        $refNo = $student->application_number ?? ('RADOM/' . $student->id);
        $fullName = trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? ''));
        $studyLevelLabel = $student->application->program?->degree?->name ?? 'N/A';
        $modeOfStudy = 'Full-time';
        $programDurationLabel = is_numeric($durationStudies) ? $durationStudies . ' years' : $durationStudies;
        $durationYearsInt = is_numeric($durationStudies) ? (int) $durationStudies : null;
        $intendedStartDate = 'September ' . $beginStudiesYear;
        $expectedGraduationDate =
            $durationYearsInt !== null ? 'September ' . ($beginStudiesYear + $durationYearsInt) : 'N/A';

        $scholarshipStatusLabel = match ($student->scholarship_status ?? '') {
            \App\Enums\ScholarshipStatusEnum::PERCENT_75->value => '75% tuition scholarship',
            \App\Enums\ScholarshipStatusEnum::PERCENT_100->value => '100% tuition scholarship',
            default => $student->scholarship_status
                ? $student->scholarship_status . ' tuition scholarship'
                : 'As per application',
        };

        $issueDateFormatted = now()->format('j F Y');

        $scholarshipStatusLabelPl = match ($student->scholarship_status ?? '') {
            \App\Enums\ScholarshipStatusEnum::PERCENT_75->value => 'Stypendium na czesne – 75%',
            \App\Enums\ScholarshipStatusEnum::PERCENT_100->value => 'Stypendium na czesne – 100%',
            default => $student->scholarship_status
                ? 'Stypendium: ' . $student->scholarship_status
                : 'Zgodnie z oceną wniosku',
        };
        $studyLangLabelPl = $student->study_language === 'en' ? 'Angielski' : 'Turecki';
        $programDurationLabelPl = is_numeric($durationStudies) ? $durationStudies . ' lat' : $programDurationLabel;
        $modeOfStudyPl = 'Studia stacjonarne';
    @endphp

    <table class="header-table">
        <tr>
            <td style="width: 52%;">
                <div class="uni-pl navy">UNIWERSYTET RADOMSKI</div>
                <div class="uni-en navy">RADOM UNIVERSITY</div>
                <p class="uni-sub">Biuro Rekrutacji Międzynarodowej / International Admissions Office</p>
            </td>
            <td style="width: 48%;">
                <div class="contact-block">
                    <div>Tel: +48 579 277 493</div>
                    <div>E-mail: admissions@radomuniversity.pl</div>
                </div>
            </td>
        </tr>
    </table>

    <hr class="rule" />

    <div class="doc-title navy">
        <p class="pl">Warunkowy list przyjęcia</p>
        <p class="en">Conditional Letter of Acceptance</p>
    </div>

    <table class="meta-row-table meta-row">
        <tr>
            <td><strong>Numer referencyjny / Reference Number:</strong> {{ $refNo }}</td>
            <td class="meta-right"><strong>Data wydania / Date of Issue:</strong> {{ $issueDateFormatted }}</td>
        </tr>
    </table>

    <p class="greeting-pl">Szanowny Kandydacie,</p>
    <p class="greeting-en">Dear Applicant,</p>

    <p class="intro-pl">
        Z przyjemnością informujemy, że po rozpatrzeniu dokumentów rekrutacyjnych został(a) Pan(i) przyjęty(a)
        warunkowo na Uniwersytecie Radomskim na program studiów określony poniżej.
    </p>
    <p class="intro-en">
        We are pleased to inform you that, based on the evaluation of your application documents, you have been
        conditionally accepted to Radom University for the programme detailed below.
    </p>

    <div class="section-heading">Dane kandydata / Applicant Information</div>
    <table class="data-table">
        <tr>
            <td class="label">Imię i nazwisko / Full Name</td>
            <td>{{ $fullName }}</td>
        </tr>
        <tr>
            <td class="label">Data urodzenia / Date of Birth</td>
            <td>{{ $dobFormatted }}</td>
        </tr>
        <tr>
            <td class="label">Obywatelstwo / Nationality</td>
            <td>{{ $citizenship }}</td>
        </tr>
        <tr>
            <td class="label">Numer paszportu / Passport Number</td>
            <td>{{ $student->passport_number ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-heading">Informacje o programie / Programme Information</div>
    <table class="data-table">
        <tr>
            <td class="label">Kierunek studiów / Field of Study</td>
            <td>{{ $programName }}</td>
        </tr>
        <tr>
            <td class="label">Poziom studiów / Study Level</td>
            <td>{{ $studyLevelLabel }}</td>
        </tr>
        <tr>
            <td class="label">Forma studiów / Mode of Study</td>
            <td>{{ $modeOfStudyPl }} / {{ $modeOfStudy }}</td>
        </tr>
        <tr>
            <td class="label">Język nauczania / Language of Instruction</td>
            <td>{{ $studyLangLabelPl }} / {{ $studyLangLabel }}</td>
        </tr>
        <tr>
            <td class="label">Czas trwania programu / Programme Duration</td>
            <td>{{ $programDurationLabelPl }} / {{ $programDurationLabel }}</td>
        </tr>
        <tr>
            <td class="label">Planowany termin rozpoczęcia / Intended Start Date</td>
            <td>{{ $intendedStartDate }}</td>
        </tr>
        <tr>
            <td class="label">Planowany termin ukończenia / Expected Graduation Date</td>
            <td>{{ $expectedGraduationDate }}</td>
        </tr>
        <tr>
            <td class="label">Status stypendium / Scholarship Status</td>
            <td>{{ $scholarshipStatusLabelPl }} / {{ $scholarshipStatusLabel }}</td>
        </tr>
    </table>

    <div class="section-heading">Warunki przyjęcia / Conditions of Acceptance</div>
    <table class="conditions-table">
        <tr>
            <td>
                Niniejsze przyjęcie ma charakter warunkowy i jest ważne pod warunkiem spełnienia następujących wymogów:
                <ul>
                    <li>złożenie oryginałów dokumentów potwierdzających wykształcenie,</li>
                    <li>pozytywna weryfikacja dokumentów przez Uczelnię,</li>
                    <li>ukończenie procedur rejestracji i opłat,</li>
                    <li>spełnienie wymogów wizowych i imigracyjnych.</li>
                </ul>
            </td>
            <td>
                This admission is conditional and valid subject to the fulfillment of the following requirements:
                <ul>
                    <li>submission of original academic documents,</li>
                    <li>successful verification of documents by the University,</li>
                    <li>completion of registration and payment procedures,</li>
                    <li>fulfillment of visa and immigration requirements.</li>
                </ul>
            </td>
        </tr>
    </table>

    <div class="highlight-box">
        Po spełnieniu powyższych warunków uzyska Pan(i) pełny status studenta Uniwersytetu Radomskiego.<br />
        Upon successful completion of all the above conditions, you will obtain full student status at Radom
        University.
    </div>

    @php
        $verificationCodeForUrl = $verificationCode ?? null;
        $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
        $codeForEntry = isset($digitCode) && $digitCode !== null ? trim((string) $digitCode) : '—';
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(50)
            ->generate($verificationUrl);
        $qrCodeBase64 = base64_encode($qrCode);
    @endphp

    <table class="footer-three">
        <tr>
            <td>
                <div class="sig-line">
                    <strong>Prof. Dr. Tomasz Zieliński</strong><br />
                    REKTOR / RECTOR
                </div>
            </td>
            {{-- <td style="text-align: center;">
                <div style="display: inline-block;">
                    <div class="seal-placeholder">Pieczęć uczelni<br />University Seal</div>
                </div>
            </td> --}}
            <td>
                <div class="verification-box">
                    <h4>Weryfikacja dokumentu / Document Verification</h4>
                    <table class="verification-inner">
                        <tr>
                            <td class="qr-cell">
                                <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                                    style="width: 48px; height: 48px; display: block;" />
                            </td>
                            <td>
                                <div><strong>Kod weryfikacyjny / Verification Code:</strong> {{ $codeForEntry }}</div>
                                <div class="verification-url"><strong>Weryfikacja / Verification:</strong>
                                    {{ $verificationUrl }}</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <p class="doc-note">
        Niniejszy dokument został wygenerowany elektronicznie i nie wymaga podpisu ani pieczęci.<br />
        This document has been generated electronically and does not require a signature or stamp.
    </p>

</body>

</html>
