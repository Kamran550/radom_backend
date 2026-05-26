<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditional Acceptance Letter - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 10.5mm;
            size: A4;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            font-size: 9pt;
            line-height: 1.42;
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

        .uni-serif {
            font-family: 'DejaVu Serif', Georgia, 'Times New Roman', serif;
            font-size: 15pt;
            font-weight: bold;
            letter-spacing: 0.02em;
            color: #1a237e;
            margin: 0 0 3px 0;
            line-height: 1.15;
        }

        .uni-sub {
            font-size: 7pt;
            color: #333;
            margin: 0;
            font-weight: normal;
        }

        .contact-block {
            text-align: right;
            font-size: 8pt;
            line-height: 1.45;
            color: #222;
        }

        .contact-block div {
            margin: 0;
        }

        .rule {
            border: none;
            border-top: 1px solid #bbb;
            margin: 9px 0 12px 0;
        }

        .doc-title {
            font-family: 'DejaVu Sans', Helvetica, Arial, sans-serif;
            text-align: center;
            font-size: 11.5pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: #1a237e;
            margin: 0 0 10px 0;
        }

        .meta-row {
            width: 100%;
            margin-bottom: 14px;
            font-size: 9pt;
        }

        .meta-row-table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta-row-table td {
            width: 50%;
            padding: 0;
        }

        .meta-right {
            text-align: right;
        }

        .greeting {
            margin: 0 0 7px 0;
            font-weight: normal;
        }

        .intro {
            margin: 0 0 16px 0;
            text-align: justify;
            font-style: italic;
            color: #222;
        }

        .section-heading {
            font-size: 9pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin: 14px 0 6px 0;
            padding-bottom: 4px;
            border-bottom: 1px solid #999;
            color: #000;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8.5pt;
            margin-bottom: 4px;
        }

        .data-table td {
            border: 1px solid #ccc;
            padding: 7px 9px;
            vertical-align: top;
        }

        .data-table td.label {
            font-weight: bold;
            width: 38%;
            background: #f5f5f5;
            color: #111;
        }

        .conditions-intro {
            margin: 6px 0 5px 0;
            text-align: justify;
        }

        .conditions-list {
            margin: 5px 0 11px 20px;
            padding: 0;
        }

        .conditions-list li {
            margin: 3px 0;
        }

        .highlight-box {
            border: 1px solid #999;
            padding: 11px 13px;
            text-align: center;
            font-size: 8.5pt;
            margin: 12px 0 17px 0;
            line-height: 1.38;
        }

        .footer-three {
            width: 100%;
            border-collapse: collapse;
            margin-top: 7px;
            margin-bottom: 10px;
        }

        .footer-three td {
            width: 33.33%;
            vertical-align: bottom;
            padding: 7px 6px;
            font-size: 8pt;
        }

        .sig-line {
            border-top: 1px solid #333;
            padding-top: 6px;
            margin-top: 32px;
            text-align: center;
            line-height: 1.32;
        }

        .seal-placeholder {
            width: 70px;
            height: 70px;
            margin: 0 auto;
            border: 2px dashed #999;
            border-radius: 50%;
            text-align: center;
            font-size: 6.5pt;
            color: #666;
            padding: 16px 7px 0 7px;
            line-height: 1.22;
        }

        .verification-box {
            border: 1px solid #999;
            padding: 7px 9px;
            font-size: 7.25pt;
        }

        .verification-box h4 {
            margin: 0 0 7px 0;
            font-size: 8pt;
            text-transform: uppercase;
            letter-spacing: 0.03em;
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
            width: 70px;
            padding-right: 8px;
        }

        .verification-url {
            word-break: break-all;
            font-family: 'DejaVu Sans Mono', monospace;
            font-size: 7pt;
            margin-top: 4px;
        }

        .doc-note {
            text-align: center;
            font-size: 7.5pt;
            color: #444;
            margin-top: 11px;
            padding-top: 7px;
            border-top: 1px solid #ddd;
        }

        @media print {
            body {
                margin: 0;
            }

            .no-print {
                display: none;
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
    @endphp

    {{-- Header --}}
    <table class="header-table">
        <tr>
            <td style="width: 52%;">
                <div class="uni-serif navy">RADOM UNIVERSITY</div>
                <p class="uni-sub">International Admissions Office</p>
            </td>
            <td style="width: 48%;">
                <div class="contact-block">
                    <div>Jacka Malczewskiego 24, 26-600 Radom, Poland</div>
                    <div>Tel: +48 73 947 16 22</div>
                    <div>E-mail: admissions@radomuniversity.pl</div>
                </div>
            </td>
        </tr>
    </table>

    <hr class="rule" />

    <h1 class="doc-title navy">Conditional Letter of Acceptance</h1>

    <table class="meta-row-table meta-row">
        <tr>
            <td><strong>Reference Number:</strong> {{ $refNo }}</td>
            <td class="meta-right"><strong>Date of Issue:</strong> {{ $issueDateFormatted }}</td>
        </tr>
    </table>

    <p class="greeting">Dear Applicant,</p>
    <p class="intro">
        We are pleased to inform you that, based on the evaluation of your application documents, you have been
        conditionally accepted to Radom University for the programme detailed below.
    </p>

    <div class="section-heading">Applicant Information</div>
    <table class="data-table">
        <tr>
            <td class="label">Full Name</td>
            <td>{{ $fullName }}</td>
        </tr>
        <tr>
            <td class="label">Date of Birth</td>
            <td>{{ $dobFormatted }}</td>
        </tr>
        <tr>
            <td class="label">Nationality</td>
            <td>{{ $citizenship }}</td>
        </tr>
        <tr>
            <td class="label">Passport Number</td>
            <td>{{ $student->passport_number ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-heading">Programme Information</div>
    <table class="data-table">
        <tr>
            <td class="label">Field of Study</td>
            <td>{{ $programName }}</td>
        </tr>
        <tr>
            <td class="label">Study Level</td>
            <td>{{ $studyLevelLabel }}</td>
        </tr>
        <tr>
            <td class="label">Mode of Study</td>
            <td>{{ $modeOfStudy }}</td>
        </tr>
        <tr>
            <td class="label">Language of Instruction</td>
            <td>{{ $studyLangLabel }}</td>
        </tr>
        <tr>
            <td class="label">Programme Duration</td>
            <td>{{ $programDurationLabel }}</td>
        </tr>
        <tr>
            <td class="label">Intended Start Date</td>
            <td>{{ $intendedStartDate }}</td>
        </tr>
        <tr>
            <td class="label">Expected Graduation Date</td>
            <td>{{ $expectedGraduationDate }}</td>
        </tr>
        <tr>
            <td class="label">Scholarship Status</td>
            <td>{{ $scholarshipStatusLabel }}</td>
        </tr>
    </table>

    <div class="section-heading">Conditions of Acceptance</div>
    <p class="conditions-intro">
        This admission is conditional and valid subject to the fulfillment of the following requirements:
    </p>
    <ul class="conditions-list">
        <li>submission of original academic documents,</li>
        <li>successful verification of documents by the University,</li>
        <li>completion of registration and payment procedures,</li>
        <li>fulfillment of visa and immigration requirements.</li>
    </ul>

    <div class="highlight-box">
        Upon successful completion of all the above conditions, you will obtain full student status at Radom
        University.
    </div>

    {{-- Footer: signature | seal | verification --}}
    @php
        $verificationCodeForUrl = $verificationCode ?? null;
        $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
        $codeForEntry = isset($digitCode) && $digitCode !== null ? trim((string) $digitCode) : '—';
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(52)
            ->generate($verificationUrl);
        $qrCodeBase64 = base64_encode($qrCode);
    @endphp

    <table class="footer-three">
        <tr>
            <td>
                <div class="sig-line">
                    <strong>Prof. Dr. Tomasz Zieliński</strong><br />
                    RECTOR
                </div>
            </td>
            <td style="text-align: center;">
                <div style="display: inline-block;">
                    <div class="seal-placeholder">University Seal</div>
                </div>
            </td>
            <td>
                <div class="verification-box">
                    <h4>Document Verification</h4>
                    <table class="verification-inner">
                        <tr>
                            <td class="qr-cell">
                                <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                                    style="width: 50px; height: 50px; display: block;" />
                            </td>
                            <td>
                                <div><strong>Verification Code:</strong> {{ $codeForEntry }}</div>
                                <div class="verification-url"><strong>Verification:</strong> {{ $verificationUrl }}</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <p class="doc-note">
        This document has been generated electronically and does not require a signature or stamp.
    </p>

</body>

</html>
