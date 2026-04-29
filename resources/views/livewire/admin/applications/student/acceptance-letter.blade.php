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

        /* Background Watermark */
        body::before {
            content: '';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            background-image: url('{{ public_path('images/RADOM-logo-dark.png') }}');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            opacity: 0.08;
            z-index: -1;
            pointer-events: none;
        }

        .header {
            padding: 5px 0;
            margin-bottom: 8px;
        }

        .logo-container {
            text-align: center;
            padding: 0;
            position: relative;
            margin-bottom: 3px;
            margin-top: 0;
        }


        /* .logo-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0;
            position: relative;
        } */

        .logo {
            max-width: 40mm;
            height: auto;
            flex-shrink: 0;
        }

        .university-name-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 2px
        }

        .header-right-info {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: center;
            font-size: 7.5pt;
            text-align: right;
            min-width: 80mm;
        }

        .university-name {
            font-size: 14pt;
            font-weight: bold;
            color: #000;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .directorate-name {
            font-size: 9pt;
            font-weight: normal;
            color: #000;
            text-align: center;
            margin: 2px 0 0 0;
            padding: 0;
        }

        .subject-info {
            margin: 8px 0 4px 0;
            font-size: 7.5pt;
        }

        .subject-info-row {
            margin: 2px 0;
        }

        .document-title {
            font-size: 11pt;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .verification-box-2 {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
        }

        .verification-box {
            background-color: #f0f0f0;
            border-radius: 8px;
            padding: 12px 15px;
            flex: 1;
        }

        .verification-text-box {
            font-size: 10pt;
            line-height: 1.5;
            color: #000;
        }

        .doc-number {
            font-weight: bold;
            font-family: 'Courier New', monospace;
            letter-spacing: 0.5px;
        }

        .qr-code {
            width: 70px;
            height: 70px;
            flex-shrink: 0;
        }

        .footer-divider {
            height: 2px;
            background: linear-gradient(90deg, #1a2744 0%, #c5a55a 50%, #1a2744 100%);
            margin: 5px 0;
        }

        .verification-card {
            width: 100%;
            border: 1.5px solid #1a2744;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .verification-card-header {
            background: #1a2744;
            color: #fff;
            font-size: 6pt;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 3px 12px;
            text-align: center;
        }

        .verification-card-body {
            width: 100%;
            border-collapse: collapse;
        }

        .verification-card-body td {
            vertical-align: middle;
        }

        .verification-qr-cell {
            width: 70px;
            padding: 6px;
            text-align: center;
            background: #f4f6fa;
            border-right: 1px solid #dde1e8;
        }

        .verification-info-cell {
            padding: 6px 10px;
            font-size: 6.5pt;
            line-height: 1.5;
            color: #333;
        }

        .verification-info-cell strong {
            color: #1a2744;
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

        .date-line {
            font-weight: bold;
            font-size: 7.5pt;
            color: #1a2744;
            margin-bottom: 4px;
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
    <!-- Header -->
    <div class="header">
        <div class="logo-container">
            @php
                $logoPath = public_path('images/RADOM-simvol.png');
                $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';
                $logoMime = 'image/jpeg';
            @endphp
            @if ($logoData)
                <img src="data:{{ $logoMime }};base64,{{ $logoData }}" alt="RADOM Logo" class="logo">
            @endif
            <div class="university-name-container">
                <div class="university-name">
                    RADOM UNIVERSITY
                </div>
                <div class="directorate-name">
                    Directorate of International Relations
                </div>
            </div>
            <div class="header-right-info">
                @php
                    $barcodeCode = trim($student->student_number ?? $student->application_number ?? '') ?: ('RADOM-' . $student->id . '-' . now()->format('Ymd'));
                    $barcodeBase64 = '';
                    try {
                        $barcodePng = (new \Picqer\Barcode\BarcodeGeneratorPNG())
                            ->getBarcode($barcodeCode, \Picqer\Barcode\BarcodeGenerator::TYPE_CODE_128, 1, 22, [26, 39, 68]);
                        $barcodeBase64 = base64_encode($barcodePng);
                    } catch (\Throwable $e) {
                        // fallback - barcode hidden
                    }
                @endphp
                @if ($barcodeBase64)
                    <div style="margin-bottom: 4px;">
                        <img src="data:image/png;base64,{{ $barcodeBase64 }}" alt="Barcode" style="max-width: 110px; height: auto; max-height: 28px; display: block;" />
                    </div>
                @endif
                <div>Date: {{ now()->format('d/m/Y') }}</div>
            </div>
        </div>

        <!-- Subject and Application Code -->
        <div class="subject-info">
            <div class="subject-info-row">
                Subject: {{ $student->application->program?->degree?->name ?? 'N/A' }} Degree - CONDITIONAL ACCEPTANCE
                LETTER
            </div>
            <div class="subject-info-row">
                Application Code: {{ $student->application_number ?? 'N/A' }}
            </div>
            <div class="subject-info-row">
                Dear {{ tr_upper(text: $student->first_name . ' ' . $student->last_name) }}
            </div>
            <div>
                Conditional Acceptance Letter
            </div>

        </div>
    </div>

    <!-- Document Title -->
    <!-- Introduction Content -->
    <div class="content">
        <p style="font-size: 9pt; font-weight: bold; color: #1a2744; margin-bottom: 6px;">
            Congratulations!
        </p>
        <p>
            Your application to RADOM UNIVERSITY for the
            {{ now()->format('Y') }}-{{ now()->addYear()->format('Y') }} academic year Fall semester has been
            successfully approved. We are excited for you to be a member of the RADOM UNIVERSITY and to join a
            dynamic and diverse student community in a place of endless opportunities. This letter is to confirm
            your conditional acceptance into
            <strong>{{ strtoupper($student->application->program?->name ?? 'N/A') }}</strong>
            {{ $student->application->program?->degree?->name ?? 'N/A' }} degree program under the
            <strong>{{ $student->application->program?->faculty?->name ?? 'N/A' }}</strong>.
            The duration of the program is
            {{ $student->application->program?->degree?->duration ?? 'N/A' }} years, and the medium of
            instruction is {{ $student->study_language === 'EN' ? 'English' : 'Turkish' }}.
        </p>
    </div>
    <br>

    <!-- Tuition Fee -->

    <div class="info-grid">
        <div class="info-row">
            <div class="info-label">Annual Program Tuition Fee</div>
            <div class="info-value"><strong>4000 EUR</strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Tuition Fee with Discount</div>
            <div class="info-value"><strong>1000 EUR</strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Scholarship</div>
            <div class="info-value"><strong>75%</strong></div>
        </div>
        <div class="info-row">
            <div class="info-label">Amount of Deposit Payment</div>
            <div class="info-value"><strong>1000 EUR</strong></div>
        </div>
    </div>
    <br>
    <br>
    <!-- Section 1 -->
    {{-- <div class="section-header">1. Condition for Issuing the Acceptance Letter</div> --}}
    <div class="subsection-title">Deposit Payment</div>
    <div class="content">
        <p>
            The official Acceptance Letter will be issued upon payment of a non-refundable deposit of 1000 EUR, either
            by credit card via the RADOM Application
            Platform or by bank transfer to the University's bank account. For all bank transfers; name, surname and
            application number must be provided. The
            bank account details are provided below. To proceed to the next stage of your application, you are required
            to upload a copy of the bank receipt or payment confirmation to the RADOM Application Platform after
            completing the transfer.
        </p>
    </div>
    <br>
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
    <br>
    <br>

    <!-- English Language Proficiency Requirements -->
    {{-- <div class="section-header">English Language Proficiency Requirements</div>

    <table class="proficiency-table">
        <thead>
            <tr>
                <th style="width: 18%;">Test Name</th>
                <th style="width: 20%;">Requirement Level 1</th>
                <th style="width: 20%;">Requirement Level 2</th>
                <th style="width: 20%;">Requirement Level 3</th>
                <th style="width: 18%;">Requirement Level 4</th>
                <th style="width: 10%;">Validity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>PTE Academic</strong><br>(Pearson Test of English Academic)</td>
                <td>At least 69 overall with a minimum of 59 in all communicative skills.</td>
                <td>At least 69 overall with a minimum of 62 in all communicative skills.</td>
                <td>At least 76 overall with a minimum of 62 in all communicative skills.</td>
                <td>At least 80 overall with a minimum of 80 in all communicative skills.</td>
                <td>Two calendar years</td>
            </tr>
            <tr>
                <td><strong>TOEFL iBT</strong><br>(including Home Edition)</td>
                <td>At least 90 overall with minimum scores of 17 for writing, 17 for listening, 18 for reading, and 20
                    for speaking.</td>
                <td>At least 90 overall with a minimum of 20 in each subskill.</td>
                <td>At least 100 overall with a minimum of 20 in each subskill.</td>
                <td>At least 109 overall with a minimum of 26 in speaking and 24 in all other subskills.</td>
                <td>Two calendar years</td>
            </tr>
            <tr>
                <td><strong>IELTS (Academic)</strong><br>test from a recognized IELTS test centre (including one skill
                    retake).</td>
                <td>At least 6.5 overall with a minimum of 5.5 in each subskill.</td>
                <td>At least 6.5 overall with a minimum of 6.0 in each subskill.</td>
                <td>At least 7.0 overall with at least 6.0 in each subskill.</td>
                <td>At least 7.5 overall with at least 7.5 in each subskill.</td>
                <td>Two calendar years</td>
            </tr>
        </tbody>
    </table> --}}


    <!-- English Proficiency and Preparatory Exam -->
    <div class="subsection-title">English Proficiency and Preparatory Exam</div>
    <div class="content">
        <p>
            Students who do not have an English proficiency certificate, or those who will study in Polish, must take a
            proficiency exam.
            The tuition fees of students who register for their departments but fail the preparatory exam will be
            counted towards the preparatory
            class fee, and any remaining balance will be collected at the beginning of the academic year.
        </p>
    </div>

    <!-- Conditional Acceptance Notice -->
    <div class="section-header">Conditional Acceptance</div>
    <div class="content">
        <p>
            This letter constitutes a <strong>conditional acceptance</strong> to the program indicated above. Your final
            enrollment is subject to the university's verification of your submitted documents and compliance with all
            admission requirements. You will receive a <strong>Final Acceptance Letter</strong> once your file has been
            fully reviewed and approved. Until then, please ensure that you complete any pending steps (e.g. language
            proficiency, document submission, or payment) as communicated by the International Admissions Office.
        </p>
    </div>

    <!-- Additional Information -->
    <div class="content">
        <p>
            For inquiries regarding application, payment, registration, etc., please contact us at:
            <strong>international@radomuniversity.pl</strong>
        </p>
    </div>

    <!-- Closing -->
    <div class="closing-section">
        <p>Sincerely,</p>
        <p><strong>International Admissions Office</strong></p>
    </div>


    <!-- Footer Section -->
    <div class="verification-footer">
        <!-- Date -->
        <div class="date-line">
            Date: {{ now()->format('d/m/Y') }}
        </div>

        <!-- Verification Card with QR -->
        <div class="verification-card">
            <div class="verification-card-header">
                Document Verification
            </div>
            <table class="verification-card-body">
                <tr>
                    <td class="verification-qr-cell">
                        @php
                            $verificationCodeForUrl = $verificationCode ?? null;
                            $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
                                ->size(70)
                                ->generate($student->getVerificationUrl($verificationCodeForUrl));
                            $qrCodeBase64 = base64_encode($qrCode);
                        @endphp
                        <img src="data:image/svg+xml;base64,{{ $qrCodeBase64 }}"
                            style="width: 56px; height: 56px;" />
                    </td>
                    <td class="verification-info-cell">
                        This document was e-signed for
                        <strong>{{ tr_upper($student->first_name . ' ' . $student->last_name) }}</strong> on
                        {{ now()->format('d/m/Y') }} with document number
                        <strong>{{ $verificationCode ?? strtoupper(\Illuminate\Support\Str::random(12)) }}</strong>.
                        The validity of the document can be confirmed by scanning the QR code or by document number at
                        <strong>{{ $student->getVerificationUrl() }}</strong>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Divider Line -->
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
