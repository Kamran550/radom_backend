<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conditional Acceptance Letter - {{ $student->first_name }} {{ $student->last_name }}</title>
    <style>
        @page {
            margin: 12mm;
            size: A4;
        }

        body {
            /* font-family: 'Times New Roman', 'Times', 'Georgia', serif; */
            font-family: 'DejaVu Serif', 'Times New Roman', serif;

            font-size: 7.2pt;
            line-height: 1.3;
            color: #000;
            margin: 0;
            padding: 0;
            padding-bottom: 180px;
            background: white;
            position: relative;
            min-height: 100vh;
        }

        .letter-meta {
            font-size: 7.5pt;
            margin-bottom: 10px;
        }

        .header {
            padding: 5px 0;
            margin-bottom: 8px;
        }

        .university-name {
            font-size: 12pt;
            font-weight: bold;
            text-align: center;
            margin: 6px 0 2px 0;
            letter-spacing: 0.04em;
        }

        .document-title {
            font-size: 11pt;
            font-weight: bold;
            text-align: center;
            margin: 4px 0 12px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .applicant-lines {
            font-size: 7.5pt;
            line-height: 1.45;
            margin: 0 0 10px 0;
        }

        .applicant-lines div {
            margin: 2px 0;
        }

        .study-details {
            font-size: 7.5pt;
            line-height: 1.45;
            margin: 10px 0;
        }

        .study-details div {
            margin: 2px 0;
        }

        .greeting {
            margin: 8px 0;
            font-size: 7.5pt;
        }

        .content {
            /* margin: 6px 0; */
            text-align: justify;
            line-height: 1.3;
        }

        .content p {
            margin: 4px 0;
        }

        .section-header {
            font-size: 8pt;
            font-weight: bold;
            margin: 8px 0 5px 0;
            padding: 4px 6px;
            /* background-color: #fff; */
            border-left: 3px solid #000;
        }

        .info-grid {
            display: table;
            width: 100%;
            border:none;
            margin: 8px 0;
            border-collapse: collapse;
            font-size: 7pt;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            padding: 4px 6px;
            font-weight: bold;
            width: 40%;
            border: none;
        }

        .info-value {
            display: table-cell;
            padding: 4px 6px;
            border: none;
        }

        .subsection-title {
            font-size: 7.5pt;
            font-weight: bold;
            margin: 8px 0 4px 0;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
            font-size: 6.5pt;

        }

        .payment-table th,
        .payment-table td {
            padding: 3px 5px;
            border: 1px solid #000;
            text-align: left;
        }

        .payment-table th {
            background-color: #fff;
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 6pt;
        }

        .proficiency-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 6pt;
        }

        .proficiency-table th,
        .proficiency-table td {
            padding: 4px 5px;
            border: 1px solid #000;
            text-align: left;
            vertical-align: top;
        }

        .proficiency-table th {
            background-color: #fff;
            color: #000;
            font-weight: bold;
            font-size: 5.5pt;
        }

        .proficiency-table td {
            font-size: 5.5pt;
            line-height: 1.2;
        }

        .required-documents-list {
            margin: 8px 0;
            padding-left: 20px;
        }

        .required-documents-list li {
            margin: 3px 0;
            font-size: 6.5pt;
            line-height: 1.3;
        }

        .closing-section {
            margin-top: 10px;
            margin-bottom: 0px;
        }

        .dates-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
            font-size: 7pt;
        }

        .dates-row {
            display: table-row;
        }

        .dates-label {
            display: table-cell;
            padding: 3px 6px;
            border: 1px solid #000;
            width: 50%;
            font-weight: 600;
        }

        .dates-value {
            display: table-cell;
            padding: 3px 6px;
            border: 1px solid #000;
        }

        .important-box {
            margin: 8px 0;
            padding: 6px;
            border: 1.5px solid #000;
            /* background-color: #fff; */
        }

        .important-title {
            font-size: 8pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .important-box ol {
            margin: 5px 0;
            padding-left: 15px;
            font-size: 6pt;
        }

        .important-box li {
            margin: 3px 0;
            line-height: 1.2;
        }

        .end-line {
            text-align: center;
            font-weight: bold;
            margin: 10px 0;
            font-size: 7pt;
        }

        .verification-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            margin-top: 15px;
            padding: 0;
        }

        /* Plain block like sample PDF: heading, URL line, QR + instructions */
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

        .footer-divider {
            height: 1px;
            background: #000;
            margin: 8px 0 6px 0;
            opacity: 0.25;
        }

        .website-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 5px;
            margin: 5px 0;
            font-size: 7pt;
        }

        .social-row {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            margin-top: 5px;
        }

        .social-handle {
            font-size: 7pt;
            color: #000;
            margin-left: 2px;
        }

        .social-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #333;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 10pt;
            font-weight: bold;
            line-height: 1;
        }

        .social-icon.instagram {
            font-size: 12pt;
        }

        .social-icon.twitter {
            font-size: 11pt;
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
    @php
        $facultyName = $student->application->program?->faculty?->name ?? 'N/A';
        $programName = $student->application->program?->name ?? 'N/A';
        $durationStudies = $student->application->program?->degree?->duration ?? 'N/A';
        $beginStudiesYear = now()->month <= 8 ? now()->year : now()->addYear()->year;
        $priceYear = (float) ($student->application->program?->price_per_year ?? 4000);
        $tuitionSemesterEur = $priceYear > 0 ? round($priceYear / 2) : 3000;
        $studyLangLabel = $student->study_language === 'en' ? 'English' : 'Turkish';
        $citizenship = $student->nationality ?: ($student->country ?? 'N/A');
        $dob = $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : 'N/A';
        $refNo = $student->application_number ?? ('RADOM/' . $student->id);
    @endphp

    <div class="letter-meta">
        Płock, Poland, {{ now()->format('d.m.Y') }} {{ $refNo }}
    </div>

    <div class="university-name">Radom University</div>
    <div class="document-title">Conditional Letter of Acceptance</div>

    <div class="applicant-lines">
        <div><strong>Family name:</strong> {{ $student->last_name }}</div>
        <div><strong>First name:</strong> {{ $student->first_name }}</div>
        <div><strong>Citizenship:</strong> {{ $citizenship }}</div>
        <div><strong>Date of birth:</strong> {{ $dob }}</div>
        <div><strong>Passport:</strong> {{ $student->passport_number ?? 'N/A' }}</div>
    </div>

    <div class="content">
        <p>
            It is a great pleasure for me to inform you that you successfully passed the entrance examination of the
            {{ $facultyName }} of Radom University, Poland.
        </p>
    </div>

    <div class="study-details">
        <div><strong>Study Location:</strong> Płock, Poland</div>
        <div><strong>Study language:</strong> {{ $studyLangLabel }}</div>
        <div><strong>Study Programme:</strong> {{ $programName }}</div>
        <div><strong>Study level:</strong> full-time</div>
        <div><strong>Duration of studies:</strong> {{ is_numeric($durationStudies) ? $durationStudies . ' years' : $durationStudies }}</div>
        <div><strong>Beginning of studies:</strong> September {{ $beginStudiesYear }}</div>
    </div>

    <div class="content">
        <p>On receiving the first semester tuition fee and the accommodation fee:</p>
        <p>
            The tuition fee /semester: €{{ number_format($tuitionSemesterEur, 0, '.', ',') }} per semester EUR<br>
            The accommodation fee / semester: 650 EUR
        </p>
        <p>FINAL LETTER OF ACCEPTANCE is issued and sent to you to start your VISA application.</p>
        <p>The tuition fee is primarily non-refundable, except in the case of visa refusal.</p>
        <p>
            Accommodation is provided to you in the student dormitories of Radom University, situated at the campus.<br>
            Address: Poland – 09-407 Płock, Aleja Józefa Piłsudskiego 35.
        </p>
        <p>
            You can find the invoices for the first semester tuition and accommodation fee by logging into your RADOM
            Application Platform account and checking the “Invoice” section. By clicking on the invoice, you will see the
            available payment options.
        </p>
        <p>For payment by bank transfer to the University’s account, please use the bank details below. For all bank transfers, name, surname and application number must be provided. After completing the transfer, upload a copy of the bank receipt or payment confirmation to the RADOM Application Platform.</p>
        <p>We look forward to welcoming you at Radom University.</p>
    </div>

    <!-- Payment Table -->
    <table class="payment-table">
        <thead>
            <tr>
                <th>PAYMENT INFORMATION</th>
                <th>EURO ACCOUNT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>BANK NAME</strong></td>
                <td>Santander Bank Polska S.A.</td>
            </tr>
            <tr>
                <td><strong>CITY / COUNTRY</strong></td>
                <td>Warszawa - Poland</td>
            </tr>
            <tr>
                <td><strong>ACCOUNT NAME</strong></td>
                <td>MAZOVIA.UNIV OF SCI AND TECH.SP.ZOO</td>
            </tr>
            <tr>
                <td><strong>IBAN</strong></td>
                <td>PL13109010140000071219812874</td>
            </tr>
            <tr>
                <td><strong>SWIFT CODE</strong></td>
                <td>WBKPPLPP</td>
            </tr>
            <tr>
                <td><strong>DEPOSIT AMOUNT</strong></td>
                <td>1000 EUR</td>
            </tr>
        </tbody>
    </table>

    <br>

    <!-- Footer Section (verification block styled like sample PDF) -->
    <div class="verification-footer">
        @php
            $verificationCodeForUrl = $verificationCode ?? null;
            $verificationUrl = $student->getVerificationUrl($verificationCodeForUrl);
            $codeForEntry = isset($digitCode) && $digitCode !== null ? trim((string) $digitCode) : '—';
            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                ->size(70)
                ->generate($verificationUrl);
            $qrCodeBase64 = base64_encode($qrCode);
        @endphp

        <div class="verification-pdf">
            <p class="verification-pdf-title">Check the authenticity of this document:</p>
            <p class="verification-pdf-url">{{ $verificationUrl }}</p>
            <table class="verification-pdf-layout">
                <tr>
                    <td class="verification-pdf-qr-cell">
                        <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}" alt=""
                            style="width: 64px; height: 64px; display: block;" />
                    </td>
                    <td class="verification-pdf-text-cell">
                        <p>
                            Scan the QR code or open the link manually in order to check for authenticity of this
                            document. When prompted, type this 4-digit code:
                            <strong>{{ $codeForEntry }}</strong>
                        </p>
                    </td>
                </tr>
            </table>
        </div>

        <div class="footer-divider"></div>

        <!-- Footer Bottom Section -->
        <div style="font-size: 5.5pt; line-height: 1.2; color: #555; text-align: center; margin-top: 4px;">
            <p style="margin: 1px 0;">
                <strong>Tel:</strong> +48 579 277 493 |
                <strong>Email:</strong> international@radomuniversity.pl |
                <strong>Address:</strong> Aleja Józefa Piłsudskiego 35, 09-407 Płock / Poland |
            </p>
        </div>

    </div>

</body>

</html>
